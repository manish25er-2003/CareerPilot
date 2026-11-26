<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $document?->title ?: 'Resume Builder' }} | CareerPilot AI</title>
    @vite(['resources/css/pages/resume-builder.css', 'resources/js/resume-builder.js'])
</head>
<body class="resume-builder-body">
    <div class="rb-app" id="resume-builder-app">
        <header class="rb-toolbar">
            <a class="rb-brand" href="{{ route('dashboard') }}" aria-label="CareerPilot AI dashboard">
                <span class="rb-brand__mark">✦</span>
                <span>CareerPilot <strong>AI</strong></span>
            </a>
            <a class="rb-back-link" href="{{ route('dashboard') }}">← <span>Dashboard</span></a>
            <label class="rb-title-control">
                <span class="rb-title-control__icon" aria-hidden="true">▤</span>
                <span class="rb-visually-hidden">Resume name</span>
                <input id="rb-resume-title" type="text" maxlength="120" value="{{ $initialData['title'] ?? 'My Resume' }}" aria-label="Resume name">
                <span class="rb-title-control__edit" aria-hidden="true">✎</span>
            </label>
            <label class="rb-template-control">
                <span class="rb-visually-hidden">Resume template</span>
                <select id="rb-template-select" aria-label="Resume template">
                    <option value="modern">Modern Professional</option>
                    <option value="classic">Classic Professional</option>
                    <option value="executive">Executive</option>
                    <option value="creative">Creative</option>
                </select>
            </label>
            <div class="rb-header-palette" role="group" aria-label="Quick resume colors">
                <button type="button" data-header-accent="#704CE3" style="--swatch:#704CE3" aria-label="Purple theme"></button>
                <button type="button" data-header-accent="#159CE8" style="--swatch:#159CE8" aria-label="Blue theme"></button>
                <button type="button" data-header-accent="#17B963" style="--swatch:#17B963" aria-label="Green theme"></button>
                <button type="button" data-header-accent="#ED4585" style="--swatch:#ED4585" aria-label="Pink theme"></button>
                <button type="button" data-header-accent="#26293B" style="--swatch:#26293B" aria-label="Dark theme"></button>
                <button type="button" class="rb-color-trigger" id="rb-color-trigger" aria-label="More color options" title="More color options">＋</button>
            </div>
            <div class="rb-save-status" id="rb-save-status" role="status" aria-live="polite">
                <span class="rb-save-status__dot"></span>
                <span id="rb-save-status-text">Unsaved</span>
            </div>
            @if ($document)
            <a class="rb-toolbar-button rb-preview-link" href="{{ route('resume-builder.preview', $document->id) }}" target="_blank" rel="noopener">Preview</a>
            @else
            <a class="rb-toolbar-button rb-preview-link" id="rb-preview-link" href="#" target="_blank" rel="noopener" hidden>Preview</a>
            @endif
            <a class="rb-download-button" id="rb-download-link" href="{{ $document ? route('resume-builder.download', $document->id) : '#' }}" @if (!$document) aria-disabled="true" @endif>
                <span aria-hidden="true">↓</span> Download PDF
            </a>
        </header>

        <main class="rb-workspace" id="rb-workspace" data-rb-view="editor">
            <aside class="rb-builder-nav" aria-label="Resume sections">
                <h2>Resume Builder</h2>
                <div class="rb-completion-card" aria-label="Resume completion">
                    <div class="rb-completion-ring" id="rb-completion-ring" style="--rb-progress:0%">
                        <span id="rb-progress-value">0%</span>
                    </div>
                    <strong>Completion</strong>
                </div>
                <button type="button" class="is-active" data-rb-section="personal"><span class="rb-builder-nav__icon">◎</span><span>Personal Info</span><i aria-hidden="true">✓</i></button>
                <button type="button" data-rb-section="experience"><span class="rb-builder-nav__icon">▰</span><span>Experience</span><i aria-hidden="true"></i></button>
                <button type="button" data-rb-section="education"><span class="rb-builder-nav__icon">◫</span><span>Education</span><i aria-hidden="true"></i></button>
                <button type="button" data-rb-section="skills"><span class="rb-builder-nav__icon">◇</span><span>Skills</span><i aria-hidden="true"></i></button>
                <button type="button" data-rb-section="projects"><span class="rb-builder-nav__icon">▣</span><span>Projects</span><i aria-hidden="true"></i></button>
                <button type="button" data-rb-section="certifications"><span class="rb-builder-nav__icon">♙</span><span>Certifications</span><i aria-hidden="true"></i></button>
                <button type="button" data-rb-section="languages"><span class="rb-builder-nav__icon">◉</span><span>Languages</span><i aria-hidden="true"></i></button>
                <button type="button" data-rb-section="additional"><span class="rb-builder-nav__icon">•••</span><span>More Sections</span><i aria-hidden="true"></i></button>
                <button type="button" class="rb-builder-nav__add" data-rb-section="additional"><span>＋</span><span>Add Section</span></button>
                <section class="rb-nav-ai-card">
                    <span class="rb-nav-ai-card__spark" aria-hidden="true">✦</span>
                    <strong>Let AI do the hard work!</strong>
                    <p>Improve your content with AI assistance.</p>
                    <button type="button" data-ai-action="summary" data-ai-target="personal_information.summary">Open AI Assistant <span aria-hidden="true">→</span></button>
                </section>
            </aside>
            <nav class="rb-mobile-tabs" aria-label="Resume builder panels">
                <button type="button" class="is-active" data-rb-view="editor" aria-pressed="true">Edit details</button>
                <button type="button" data-rb-view="preview" aria-pressed="false">Live preview</button>
            </nav>
            <section class="rb-editor-pane" aria-label="Resume details editor">
                <div class="rb-editor-heading">
                    <div>
                        <span class="rb-editor-heading__icon" aria-hidden="true">▤</span>
                        <div class="rb-editor-heading__copy"><h1>Build Your Resume</h1><p>Add your details, and see the live preview update instantly.</p></div>
                    </div>
                    <div class="rb-ats-score" aria-label="ATS score">
                        <span class="rb-ats-score__label">ATS Score</span>
                        <span class="rb-ats-score__ring"><strong id="rb-ats-score">87</strong></span>
                        <small>/100</small>
                        <button type="button" aria-label="About ATS score" title="Estimated from resume completion; not a full ATS scan.">i</button>
                    </div>
                </div>

                <div class="rb-editor-form" id="rb-editor-form"></div>
                <div class="rb-editor-footer">
                    <span id="rb-form-message" role="status" aria-live="polite"></span>
                    <button type="button" class="rb-icon-button rb-delete-button" id="rb-delete-document" aria-label="Delete this resume" title="Delete resume" @if (!$document) hidden @endif>⌫</button>
                    <button type="button" class="rb-primary-button" id="rb-save-button">Save now</button>
                </div>
            </section>

            <aside class="rb-preview-pane" aria-label="Live resume preview">
                <div class="rb-preview-toolbar">
                    <button type="button" class="rb-preview-page-button" id="rb-preview-prev" aria-label="Previous page" disabled>‹</button>
                    <span class="rb-preview-page-label">Page <strong id="rb-preview-page">1</strong> of <strong id="rb-preview-pages">1</strong></span>
                    <button type="button" class="rb-preview-page-button" id="rb-preview-next" aria-label="Next page" disabled>›</button>
                    <span class="rb-preview-toolbar__divider"></span>
                    <button type="button" class="rb-preview-zoom-button" id="rb-preview-zoom-out" aria-label="Zoom out">−</button>
                    <span class="rb-preview-zoom-value" id="rb-preview-zoom-value">100%</span>
                    <button type="button" class="rb-preview-zoom-button" id="rb-preview-zoom-in" aria-label="Zoom in">＋</button>
                    <button type="button" class="rb-preview-fullscreen" id="rb-preview-fullscreen" aria-label="Expand preview" aria-pressed="false">⛶</button>
                </div>
                <div class="rb-preview-stage" id="rb-preview-stage">
                    <div class="rb-preview-paper" id="rb-preview-paper"></div>
                </div>
            </aside>
        </main>
    </div>

    <dialog class="rb-dialog" id="rb-color-dialog" aria-labelledby="rb-color-title">
        <form method="dialog" class="rb-dialog__form">
            <div class="rb-dialog__header">
                <div>
                    <span class="rb-eyebrow">Personalize your resume</span>
                    <h2 id="rb-color-title">Color theme</h2>
                </div>
                <button class="rb-icon-button" value="cancel" aria-label="Close color settings">×</button>
            </div>
            <div class="rb-color-presets" aria-label="Preset colors">
                <button type="button" class="rb-color-preset" data-accent="#704CE3" style="--swatch:#704CE3">Purple</button>
                <button type="button" class="rb-color-preset" data-accent="#173B73" style="--swatch:#173B73">Navy Blue</button>
                <button type="button" class="rb-color-preset" data-accent="#2563EB" style="--swatch:#2563EB">Professional Blue</button>
                <button type="button" class="rb-color-preset" data-accent="#16865D" style="--swatch:#16865D">Emerald Green</button>
                <button type="button" class="rb-color-preset" data-accent="#8A2343" style="--swatch:#8A2343">Burgundy</button>
                <button type="button" class="rb-color-preset" data-accent="#44464F" style="--swatch:#44464F">Black &amp; Grey</button>
                <button type="button" class="rb-color-preset" data-accent="#07818A" style="--swatch:#07818A">Teal</button>
            </div>
            <label class="rb-color-input">
                <span>Accent color</span>
                <input id="rb-accent-color" type="color" value="#704ce3" data-color-field="theme_color">
            </label>
            <label class="rb-color-input">
                <span>Section heading color</span>
                <input id="rb-heading-color" type="color" value="#292044" data-color-field="heading_color">
            </label>
            <p class="rb-dialog-note">Choose readable colors. The preview updates immediately.</p>
        </form>
    </dialog>

    <dialog class="rb-dialog rb-ai-dialog" id="rb-ai-dialog" aria-labelledby="rb-ai-title">
        <form method="dialog" class="rb-dialog__form">
            <div class="rb-dialog__header">
                <div>
                    <span class="rb-eyebrow">AI writing assistant</span>
                    <h2 id="rb-ai-title">Review suggestion</h2>
                </div>
                <button class="rb-icon-button" value="cancel" aria-label="Close AI suggestion">×</button>
            </div>
            <p class="rb-dialog-note">Review the suggestion before using it. AI may be wrong; verify every detail.</p>
            <label class="rb-ai-job-description" id="rb-ai-job-description-wrap" hidden>
                <span>Target job description</span>
                <textarea id="rb-ai-job-description" rows="5" maxlength="12000" placeholder="Paste the role description you want to target."></textarea>
            </label>
            <div class="rb-ai-result" id="rb-ai-result"></div>
            <div class="rb-ai-error" id="rb-ai-error" role="alert"></div>
            <div class="rb-dialog__actions">
                <button type="button" class="rb-secondary-button" id="rb-ai-cancel">Cancel</button>
                <button type="button" class="rb-secondary-button" id="rb-ai-generate" hidden>Generate suggestion</button>
                <button type="button" class="rb-primary-button" id="rb-ai-accept" disabled>Use suggestion</button>
            </div>
        </form>
    </dialog>

    <script>
        window.resumeBuilderConfig = {{ \Illuminate\Support\Js::from([
            'documentId' => $document?->id,
            'initialData' => $initialData,
            'storeUrl' => route('resume-builder.store'),
            'urlTemplates' => [
                'edit' => route('resume-builder.edit', ['id' => '__ID__']),
                'update' => route('resume-builder.update', ['id' => '__ID__']),
                'preview' => route('resume-builder.preview', ['id' => '__ID__']),
                'download' => route('resume-builder.download', ['id' => '__ID__']),
                'photoUpload' => route('resume-builder.photo.upload', ['id' => '__ID__']),
                'ai' => route('resume-builder.ai', ['id' => '__ID__']),
                'delete' => route('resume-builder.destroy', ['id' => '__ID__']),
            ],
            'photoUrl' => $photoUrl,
            'csrfToken' => csrf_token(),
        ]) }};
    </script>
</body>
</html>
