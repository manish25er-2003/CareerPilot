<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resume Builder | CareerPilot AI</title>
    @vite(['resources/css/pages/resume-builder.css'])
</head>
<body class="resume-builder-body">
    <div class="rb-library">
        <header class="rb-library__toolbar">
            <a class="rb-brand" href="{{ route('dashboard') }}"><span class="rb-brand__mark">✦</span><span>CareerPilot <strong>AI</strong></span></a>
            <a class="rb-back-link" href="{{ route('dashboard') }}">← Back to dashboard</a>
        </header>
        <main class="rb-library__main">
            <div class="rb-library__heading">
                <div><span class="rb-eyebrow">Career documents</span><h1>Your resume builder</h1><p>Create and manage resumes tailored to your next opportunity.</p></div>
                <a class="rb-primary-button rb-library__create" href="{{ route('resume-builder.create') }}">Create a resume <span aria-hidden="true">+</span></a>
            </div>
            @if ($documents->isEmpty())
            <section class="rb-library-empty">
                <div class="rb-library-empty__icon" aria-hidden="true">CV</div>
                <h2>Your resume workspace is ready</h2>
                <p>Start with your experience, add your skills, and preview a polished resume as you go.</p>
                <a class="rb-primary-button" href="{{ route('resume-builder.create') }}">Build My Resume</a>
            </section>
            @else
            <div class="rb-library-grid">
                @foreach ($documents as $document)
                <article class="rb-library-card">
                    <div class="rb-library-card__icon" aria-hidden="true">CV</div>
                    <div class="rb-library-card__content">
                        <h2>{{ $document->title }}</h2>
                        <p>{{ ucfirst($document->template) }} template · Updated {{ $document->updated_at->diffForHumans() }}</p>
                        <div class="rb-library-card__actions">
                            <a href="{{ route('resume-builder.edit', $document->id) }}">Edit</a>
                            <a href="{{ route('resume-builder.preview', $document->id) }}">Preview</a>
                            <a href="{{ route('resume-builder.download', $document->id) }}">Download PDF</a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            @endif
        </main>
    </div>
</body>
</html>
