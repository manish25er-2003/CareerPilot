<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style>
        @page { size: A4 portrait; margin: 15mm 16mm; }
        * { box-sizing: border-box; }
        body { margin: 0; color: #25283a; font-family: DejaVu Sans, sans-serif; font-size: 9pt; line-height: 1.45; }
        .rb-resume-document { color: #25283a; }
        .rb-doc-header { display: table; width: 100%; padding: 0 0 12pt; border-bottom: 2pt solid {{ $document->theme_color }}; }
        .rb-doc-photo { display: table-cell; width: 66pt; height: 66pt; margin-right: 12pt; border-radius: 50%; object-fit: cover; vertical-align: middle; }
        .rb-doc-identity { display: table-cell; vertical-align: middle; }
        .rb-doc-identity h1 { margin: 0; color: {{ $document->heading_color }}; font-size: 24pt; line-height: 1.12; }
        .rb-doc-job-title { margin: 4pt 0 0; color: {{ $document->theme_color }}; font-size: 11pt; font-weight: bold; }
        .rb-doc-contact { margin-top: 7pt; color: #4b5061; font-size: 8pt; }
        .rb-doc-contact span { margin-right: 10pt; }
        .rb-doc-section { margin-top: 13pt; page-break-inside: auto; }
        .rb-doc-section h2 { margin: 0 0 6pt; padding: 0 0 4pt; border-bottom: 0.8pt solid #e5e7ee; border-left: 2.5pt solid {{ $document->theme_color }}; padding-left: 6pt; color: {{ $document->heading_color }}; font-size: 10pt; font-weight: bold; text-transform: uppercase; letter-spacing: 0.7pt; page-break-after: avoid; }
        .rb-doc-summary, .rb-doc-body { margin: 0; white-space: pre-line; }
        .rb-doc-entry { margin: 0 0 8pt; page-break-inside: auto; }
        .rb-doc-entry__heading, .rb-doc-entry__subheading { display: table; width: 100%; }
        .rb-doc-entry__heading strong, .rb-doc-entry__heading span, .rb-doc-entry__subheading span { display: table-cell; }
        .rb-doc-entry__heading strong { color: #25283a; font-size: 9pt; }
        .rb-doc-entry__heading span { color: #656b7b; font-size: 8pt; text-align: right; white-space: nowrap; }
        .rb-doc-entry__subheading { margin-top: 2pt; color: {{ $document->theme_color }}; font-size: 8pt; font-weight: bold; }
        .rb-doc-entry__subheading span:last-child { text-align: right; }
        .rb-doc-bullets { margin: 4pt 0 0; padding-left: 15pt; }
        .rb-doc-bullets li { margin-bottom: 2pt; }
        .rb-doc-skills { margin-top: 2pt; }
        .rb-doc-skills span { display: inline-block; margin: 0 4pt 4pt 0; padding: 3pt 6pt; border: 0.5pt solid {{ $document->theme_color }}; border-radius: 3pt; color: {{ $document->theme_color }}; font-size: 8pt; }
        .rb-doc-skills small { font-size: 7pt; }
        .rb-doc-list-inline span { display: inline-block; margin: 0 12pt 4pt 0; }
        .rb-doc-link { margin-top: 2pt; color: {{ $document->theme_color }}; font-size: 8pt; }
        .rb-template-classic .rb-doc-header { text-align: center; border-bottom: 1pt solid #777; }
        .rb-template-classic .rb-doc-identity h1, .rb-template-classic .rb-doc-section h2 { font-family: DejaVu Serif, serif; }
        .rb-template-executive .rb-doc-header { padding: 14pt; background: {{ $document->heading_color }}; border-bottom: 4pt solid {{ $document->theme_color }}; }
        .rb-template-executive .rb-doc-identity h1, .rb-template-executive .rb-doc-contact { color: #fff; }
        .rb-template-creative .rb-doc-header { border-left: 5pt solid {{ $document->theme_color }}; padding-left: 10pt; }
    </style>
</head>
<body>
    @include('resume-builder.partials.document', ['photoUrl' => null])
</body>
</html>
