const config = window.resumeBuilderConfig;

if (config) {
    const clone = (value) => JSON.parse(JSON.stringify(value));
    const state = clone(config.initialData);
    const formRoot = document.getElementById("rb-editor-form");
    const previewPaper = document.getElementById("rb-preview-paper");
    const previewStage = document.getElementById("rb-preview-stage");
    const downloadButton = document.getElementById("rb-download-link");
    const downloadLabel = document.getElementById("rb-download-label");
    const saveStatus = document.getElementById("rb-save-status");
    const saveStatusText = document.getElementById("rb-save-status-text");
    const formMessage = document.getElementById("rb-form-message");
    const colorDialog = document.getElementById("rb-color-dialog");
    const aiDialog = document.getElementById("rb-ai-dialog");
    const aiResult = document.getElementById("rb-ai-result");
    const aiError = document.getElementById("rb-ai-error");
    const aiAccept = document.getElementById("rb-ai-accept");
    let documentId = config.documentId;
    let photoUrl = config.photoUrl;
    let changed = false;
    let changeVersion = 0;
    let saveTimer = null;
    let inFlight = null;
    let saveRequested = false;
    let activeSuggestion = null;
    let loadingAi = false;
    let previewZoom = 100;
    let currentPreviewPage = 1;
    let photoUploadPromise = null;

    const templateNames = {
        modern: "Modern Professional",
        classic: "Classic Professional",
        executive: "Executive",
        creative: "Creative",
    };

    const additionalTypes = {
        awards: "Awards and Achievements",
        volunteer: "Volunteer Experience",
        publications: "Publications",
        interests: "Interests",
        references: "References",
        custom: "Custom Section",
    };

    const newItems = {
        work_experience: () => ({
            job_title: "",
            company: "",
            employment_type: "",
            location: "",
            start_date: "",
            end_date: "",
            current: false,
            responsibilities: "",
            achievements: [],
        }),
        education: () => ({
            degree: "",
            institution: "",
            field: "",
            start_year: "",
            end_year: "",
            grade: "",
            description: "",
        }),
        skills: () => ({ name: "", category: "", proficiency: "" }),
        projects: () => ({
            name: "",
            description: "",
            technologies: "",
            url: "",
            start_date: "",
            end_date: "",
        }),
        certifications: () => ({
            name: "",
            organization: "",
            issue_date: "",
            credential_url: "",
        }),
        languages: () => ({ name: "", proficiency: "" }),
    };

    for (const [key, factory] of Object.entries(newItems)) {
        if (!Array.isArray(state[key])) state[key] = [];
    }
    if (!Array.isArray(state.additional_sections)) state.additional_sections = [];
    if (!state.personal_information || typeof state.personal_information !== "object") {
        state.personal_information = {};
    }

    function escapeHtml(value) {
        return String(value ?? "").replace(/[&<>"']/g, (character) => ({
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': "&quot;",
            "'": "&#39;",
        })[character]);
    }

    function safeColor(value, fallback) {
        return /^#[0-9a-f]{6}$/i.test(value || "") ? value : fallback;
    }

    function hasText(value) {
        return typeof value === "string" && value.trim().length > 0;
    }

    function isValidMonth(value) {
        return typeof value === "string" && /^\d{4}-(0[1-9]|1[0-2])$/.test(value);
    }

    function isValidYear(value) {
        return typeof value === "string" && /^\d{4}$/.test(value) && Number(value) >= 1900 && Number(value) <= 2099;
    }

    function isValidExperience(item) {
        const hasDescription = hasText(item.responsibilities)
            || (Array.isArray(item.achievements) && item.achievements.some(hasText));

        return hasText(item.job_title)
            && hasText(item.company)
            && isValidMonth(item.start_date)
            && hasDescription;
    }

    function isValidEducation(item) {
        const hasStartYearValue = hasText(item.start_year);
        const hasEndYearValue = hasText(item.end_year);
        const hasStartYear = isValidYear(item.start_year);
        const hasEndYear = isValidYear(item.end_year);

        return hasText(item.degree)
            && hasText(item.institution)
            && (hasStartYear || hasEndYear)
            && (!hasStartYearValue || hasStartYear)
            && (!hasEndYearValue || hasEndYear)
            && !(hasStartYear && hasEndYear && Number(item.end_year) < Number(item.start_year));
    }

    function resumeHasContent() {
        const hasEntryContent = (entries) => entries.some((item) => Object.values(item).some((value) => (
            Array.isArray(value) ? value.some(hasText) : hasText(value)
        )));

        return Object.values(state.personal_information || {}).some(hasText)
            || ["work_experience", "education", "skills", "projects", "certifications", "languages", "additional_sections"]
                .some((key) => hasEntryContent(state[key]));
    }

    function pdfFilename() {
        const name = state.personal_information?.name || state.title || "Resume";
        const safeName = String(name)
            .normalize("NFKD")
            .replace(/[\u0300-\u036f]/g, "")
            .replace(/[^a-zA-Z0-9]+/g, "-")
            .replace(/^-|-$/g, "");

        if (!safeName) return "Resume.pdf";

        return `${safeName}${/-resume$/i.test(safeName) ? "" : "-Resume"}.pdf`;
    }

    function getPath(path) {
        return path.split(".").reduce((value, key) => value?.[key], state);
    }

    function setPath(path, value) {
        const keys = path.split(".");
        const last = keys.pop();
        const parent = keys.reduce((current, key) => {
            if (current[key] === undefined || current[key] === null) {
                current[key] = /^\d+$/.test(key) ? [] : {};
            }
            return current[key];
        }, state);
        parent[last] = value;
    }

    function field(label, path, options = {}) {
        const type = options.type || "text";
        const value = getPath(path);
        const className = options.full ? "rb-field rb-field--full" : "rb-field";
        const attributes = options.attributes || "";
        let control;

        if (type === "textarea") {
            control = `<textarea data-path="${path}" rows="${options.rows || 3}" maxlength="${options.maxlength || 5000}" placeholder="${escapeHtml(options.placeholder || "")}" ${attributes}>${escapeHtml(value || "")}</textarea>`;
        } else if (type === "select") {
            control = `<select data-path="${path}"><option value="">Select</option>${options.options.map((option) => `<option value="${escapeHtml(option)}" ${value === option ? "selected" : ""}>${escapeHtml(option)}</option>`).join("")}</select>`;
        } else {
            control = `<input data-path="${path}" type="${type}" value="${escapeHtml(value || "")}" maxlength="${options.maxlength || 200}" placeholder="${escapeHtml(options.placeholder || "")}" ${attributes}>`;
        }

        return `<label class="${className}"><span>${escapeHtml(label)}</span>${control}${options.note ? `<small class="rb-field-note">${escapeHtml(options.note)}</small>` : ""}</label>`;
    }

    function listField(label, path, options = {}) {
        const value = getPath(path);
        return `<label class="rb-field rb-field--full"><span>${escapeHtml(label)}</span><textarea data-line-list="${path}" rows="${options.rows || 3}" maxlength="${options.maxlength || 4000}" placeholder="${escapeHtml(options.placeholder || "Enter one item per line")}">${escapeHtml(Array.isArray(value) ? value.join("\n") : "")}</textarea>${options.note ? `<small class="rb-field-note">${escapeHtml(options.note)}</small>` : ""}</label>`;
    }

    function checkbox(label, path) {
        return `<label class="rb-checkbox-row"><input type="checkbox" data-path="${path}" ${getPath(path) ? "checked" : ""}><span>${escapeHtml(label)}</span></label>`;
    }

    function details(key, title, subtitle, icon, body, open = false) {
        return `<details class="rb-section" id="rb-section-${key}" ${open ? "open" : ""}><summary><span class="rb-section__icon" aria-hidden="true">${icon}</span><span class="rb-section__title"><strong>${escapeHtml(title)}</strong><small>${escapeHtml(subtitle)}</small></span></summary><div class="rb-section__body">${body}</div></details>`;
    }

    function removeButton(list, index, label = "Remove") {
        return `<button type="button" class="rb-icon-button" data-remove-list="${list}" data-index="${index}" aria-label="${label} entry">×</button>`;
    }

    function addEntryButton(list, label) {
        return `<button type="button" class="rb-small-button" data-add-list="${list}">+ ${escapeHtml(label)}</button>`;
    }

    function renderPersonalSection() {
        const p = "personal_information";
        const personalFields = [
            field("Full name", `${p}.name`, { placeholder: "e.g. Alex Morgan" }),
            field("Professional job title", `${p}.job_title`, { placeholder: "e.g. Product Designer" }),
            field("Email address", `${p}.email`, { type: "email", placeholder: "you@example.com" }),
            field("Phone number", `${p}.phone`, { type: "tel", placeholder: "+1 555 0100" }),
            field("Location", `${p}.location`, { placeholder: "City, Country" }),
            field("LinkedIn URL", `${p}.linkedin`, { type: "url", placeholder: "https://linkedin.com/in/..." }),
            field("Portfolio URL", `${p}.portfolio`, { type: "url", placeholder: "https://your-site.com" }),
        ].join("");
        const summary = getPath(`${p}.summary`) || "";

        return details("personal", "Personal Information", "Contact details and professional profile", "01", `
            <div class="rb-personal-top">
                <label class="rb-photo-upload">
                    <span class="rb-photo-upload__preview">${photoUrl ? `<img src="${escapeHtml(photoUrl)}" alt="Profile photo">` : '<span aria-hidden="true">◎</span>'}</span>
                    <span class="rb-photo-upload__drop"><strong>Upload photo</strong><small>PNG, JPG or WebP up to 2MB</small></span>
                    <input type="file" id="rb-profile-photo" accept="image/png,image/jpeg,image/webp">
                    <small class="rb-field-note" id="rb-photo-status">${photoUrl ? "Photo added to your resume." : "Drag & drop or click to upload"}</small>
                </label>
                <div class="rb-ai-assistant-card">
                    <div class="rb-ai-assistant-card__title"><span aria-hidden="true">✦</span><strong>AI Writing Assistant</strong></div>
                    <p>Generate or improve your professional summary with AI.</p>
                    <button type="button" class="rb-small-button rb-small-button--ai" data-ai-action="summary" data-ai-target="personal_information.summary">✦ Generate with AI</button>
                </div>
            </div>
            <div class="rb-field-grid">
                ${personalFields}
                <label class="rb-field rb-field--full rb-summary-field">
                    <span class="rb-summary-field__label">
                        <span>Professional Summary</span>
                        <button type="button" class="rb-small-button rb-small-button--ai" data-ai-action="summary" data-ai-target="personal_information.summary">✦ Generate with AI</button>
                    </span>
                    <textarea data-path="${p}.summary" rows="5" maxlength="5000" placeholder="Summarize your experience, strengths, and professional focus.">${escapeHtml(summary)}</textarea>
                    <small class="rb-character-count"><span id="rb-summary-character-count">${String(summary).length}</span> / 5000 characters</small>
                </label>
            </div>
            <div class="rb-section-actions">
                <button type="button" class="rb-small-button rb-small-button--ai" data-ai-action="summary" data-ai-target="personal_information.summary">✦ Improve Summary</button>
                <button type="button" class="rb-small-button" data-ai-action="grammar" data-ai-target="personal_information.summary">✓ Fix Grammar</button>
                <button type="button" class="rb-small-button" data-ai-action="tailor" data-ai-target="personal_information.summary">◎ Make It Concise</button>
                <button type="button" class="rb-small-button" data-ai-action="tailor" data-ai-target="personal_information.summary">◎ Tailor to Job</button>
            </div>
        `, true);
    }

    function renderExperience() {
        const entries = state.work_experience.map((item, index) => {
            const base = `work_experience.${index}`;
            return `<article class="rb-entry-card">
                <div class="rb-entry-card__heading"><strong>Experience ${index + 1}</strong>${removeButton("work_experience", index)}</div>
                <div class="rb-field-grid">
                    ${field("Job title", `${base}.job_title`)}
                    ${field("Company name", `${base}.company`)}
                    ${field("Employment type", `${base}.employment_type`, { type: "select", options: ["Full-time", "Part-time", "Contract", "Freelance", "Internship", "Temporary"] })}
                    ${field("Location", `${base}.location`)}
                    ${field("Start date", `${base}.start_date`, { type: "month" })}
                    ${field("End date", `${base}.end_date`, { type: "month" })}
                    <div class="rb-field rb-field--full">${checkbox("I currently work here", `${base}.current`)}</div>
                    ${field("Job responsibilities", `${base}.responsibilities`, { type: "textarea", full: true, rows: 4, maxlength: 6000, placeholder: "Describe your actual responsibilities and scope." })}
                    ${listField("Achievements", `${base}.achievements`, { rows: 3, maxlength: 6000, note: "Add one achievement per line. Include metrics only when you can verify them." })}
                </div>
                <div class="rb-section-actions">
                    <button type="button" class="rb-small-button rb-small-button--ai" data-ai-action="improve_description" data-ai-target="${base}.responsibilities">AI Improve Description</button>
                    <button type="button" class="rb-small-button rb-small-button--ai" data-ai-action="achievements" data-ai-target="${base}.achievements">Generate Achievement Points</button>
                    <button type="button" class="rb-small-button rb-small-button--ai" data-ai-action="grammar" data-ai-target="${base}.responsibilities">Improve Grammar</button>
                </div>
            </article>`;
        }).join("");

        return details("experience", "Work Experience", `${state.work_experience.length} entries`, "02", `
            <div class="rb-repeater">${entries || '<p class="rb-field-note">Add work history when you are ready. You can leave this section empty.</p>'}</div>
            ${addEntryButton("work_experience", "Add Experience")}
        `);
    }

    function renderEducation() {
        const entries = state.education.map((item, index) => {
            const base = `education.${index}`;
            return `<article class="rb-entry-card">
                <div class="rb-entry-card__heading"><strong>Education ${index + 1}</strong>${removeButton("education", index)}</div>
                <div class="rb-field-grid">
                    ${field("Degree", `${base}.degree`)}
                    ${field("Institution name", `${base}.institution`)}
                    ${field("Field of study", `${base}.field`)}
                    ${field("Grade / GPA", `${base}.grade`)}
                    ${field("Start year", `${base}.start_year`, { type: "number", maxlength: 4 })}
                    ${field("End year", `${base}.end_year`, { type: "number", maxlength: 4 })}
                    ${field("Description", `${base}.description`, { type: "textarea", full: true, rows: 3, maxlength: 3000 })}
                </div>
            </article>`;
        }).join("");

        return details("education", "Education", `${state.education.length} entries`, "03", `
            <div class="rb-repeater">${entries || '<p class="rb-field-note">Add a degree, course, or other relevant education.</p>'}</div>
            ${addEntryButton("education", "Add Education")}
        `);
    }

    function renderSkills() {
        const entries = state.skills.map((item, index) => {
            const base = `skills.${index}`;
            return `<article class="rb-entry-card">
                <div class="rb-entry-card__heading"><strong>Skill ${index + 1}</strong>${removeButton("skills", index)}</div>
                <div class="rb-field-grid">
                    ${field("Skill name", `${base}.name`, { placeholder: "e.g. User research" })}
                    ${field("Skill category", `${base}.category`, { placeholder: "e.g. Design" })}
                    ${field("Proficiency", `${base}.proficiency`, { type: "select", options: ["Beginner", "Intermediate", "Advanced", "Expert"] })}
                </div>
            </article>`;
        }).join("");

        return details("skills", "Skills", `${state.skills.length} skills`, "04", `
            <div class="rb-repeater">${entries || '<p class="rb-field-note">List only skills you can confidently demonstrate.</p>'}</div>
            <div class="rb-section-actions">
                ${addEntryButton("skills", "Add Skill")}
                <button type="button" class="rb-small-button rb-small-button--ai" data-ai-action="skills">Suggest Relevant Skills</button>
            </div>
        `);
    }

    function renderProjects() {
        const entries = state.projects.map((item, index) => {
            const base = `projects.${index}`;
            return `<article class="rb-entry-card">
                <div class="rb-entry-card__heading"><strong>Project ${index + 1}</strong>${removeButton("projects", index)}</div>
                <div class="rb-field-grid">
                    ${field("Project name", `${base}.name`)}
                    ${field("Technologies used", `${base}.technologies`)}
                    ${field("Project URL", `${base}.url`, { type: "url" })}
                    ${field("Start date", `${base}.start_date`, { type: "month" })}
                    ${field("End date", `${base}.end_date`, { type: "month" })}
                    ${field("Description", `${base}.description`, { type: "textarea", full: true, rows: 3, maxlength: 4000 })}
                    <div class="rb-field rb-field--full rb-section-actions">
                        <button type="button" class="rb-small-button rb-small-button--ai" data-ai-action="improve_description" data-ai-target="${base}.description">AI Improve Description</button>
                        <button type="button" class="rb-small-button rb-small-button--ai" data-ai-action="grammar" data-ai-target="${base}.description">Improve Grammar</button>
                    </div>
                </div>
            </article>`;
        }).join("");
        return details("projects", "Projects", `${state.projects.length} entries`, "05", `
            <div class="rb-repeater">${entries || '<p class="rb-field-note">Add relevant personal or professional projects.</p>'}</div>
            ${addEntryButton("projects", "Add Project")}
        `);
    }

    function renderCertifications() {
        const entries = state.certifications.map((item, index) => {
            const base = `certifications.${index}`;
            return `<article class="rb-entry-card">
                <div class="rb-entry-card__heading"><strong>Certification ${index + 1}</strong>${removeButton("certifications", index)}</div>
                <div class="rb-field-grid">
                    ${field("Certification name", `${base}.name`)}
                    ${field("Issuing organization", `${base}.organization`)}
                    ${field("Issue date", `${base}.issue_date`, { type: "month" })}
                    ${field("Credential URL", `${base}.credential_url`, { type: "url" })}
                </div>
            </article>`;
        }).join("");
        return details("certifications", "Certifications", `${state.certifications.length} entries`, "06", `
            <div class="rb-repeater">${entries || '<p class="rb-field-note">Add certifications when relevant.</p>'}</div>
            ${addEntryButton("certifications", "Add Certification")}
        `);
    }

    function renderLanguages() {
        const entries = state.languages.map((item, index) => {
            const base = `languages.${index}`;
            return `<article class="rb-entry-card">
                <div class="rb-entry-card__heading"><strong>Language ${index + 1}</strong>${removeButton("languages", index)}</div>
                <div class="rb-field-grid">
                    ${field("Language name", `${base}.name`)}
                    ${field("Proficiency level", `${base}.proficiency`, { type: "select", options: ["Native", "Fluent", "Advanced", "Intermediate", "Basic"] })}
                </div>
            </article>`;
        }).join("");
        return details("languages", "Languages", `${state.languages.length} entries`, "07", `
            <div class="rb-repeater">${entries || '<p class="rb-field-note">Add the languages you speak.</p>'}</div>
            ${addEntryButton("languages", "Add Language")}
        `);
    }

    function renderAdditional() {
        const entries = state.additional_sections.map((item, index) => `
            <article class="rb-entry-card">
                <div class="rb-entry-card__heading">
                    <strong>Optional section ${index + 1}</strong>
                    <button type="button" class="rb-small-button" data-move-section="up" data-index="${index}" aria-label="Move section up" ${index === 0 ? "disabled" : ""}>↑</button>
                    <button type="button" class="rb-small-button" data-move-section="down" data-index="${index}" aria-label="Move section down" ${index === state.additional_sections.length - 1 ? "disabled" : ""}>↓</button>
                    ${removeButton("additional_sections", index, "Remove")}
                </div>
                <div class="rb-field-grid">
                    <label class="rb-field"><span>Section type</span>
                        <select data-path="additional_sections.${index}.type">
                            ${Object.entries(additionalTypes).map(([type, title]) => `<option value="${type}" ${item.type === type ? "selected" : ""}>${title}</option>`).join("")}
                        </select>
                    </label>
                    ${field("Section heading", `additional_sections.${index}.title`, { maxlength: 120 })}
                    ${field("Details", `additional_sections.${index}.content`, { type: "textarea", full: true, rows: 3, maxlength: 10000, placeholder: "Add concise, relevant details." })}
                </div>
            </article>
        `).join("");
        return details("additional", "Additional Sections", "Awards, volunteering, publications, interests, and more", "08", `
            <div class="rb-repeater">${entries || '<p class="rb-field-note">Add any optional sections that strengthen your resume.</p>'}</div>
            <label class="rb-field rb-field--full"><span>Choose a section to add</span>
                <select id="rb-additional-type">${Object.entries(additionalTypes).map(([type, title]) => `<option value="${type}">${title}</option>`).join("")}</select>
            </label>
            <button type="button" class="rb-small-button" id="rb-additional-button">+ Add Section</button>
        `);
    }

    function renderEditor() {
        formRoot.innerHTML = [
            renderPersonalSection(),
            renderExperience(),
            renderEducation(),
            renderSkills(),
            renderProjects(),
            renderCertifications(),
            renderLanguages(),
            renderAdditional(),
        ].join("");
    }

    function externalLink(value, label) {
        if (!value) return "";
        const safe = /^https?:\/\//i.test(value) ? value : "";
        return `<span>${safe ? `<a href="${escapeHtml(safe)}" target="_blank" rel="noopener noreferrer">${escapeHtml(label)}</a>` : escapeHtml(value)}</span>`;
    }

    function renderPreview() {
        const p = state.personal_information || {};
        const accent = safeColor(state.theme_color, "#704ce3");
        const heading = safeColor(state.heading_color, "#292044");
        const template = templateNames[state.template] ? state.template : "modern";
        const contacts = [
            p.email ? `<span class="rb-doc-contact__item"><span aria-hidden="true">✉</span><a href="mailto:${escapeHtml(p.email)}">${escapeHtml(p.email)}</a></span>` : "",
            p.phone ? `<span class="rb-doc-contact__item"><span aria-hidden="true">☎</span>${escapeHtml(p.phone)}</span>` : "",
            p.location ? `<span class="rb-doc-contact__item"><span aria-hidden="true">⌖</span>${escapeHtml(p.location)}</span>` : "",
            p.linkedin ? `<span class="rb-doc-contact__item"><span aria-hidden="true">in</span>${externalLink(p.linkedin, "LinkedIn")}</span>` : "",
            p.portfolio ? `<span class="rb-doc-contact__item"><span aria-hidden="true">↗</span>${externalLink(p.portfolio, "Portfolio")}</span>` : "",
        ].filter(Boolean).join("");

        const section = (title, content) => content
            ? `<section class="rb-doc-section"><h2>${escapeHtml(title)}</h2>${content}</section>`
            : "";

        const entryHeader = (title, dates, sub) => `
            <div class="rb-doc-entry__heading"><strong>${escapeHtml(title)}</strong><span>${escapeHtml(dates)}</span></div>
            ${sub ? `<div class="rb-doc-entry__subheading"><span>${escapeHtml(sub)}</span></div>` : ""}
        `;

        const experiences = state.work_experience
            .filter((item) => item.job_title || item.company || item.responsibilities || item.achievements?.length)
            .map((item) => {
                const dates = [item.start_date, item.current ? "Present" : item.end_date].filter(Boolean).join(" – ");
                const sub = [item.company, item.location, item.employment_type].filter(Boolean).join(" · ");
                const bullets = (item.achievements || []).filter(Boolean);
                return `<div class="rb-doc-entry">${entryHeader(item.job_title || item.company || "Experience", dates, sub)}
                    ${item.responsibilities ? `<p class="rb-doc-body">${escapeHtml(item.responsibilities)}</p>` : ""}
                    ${bullets.length ? `<ul class="rb-doc-bullets">${bullets.map((point) => `<li>${escapeHtml(point)}</li>`).join("")}</ul>` : ""}
                </div>`;
            }).join("");

        const education = state.education
            .filter((item) => item.degree || item.institution)
            .map((item) => `<div class="rb-doc-entry">${entryHeader(
                [item.degree, item.field].filter(Boolean).join(" · ") || item.institution,
                [item.start_year, item.end_year].filter(Boolean).join(" – "),
                [item.institution, item.grade].filter(Boolean).join(" · "),
            )}${item.description ? `<p class="rb-doc-body">${escapeHtml(item.description)}</p>` : ""}</div>`)
            .join("");

        const skills = state.skills.filter((item) => item.name);
        const projects = state.projects
            .filter((item) => item.name || item.description)
            .map((item) => `<div class="rb-doc-entry">${entryHeader(
                item.name || "Project",
                [item.start_date, item.end_date].filter(Boolean).join(" – "),
                item.technologies,
            )}${item.description ? `<p class="rb-doc-body">${escapeHtml(item.description)}</p>` : ""}
            ${item.url ? `<div class="rb-doc-link">${externalLink(item.url, item.url)}</div>` : ""}</div>`)
            .join("");

        const certifications = state.certifications
            .filter((item) => item.name)
            .map((item) => `<div class="rb-doc-entry">${entryHeader(item.name, item.issue_date, item.organization)}
            ${item.credential_url ? `<div class="rb-doc-link">${externalLink(item.credential_url, item.credential_url)}</div>` : ""}</div>`)
            .join("");

        const languages = state.languages
            .filter((item) => item.name)
            .map((item) => `<span><strong>${escapeHtml(item.name)}</strong>${item.proficiency ? ` · ${escapeHtml(item.proficiency)}` : ""}</span>`)
            .join("");

        const additional = state.additional_sections
            .filter((item) => item.title || item.content)
            .map((item) => section(item.title || additionalTypes[item.type] || "Additional Information", item.content ? `<p class="rb-doc-body">${escapeHtml(item.content)}</p>` : ""))
            .join("");

        previewPaper.innerHTML = `<article class="rb-resume-document rb-template-${template}" style="--rb-accent:${accent};--rb-heading:${heading}">
            <header class="rb-doc-header">
                ${photoUrl ? `<img class="rb-doc-photo" src="${escapeHtml(photoUrl)}" alt="Profile photo">` : ""}
                <div class="rb-doc-identity">
                    <h1>${escapeHtml(p.name || "Your Name")}</h1>
                    ${p.job_title ? `<p class="rb-doc-job-title">${escapeHtml(p.job_title)}</p>` : ""}
                    ${contacts ? `<div class="rb-doc-contact">${contacts}</div>` : ""}
                </div>
            </header>
            ${section("Professional Summary", p.summary ? `<p class="rb-doc-summary">${escapeHtml(p.summary)}</p>` : "")}
            ${section("Work Experience", experiences)}
            ${section("Education", education)}
            ${section("Skills", skills.length ? `<div class="rb-doc-skills">${skills.map((item) => `<span>${escapeHtml(item.name)}${item.proficiency ? `<small> · ${escapeHtml(item.proficiency)}</small>` : ""}</span>`).join("")}</div>` : "")}
            ${section("Projects", projects)}
            ${section("Certifications", certifications)}
            ${section("Languages", languages ? `<div class="rb-doc-list-inline">${languages}</div>` : "")}
            ${additional}
        </article>`;

        document.querySelector(".rb-color-trigger")?.style.setProperty("--rb-current-color", accent);
        syncColorInputs();
        updateProgress();
        resizePreview();
    }

    function resizePreview() {
        const available = previewStage?.clientWidth || 794;
        const fitScale = Math.min(1, Math.max(0.35, (available - 24) / 794));
        const scale = fitScale * previewZoom / 100;
        previewPaper.style.setProperty("--rb-paper-scale", String(scale));
        previewStage.style.minHeight = `${Math.ceil(previewPaper.scrollHeight * scale)}px`;
        previewStage.style.setProperty("--rb-paper-width", `${Math.ceil(794 * scale)}px`);
        previewStage.classList.toggle("is-zoomed", previewZoom > 100);
        updatePreviewPages(scale);
    }

    function syncColorInputs() {
        const accent = safeColor(state.theme_color, "#704ce3");
        const heading = safeColor(state.heading_color, "#292044");
        document.getElementById("rb-accent-color").value = accent;
        document.getElementById("rb-heading-color").value = heading;
        document.querySelectorAll(".rb-color-preset").forEach((button) => {
            button.classList.toggle("is-active", button.dataset.accent.toLowerCase() === accent.toLowerCase());
        });
        document.querySelectorAll("[data-header-accent]").forEach((button) => {
            button.classList.toggle("is-active", button.dataset.headerAccent.toLowerCase() === accent.toLowerCase());
        });
    }

    function updateProgress() {
        const p = state.personal_information || {};
        const personalComplete = hasText(p.name)
            && hasText(p.job_title)
            && hasText(p.email)
            && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(p.email.trim())
            && hasText(p.summary);
        const additionalCompletion = state.additional_sections.map((item) => hasText(item.title) && hasText(item.content));
        const sectionCompletion = {
            personal: personalComplete,
            experience: state.work_experience.length > 0 && state.work_experience.some(isValidExperience),
            education: state.education.length > 0 && state.education.some(isValidEducation),
            skills: state.skills.length > 0 && state.skills.some((item) => hasText(item.name)),
            projects: state.projects.length > 0 && state.projects.some((item) => hasText(item.name) && hasText(item.description)),
            certifications: state.certifications.length > 0 && state.certifications.some((item) => hasText(item.name) && hasText(item.organization)),
            languages: state.languages.length > 0 && state.languages.some((item) => hasText(item.name)),
            additional: additionalCompletion.length > 0 && additionalCompletion.every(Boolean),
        };
        const applicableSections = [sectionCompletion.personal];
        const sectionEntries = {
            experience: state.work_experience,
            education: state.education,
            skills: state.skills,
            projects: state.projects,
            certifications: state.certifications,
            languages: state.languages,
        };
        Object.entries(sectionEntries).forEach(([section, entries]) => {
            if (entries.length > 0) {
                applicableSections.push(sectionCompletion[section]);
            }
        });
        applicableSections.push(...additionalCompletion);
        const completed = applicableSections.filter(Boolean).length;
        const percent = Math.round(completed / applicableSections.length * 100);
        document.getElementById("rb-progress-value").textContent = `${percent}%`;
        document.getElementById("rb-completion-ring").style.setProperty("--rb-progress", `${percent}%`);
        document.getElementById("rb-completion-track-fill").style.width = `${percent}%`;
        document.querySelectorAll(".rb-builder-nav button[data-rb-section]:not(.rb-builder-nav__add)").forEach((button) => {
            const completedSection = sectionCompletion[button.dataset.rbSection];
            button.classList.toggle("is-complete", Boolean(completedSection));
            const status = button.querySelector("i");
            if (status) status.textContent = completedSection ? "✓" : "";
        });
        const atsScore = document.getElementById("rb-ats-score");
        if (atsScore) atsScore.textContent = String(Math.max(42, Math.min(98, 42 + percent)));
    }

    function updatePreviewPages(scale) {
        const documentElement = previewPaper.querySelector(".rb-resume-document");
        const documentHeight = documentElement?.scrollHeight || 1123;
        const pageCount = Math.max(1, Math.ceil(documentHeight / 1123));
        const pageStep = 1123 * scale;
        const scrollable = previewStage.parentElement;
        currentPreviewPage = Math.min(pageCount, Math.max(1, Math.floor(scrollable.scrollTop / pageStep) + 1));
        document.getElementById("rb-preview-page").textContent = String(currentPreviewPage);
        document.getElementById("rb-preview-pages").textContent = String(pageCount);
        document.getElementById("rb-preview-prev").disabled = currentPreviewPage <= 1;
        document.getElementById("rb-preview-next").disabled = currentPreviewPage >= pageCount;
        document.getElementById("rb-preview-zoom-value").textContent = `${previewZoom}%`;
        document.getElementById("rb-preview-zoom-out").disabled = previewZoom <= 60;
        document.getElementById("rb-preview-zoom-in").disabled = previewZoom >= 140;
    }

    function markChanged() {
        changed = true;
        changeVersion += 1;
        formMessage.textContent = "";
        setStatus("Unsaved", "");
        scheduleSave();
    }

    function setStatus(message, status) {
        saveStatusText.textContent = message;
        saveStatus.className = `rb-save-status${status ? ` is-${status}` : ""}`;
    }

    function fillUrls(payload) {
        documentId = payload.id;
        config.documentId = documentId;
        photoUrl = payload.photo_url || photoUrl;
        document.getElementById("rb-download-link").href = payload.download_url;
        document.getElementById("rb-download-link").removeAttribute("aria-disabled");
        const previewLink = document.getElementById("rb-preview-link");
        if (previewLink) {
            previewLink.href = payload.preview_url;
            previewLink.hidden = false;
        }
        const deleteButton = document.getElementById("rb-delete-document");
        if (deleteButton) deleteButton.hidden = false;
        const editorUrl = payload.edit_url;
        if (window.location.pathname.endsWith("/create") && editorUrl) {
            window.history.replaceState({}, "", editorUrl);
        }
    }

    async function readError(response) {
        const result = await response.json().catch(() => ({}));
        if (result.errors) {
            const first = Object.values(result.errors).flat()[0];
            return first || "Please correct the highlighted information and try again.";
        }
        return result.message || "Your changes could not be saved. Please try again.";
    }

    function scheduleSave() {
        window.clearTimeout(saveTimer);
        saveTimer = window.setTimeout(() => persist(), 750);
    }

    async function persist() {
        if (inFlight) {
            saveRequested = true;
            return inFlight;
        }
        if (!changed && documentId) return true;

        const isNew = !documentId;
        const url = isNew
            ? config.storeUrl
            : config.urlTemplates.update.replace("__ID__", documentId);

        changed = true;
        saveRequested = false;
        setStatus("Saving…", "saving");
        inFlight = (async () => {
            let currentUrl = url;
            let currentMethod = isNew ? "POST" : "PATCH";

            do {
                saveRequested = false;
                const currentVersion = changeVersion;
                const currentPayload = clone(state);
                currentPayload.title = String(currentPayload.title || "").trim() || "My Resume";
                setStatus("Saving…", "saving");

                const response = await fetch(currentUrl, {
                    method: currentMethod,
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": config.csrfToken,
                    },
                    body: JSON.stringify(currentPayload),
                });
                if (!response.ok) throw new Error(await readError(response));

                const result = await response.json();
                fillUrls(result);
                currentUrl = config.urlTemplates.update.replace("__ID__", documentId);
                currentMethod = "PATCH";
                changed = currentVersion !== changeVersion;
            } while (changed || saveRequested);

            changed = false;
            setStatus("Saved", "saved");
            formMessage.textContent = "";
            return true;
        })().catch((error) => {
            changed = true;
            setStatus("Save failed", "error");
            formMessage.textContent = error.message || "Your changes could not be saved.";
            return false;
        }).finally(() => {
            inFlight = null;
        });

        return inFlight;
    }

    function getColorFromPreset(button) {
        return safeColor(button.dataset.accent, "#704ce3");
    }

    function addListItem(list) {
        if (!newItems[list]) return;
        state[list].push(newItems[list]());
        renderEditor();
        renderPreview();
        markChanged();
    }

    function removeListItem(list, index) {
        if (!Array.isArray(state[list]) || !state[list][index]) return;
        if (!window.confirm("Remove this section entry? This change will be saved automatically.")) return;
        state[list].splice(index, 1);
        renderEditor();
        renderPreview();
        markChanged();
    }

    function renderAiResult(suggestion) {
        if (typeof suggestion.text === "string") {
            aiResult.innerHTML = `<label class="rb-field"><span>Suggested text</span><textarea id="rb-ai-text" rows="7">${escapeHtml(suggestion.text)}</textarea></label>`;
            aiAccept.disabled = false;
            return;
        }

        const items = Array.isArray(suggestion.items) ? suggestion.items : [];
        aiResult.innerHTML = items.length
            ? `<ul>${items.map((item, index) => `<li><label><input type="checkbox" data-ai-item="${index}" checked> ${escapeHtml(item)}</label></li>`).join("")}</ul>`
            : `<p>No suggestions were returned. Add more verified details and try again.</p>`;
        aiAccept.disabled = items.length === 0;
    }

    async function startAi(button) {
        const action = button.dataset.aiAction;
        const target = button.dataset.aiTarget || (action === "summary" || action === "tailor" ? "personal_information.summary" : "");

        if (!documentId) {
            const saved = await persist();
            if (!saved || !documentId) {
                formMessage.textContent = "Save your resume before requesting an AI suggestion.";
                return;
            }
        } else if (changed) {
            const saved = await persist();
            if (!saved) return;
        }

        activeSuggestion = { action, target };
        aiResult.innerHTML = "";
        aiError.textContent = "";
        aiAccept.disabled = true;
        document.getElementById("rb-ai-generate").hidden = action !== "tailor";
        document.getElementById("rb-ai-title").textContent = {
            summary: "Generate Professional Summary",
            improve_description: "Improve Description",
            achievements: "Generate Achievement Points",
            skills: "Suggest Relevant Skills",
            grammar: "Improve Grammar and Writing",
            tailor: "Tailor to Job Description",
        }[action] || "Review suggestion";
        const jobDescriptionWrap = document.getElementById("rb-ai-job-description-wrap");
        jobDescriptionWrap.hidden = action !== "tailor";
        document.getElementById("rb-ai-job-description").value = "";
        aiDialog.showModal();

        if (action === "tailor") return;
        requestAi(action, target, "");
    }

    async function requestAi(action, target, jobDescription) {
        if (loadingAi) return;
        loadingAi = true;
        aiError.textContent = "";
        aiResult.textContent = "Generating a suggestion…";
        aiAccept.disabled = true;
        const generateButton = document.getElementById("rb-ai-generate");
        generateButton.disabled = true;
        const source = target ? getPath(target) : "";
        const text = Array.isArray(source) ? source.join("\n") : String(source || "");

        try {
            const response = await fetch(config.urlTemplates.ai.replace("__ID__", documentId), {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": config.csrfToken,
                },
                body: JSON.stringify({ action, text, job_description: jobDescription }),
            });
            if (!response.ok) throw new Error(await readError(response));
            const result = await response.json();
            renderAiResult(result.suggestion || {});
        } catch (error) {
            aiResult.textContent = "";
            aiError.textContent = error.message || "The AI suggestion could not be generated.";
        } finally {
            loadingAi = false;
            generateButton.disabled = false;
        }
    }

    function acceptAiSuggestion() {
        if (!activeSuggestion) return;
        const { action, target } = activeSuggestion;
        const textInput = document.getElementById("rb-ai-text");

        if (textInput) {
            setPath(target || "personal_information.summary", textInput.value.trim());
        } else {
            const selectedValues = [...aiResult.querySelectorAll("[data-ai-item]:checked")]
                .map((checkbox) => checkbox.parentElement.textContent.trim());

            if (selectedValues.length === 0) {
                aiError.textContent = "Select at least one suggestion to add.";
                return;
            }

            if (action === "skills") {
                const current = new Set(state.skills.map((item) => item.name.toLowerCase()));
                selectedValues.forEach((name) => {
                    if (!current.has(name.toLowerCase())) state.skills.push({ name, category: "Suggested", proficiency: "" });
                });
            } else {
                const existing = getPath(target) || [];
                setPath(target, [...existing, ...selectedValues]);
            }
        }

        renderEditor();
        renderPreview();
        markChanged();
        aiDialog.close();
        activeSuggestion = null;
    }

    formRoot.addEventListener("input", (event) => {
        const target = event.target;
        if (target.matches("[data-path]")) {
            const value = target.type === "checkbox" ? target.checked : target.value;
            setPath(target.dataset.path, value);
            if (target.dataset.path === "personal_information.summary") {
                document.getElementById("rb-summary-character-count").textContent = String(target.value.length);
            }
            renderPreview();
            markChanged();
        } else if (target.matches("[data-line-list]")) {
            setPath(target.dataset.lineList, target.value.split(/\r?\n/).map((value) => value.trim()).filter(Boolean));
            renderPreview();
            markChanged();
        }
    });

    formRoot.addEventListener("change", (event) => {
        const target = event.target;
        if (target.matches("[data-path]")) {
            setPath(target.dataset.path, target.type === "checkbox" ? target.checked : target.value);
            renderPreview();
            markChanged();
        }
        if (target.id === "rb-profile-photo" && target.files?.[0]) {
            photoUploadPromise = uploadPhoto(target.files[0]).finally(() => {
                photoUploadPromise = null;
            });
        }
    });

    async function uploadPhoto(file) {
        const photoStatus = document.getElementById("rb-photo-status");
        if (!["image/png", "image/jpeg", "image/webp"].includes(file.type) || file.size > 2 * 1024 * 1024) {
            photoStatus.textContent = "Choose a PNG, JPG, or WebP image up to 2 MB.";
            return false;
        }

        if (!documentId) {
            const saved = await persist();
            if (!saved || !documentId) {
                photoStatus.textContent = "Save your resume before adding a photo.";
                return false;
            }
        }

        photoStatus.textContent = "Uploading photo…";
        const formData = new FormData();
        formData.append("profile_photo", file);

        try {
            const response = await fetch(config.urlTemplates.photoUpload.replace("__ID__", documentId), {
                method: "POST",
                headers: { "Accept": "application/json", "X-CSRF-TOKEN": config.csrfToken },
                body: formData,
            });
            if (!response.ok) throw new Error(await readError(response));
            const result = await response.json();
            photoUrl = `${result.photo_url}?v=${Date.now()}`;
            photoStatus.textContent = "Photo added to your resume.";
            renderPreview();
            return true;
        } catch (error) {
            photoStatus.textContent = error.message || "The photo could not be uploaded.";
            return false;
        }
    }

    document.addEventListener("click", (event) => {
        const addButton = event.target.closest("[data-add-list]");
        if (addButton) {
            addListItem(addButton.dataset.addList);
            return;
        }

        const remove = event.target.closest("[data-remove-list]");
        if (remove) {
            removeListItem(remove.dataset.removeList, Number(remove.dataset.index));
            return;
        }

        const aiButton = event.target.closest("[data-ai-action]");
        if (aiButton) {
            startAi(aiButton);
            return;
        }

        const moveButton = event.target.closest("[data-move-section]");
        if (moveButton) {
            const index = Number(moveButton.dataset.index);
            const nextIndex = moveButton.dataset.moveSection === "up" ? index - 1 : index + 1;
            if (nextIndex < 0 || nextIndex >= state.additional_sections.length) return;
            [state.additional_sections[index], state.additional_sections[nextIndex]] = [state.additional_sections[nextIndex], state.additional_sections[index]];
            renderEditor();
            renderPreview();
            markChanged();
            return;
        }

        if (event.target.closest("#rb-additional-button")) {
            const type = document.getElementById("rb-additional-type").value;
            const title = additionalTypes[type] || additionalTypes.custom;
            state.additional_sections.push({ type, title, content: "" });
            renderEditor();
            renderPreview();
            markChanged();
        }
    });

    document.getElementById("rb-resume-title").addEventListener("input", (event) => {
        state.title = event.target.value;
        document.title = `${state.title || "Resume Builder"} | CareerPilot AI`;
        markChanged();
    });

    document.getElementById("rb-template-select").addEventListener("change", (event) => {
        state.template = event.target.value;
        renderPreview();
        markChanged();
    });

    document.querySelectorAll("[data-color-field]").forEach((input) => {
        input.addEventListener("input", () => {
            state[input.dataset.colorField] = safeColor(input.value, "#704ce3");
            renderPreview();
            markChanged();
        });
    });

    document.querySelectorAll(".rb-color-preset").forEach((button) => {
        button.addEventListener("click", () => {
            state.theme_color = getColorFromPreset(button);
            renderPreview();
            markChanged();
        });
    });

    document.querySelectorAll("[data-header-accent]").forEach((button) => {
        button.addEventListener("click", () => {
            state.theme_color = safeColor(button.dataset.headerAccent, "#704ce3");
            renderPreview();
            markChanged();
        });
    });

    document.getElementById("rb-color-trigger").addEventListener("click", () => colorDialog.showModal());
    document.getElementById("rb-ai-cancel").addEventListener("click", () => aiDialog.close());
    document.getElementById("rb-ai-accept").addEventListener("click", acceptAiSuggestion);
    document.getElementById("rb-ai-generate").addEventListener("click", handleTailorRequest);
    document.getElementById("rb-ai-job-description").addEventListener("input", () => {
        aiError.textContent = "";
    });

    document.getElementById("rb-save-button").addEventListener("click", () => {
        window.clearTimeout(saveTimer);
        persist();
    });

    document.getElementById("rb-delete-document").addEventListener("click", async () => {
        if (!documentId || !window.confirm("Delete this resume permanently? This cannot be undone.")) return;
        const saved = await persist();
        if (!saved) return;
        const response = await fetch(config.urlTemplates.delete.replace("__ID__", documentId), {
            method: "DELETE",
            headers: { "Accept": "application/json", "X-CSRF-TOKEN": config.csrfToken },
        });
        if (!response.ok) {
            formMessage.textContent = await readError(response);
            return;
        }
        window.location.assign("/resume-builder");
    });

    downloadButton.addEventListener("click", async (event) => {
        event.preventDefault();
        if (downloadButton.getAttribute("aria-busy") === "true") return;
        if (!resumeHasContent()) {
            formMessage.textContent = "Add resume information before downloading the PDF.";
            return;
        }

        downloadButton.setAttribute("aria-busy", "true");
        downloadButton.classList.add("is-loading");
        downloadLabel.textContent = "Preparing PDF…";
        formMessage.textContent = "";

        try {
            window.clearTimeout(saveTimer);
            const saved = await persist();
            if (!saved || !documentId) {
                throw new Error(formMessage.textContent || "Your resume could not be saved before downloading.");
            }
            if (photoUploadPromise && !(await photoUploadPromise)) {
                throw new Error("The profile photo upload failed. Retry it before downloading the PDF.");
            }

            const response = await fetch(config.urlTemplates.download.replace("__ID__", documentId), {
                headers: { "Accept": "application/pdf" },
                cache: "no-store",
            });
            if (!response.ok) {
                const contentType = response.headers.get("content-type") || "";
                throw new Error(contentType.includes("application/json")
                    ? await readError(response)
                    : `The PDF could not be generated (HTTP ${response.status}). Please try again.`);
            }

            const pdf = await response.blob();
            if (pdf.size === 0 || !pdf.type.includes("application/pdf") || await pdf.slice(0, 5).text() !== "%PDF-") {
                throw new Error("The generated file was not a valid PDF. Please try again.");
            }

            const objectUrl = window.URL.createObjectURL(pdf);
            const link = document.createElement("a");
            link.href = objectUrl;
            link.download = pdfFilename();
            link.hidden = true;
            document.body.append(link);
            link.click();
            link.remove();
            window.setTimeout(() => window.URL.revokeObjectURL(objectUrl), 1000);
            formMessage.textContent = "PDF downloaded.";
        } catch (error) {
            formMessage.textContent = error.message || "The PDF could not be generated. Please try again.";
        } finally {
            downloadButton.removeAttribute("aria-busy");
            downloadButton.classList.remove("is-loading");
            downloadLabel.textContent = "Download PDF";
        }
    });

    document.querySelectorAll("[data-rb-view]").forEach((button) => {
        button.addEventListener("click", () => {
            const view = button.dataset.rbView;
            document.getElementById("rb-workspace").dataset.rbView = view;
            document.querySelectorAll("[data-rb-view]").forEach((tab) => {
                const active = tab === button;
                tab.classList.toggle("is-active", active);
                tab.setAttribute("aria-pressed", String(active));
            });
            resizePreview();
        });
    });

    document.querySelectorAll("[data-rb-section]").forEach((button) => {
        button.addEventListener("click", () => {
            const key = button.dataset.rbSection;
            const section = document.getElementById(`rb-section-${key}`);
            if (section) {
                section.open = true;
                section.scrollIntoView({ behavior: "smooth", block: "start" });
            }
            document.querySelectorAll(".rb-builder-nav [data-rb-section]").forEach((navButton) => {
                if (!navButton.classList.contains("rb-builder-nav__add")) {
                    navButton.classList.toggle("is-active", navButton === button);
                }
            });
        });
    });

    document.getElementById("rb-preview-zoom-out").addEventListener("click", () => {
        previewZoom = Math.max(60, previewZoom - 10);
        resizePreview();
    });
    document.getElementById("rb-preview-zoom-in").addEventListener("click", () => {
        previewZoom = Math.min(140, previewZoom + 10);
        resizePreview();
    });
    document.getElementById("rb-preview-prev").addEventListener("click", () => {
        previewStage.parentElement.scrollBy({ top: -1123 * (parseFloat(getComputedStyle(previewPaper).getPropertyValue("--rb-paper-scale")) || 1), behavior: "smooth" });
    });
    document.getElementById("rb-preview-next").addEventListener("click", () => {
        previewStage.parentElement.scrollBy({ top: 1123 * (parseFloat(getComputedStyle(previewPaper).getPropertyValue("--rb-paper-scale")) || 1), behavior: "smooth" });
    });
    document.getElementById("rb-preview-fullscreen").addEventListener("click", (event) => {
        const expanded = document.getElementById("rb-workspace").classList.toggle("rb-preview-expanded");
        event.currentTarget.setAttribute("aria-pressed", String(expanded));
        event.currentTarget.setAttribute("aria-label", expanded ? "Restore editor and preview" : "Expand preview");
        resizePreview();
    });
    document.querySelector(".rb-preview-pane").addEventListener("scroll", () => {
        const scale = parseFloat(getComputedStyle(previewPaper).getPropertyValue("--rb-paper-scale")) || 1;
        updatePreviewPages(scale);
    }, { passive: true });

    window.addEventListener("resize", resizePreview);
    window.addEventListener("beforeunload", (event) => {
        if (changed || inFlight) {
            event.preventDefault();
            event.returnValue = "";
        }
    });

    renderEditor();
    document.getElementById("rb-template-select").value = state.template || "modern";
    document.getElementById("rb-resume-title").value = state.title || "My Resume";
    renderPreview();
    if (documentId) setStatus("Saved", "saved");

    async function handleTailorRequest() {
        if (loadingAi || activeSuggestion?.action !== "tailor") return;
        const jobDescription = document.getElementById("rb-ai-job-description").value.trim();
        if (!jobDescription) {
            aiError.textContent = "Paste a target job description first.";
            return;
        }
        await requestAi("tailor", activeSuggestion.target, jobDescription);
    }

    if (documentId) {
        const deleteButton = document.getElementById("rb-delete-document");
        if (deleteButton) deleteButton.hidden = false;
    }
}
