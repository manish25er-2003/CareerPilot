<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preview: {{ $document->title }} | CareerPilot AI</title>
    @vite(['resources/css/pages/resume-builder.css'])
</head>
<body class="resume-builder-body rb-preview-only">
    <header class="rb-preview-toolbar">
        <a class="rb-brand" href="{{ route('dashboard') }}"><span class="rb-brand__mark">✦</span><span>CareerPilot <strong>AI</strong></span></a>
        <div class="rb-preview-toolbar__actions">
            <a class="rb-toolbar-button" href="{{ route('resume-builder.edit', $document->id) }}">Edit Resume</a>
            <a class="rb-download-button" href="{{ route('resume-builder.download', $document->id) }}">↓ Download PDF</a>
        </div>
    </header>
    <main class="rb-preview-only__stage">
        <div class="rb-preview-paper">
            @include('resume-builder.partials.document')
        </div>
    </main>
</body>
</html>
