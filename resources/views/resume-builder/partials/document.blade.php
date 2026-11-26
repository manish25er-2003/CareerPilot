<article class="rb-resume-document rb-template-{{ $document->template }}" style="--rb-accent: {{ $document->theme_color }}; --rb-heading: {{ $document->heading_color }};">
    @php
        $personal = $document->personal_information ?? [];
        $experience = array_values(array_filter($document->work_experience ?? [], fn ($item) => filled($item['job_title'] ?? null) || filled($item['company'] ?? null) || filled($item['responsibilities'] ?? null) || filled($item['achievements'] ?? [])));
        $education = array_values(array_filter($document->education ?? [], fn ($item) => filled($item['degree'] ?? null) || filled($item['institution'] ?? null)));
        $skills = array_values(array_filter($document->skills ?? [], fn ($item) => filled($item['name'] ?? null)));
        $projects = array_values(array_filter($document->projects ?? [], fn ($item) => filled($item['name'] ?? null) || filled($item['description'] ?? null)));
        $certifications = array_values(array_filter($document->certifications ?? [], fn ($item) => filled($item['name'] ?? null)));
        $languages = array_values(array_filter($document->languages ?? [], fn ($item) => filled($item['name'] ?? null)));
        $additionalSections = array_values(array_filter($document->additional_sections ?? [], fn ($item) => filled($item['title'] ?? null) || filled($item['content'] ?? null)));
    @endphp

    <header class="rb-doc-header">
        @if (! empty($photoUrl ?? null))
        <img class="rb-doc-photo" src="{{ $photoUrl }}" alt="Profile photo">
        @elseif (! empty($photoDataUri ?? null))
        <img class="rb-doc-photo" src="{{ $photoDataUri }}" alt="Profile photo">
        @endif
        <div class="rb-doc-identity">
            <h1>{{ $personal['name'] ?? '' ?: 'Your Name' }}</h1>
            @if (filled($personal['job_title'] ?? null))
            <p class="rb-doc-job-title">{{ $personal['job_title'] }}</p>
            @endif
            <div class="rb-doc-contact">
                @foreach (['email' => 'Email', 'phone' => 'Phone', 'location' => 'Location'] as $field => $label)
                    @if (filled($personal[$field] ?? null))
                    <span>{{ $personal[$field] }}</span>
                    @endif
                @endforeach
                @foreach (['linkedin' => 'LinkedIn', 'portfolio' => 'Portfolio'] as $field => $label)
                    @if (filled($personal[$field] ?? null))
                    <span>{{ $personal[$field] }}</span>
                    @endif
                @endforeach
            </div>
        </div>
    </header>

    @if (filled($personal['summary'] ?? null))
    <section class="rb-doc-section">
        <h2>Professional Summary</h2>
        <p class="rb-doc-summary">{{ $personal['summary'] }}</p>
    </section>
    @endif

    @if ($experience !== [])
    <section class="rb-doc-section">
        <h2>Work Experience</h2>
        @foreach ($experience as $item)
        <div class="rb-doc-entry">
            <div class="rb-doc-entry__heading">
                <strong>{{ $item['job_title'] ?? '' }}</strong>
                <span>{{ $item['start_date'] ?? '' }}{{ ! empty($item['start_date']) || ! empty($item['end_date']) ? ' – ' : '' }}{{ ! empty($item['current']) ? 'Present' : ($item['end_date'] ?? '') }}</span>
            </div>
            <div class="rb-doc-entry__subheading">
                <span>{{ $item['company'] ?? '' }}{{ ! empty($item['location']) ? ' · '.$item['location'] : '' }}</span>
                @if (filled($item['employment_type'] ?? null))<span>{{ $item['employment_type'] }}</span>@endif
            </div>
            @if (filled($item['responsibilities'] ?? null))
            <p class="rb-doc-body">{{ $item['responsibilities'] }}</p>
            @endif
            @if (! empty($item['achievements']))
            <ul class="rb-doc-bullets">
                @foreach ($item['achievements'] as $achievement)
                    @if (filled($achievement))<li>{{ $achievement }}</li>@endif
                @endforeach
            </ul>
            @endif
        </div>
        @endforeach
    </section>
    @endif

    @if ($education !== [])
    <section class="rb-doc-section">
        <h2>Education</h2>
        @foreach ($education as $item)
        <div class="rb-doc-entry">
            <div class="rb-doc-entry__heading">
                <strong>{{ $item['degree'] ?? '' }}{{ filled($item['field'] ?? null) ? ' · '.$item['field'] : '' }}</strong>
                <span>{{ $item['start_year'] ?? '' }}{{ ! empty($item['start_year']) || ! empty($item['end_year']) ? ' – ' : '' }}{{ $item['end_year'] ?? '' }}</span>
            </div>
            <div class="rb-doc-entry__subheading">
                <span>{{ $item['institution'] ?? '' }}</span>
                @if (filled($item['grade'] ?? null))<span>{{ $item['grade'] }}</span>@endif
            </div>
            @if (filled($item['description'] ?? null))<p class="rb-doc-body">{{ $item['description'] }}</p>@endif
        </div>
        @endforeach
    </section>
    @endif

    @if ($skills !== [])
    <section class="rb-doc-section">
        <h2>Skills</h2>
        <div class="rb-doc-skills">
            @foreach ($skills as $skill)
            <span>{{ $skill['name'] }}@if (filled($skill['proficiency'] ?? null))<small> · {{ $skill['proficiency'] }}</small>@endif</span>
            @endforeach
        </div>
    </section>
    @endif

    @if ($projects !== [])
    <section class="rb-doc-section">
        <h2>Projects</h2>
        @foreach ($projects as $item)
        <div class="rb-doc-entry">
            <div class="rb-doc-entry__heading"><strong>{{ $item['name'] ?? '' }}</strong><span>{{ $item['start_date'] ?? '' }}{{ ! empty($item['start_date']) || ! empty($item['end_date']) ? ' – ' : '' }}{{ $item['end_date'] ?? '' }}</span></div>
            @if (filled($item['technologies'] ?? null))<div class="rb-doc-entry__subheading"><span>{{ $item['technologies'] }}</span></div>@endif
            @if (filled($item['description'] ?? null))<p class="rb-doc-body">{{ $item['description'] }}</p>@endif
            @if (filled($item['url'] ?? null))<div class="rb-doc-link">{{ $item['url'] }}</div>@endif
        </div>
        @endforeach
    </section>
    @endif

    @if ($certifications !== [])
    <section class="rb-doc-section">
        <h2>Certifications</h2>
        @foreach ($certifications as $item)
        <div class="rb-doc-entry">
            <div class="rb-doc-entry__heading"><strong>{{ $item['name'] ?? '' }}</strong><span>{{ $item['issue_date'] ?? '' }}</span></div>
            <div class="rb-doc-entry__subheading"><span>{{ $item['organization'] ?? '' }}</span></div>
            @if (filled($item['credential_url'] ?? null))<div class="rb-doc-link">{{ $item['credential_url'] }}</div>@endif
        </div>
        @endforeach
    </section>
    @endif

    @if ($languages !== [])
    <section class="rb-doc-section">
        <h2>Languages</h2>
        <div class="rb-doc-list-inline">
            @foreach ($languages as $item)
            <span><strong>{{ $item['name'] }}</strong>{{ filled($item['proficiency'] ?? null) ? ' · '.$item['proficiency'] : '' }}</span>
            @endforeach
        </div>
    </section>
    @endif

    @foreach ($additionalSections as $item)
    <section class="rb-doc-section">
        <h2>{{ $item['title'] ?? ucfirst($item['type'] ?? 'Additional Information') }}</h2>
        <p class="rb-doc-body">{{ $item['content'] ?? '' }}</p>
    </section>
    @endforeach
</article>
