@extends('layouts.dashboard')

@section('title', 'My Resumes | CareerPilot AI')

@section('content')
<div class="resumes-page" data-resume-page>
    <header class="resumes-page__hero">
        <div class="resumes-page__title">
            <span class="resumes-page__title-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M7 3.5h7l5 5V20a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2V5.5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                    <path d="M14 4v5h5m-9 4h5m-5 3h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </span>
            <div>
                <h1>My Resumes</h1>
                <p>Manage your resumes and upload new ones to get started.</p>
            </div>
        </div>

        <div class="resumes-page__hero-art" aria-hidden="true">
            <svg viewBox="0 0 200 122" fill="none">
                <path d="M0 94c31-10 46-22 75-18 29 4 41 21 68 15 20-4 34-13 57-13v44H0V94Z" fill="#EEE9FF" />
                <path d="M0 103c34-11 49-18 76-14 28 4 42 17 68 11 19-4 34-11 56-12" stroke="#D8CEFF" stroke-width="2" />
                <rect x="41" y="12" width="71" height="83" rx="8" transform="rotate(-7 41 12)" fill="white" stroke="#A18AF0" stroke-width="2" />
                <rect x="68" y="8" width="73" height="87" rx="8" transform="rotate(5 68 8)" fill="white" stroke="#A18AF0" stroke-width="2" />
                <rect x="70" y="17" width="72" height="76" rx="8" fill="white" stroke="#8065E8" stroke-width="2.5" />
                <circle cx="106" cy="39" r="11" fill="#8C70EF" />
                <path d="M89 68c2-10 8-15 17-15s15 5 17 15" fill="#704CE3" />
                <path d="M88 77h36m-36 7h27" stroke="#C9BDF8" stroke-width="4" stroke-linecap="round" />
                <path d="M144 92V65a22 22 0 0 1 44 0v27a3 3 0 0 1-3 3h-38a3 3 0 0 1-3-3Z" fill="#714CE0" />
                <path d="m166 80 0-30m0 0-10 10m10-10 10 10" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="m176 25 6-7m4 14 8-2m-19-9 1-7" stroke="#9A80F2" stroke-width="2.5" stroke-linecap="round" />
            </svg>
        </div>
    </header>

    <section class="resumes-card resumes-upload-card" aria-labelledby="resume-upload-title">
        <header class="resumes-card__heading">
            <span class="resumes-card__heading-icon resumes-card__heading-icon--large" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M12 16V4m0 0L7.5 8.5M12 4l4.5 4.5M5 14v4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <div>
                <h2 id="resume-upload-title">Upload Your Resume</h2>
                <p>Upload a resume to keep your career documents in one place.</p>
            </div>
        </header>

        <form method="POST" action="{{ route('resumes.store') }}" enctype="multipart/form-data" class="resume-upload-form">
            @csrf
            <div class="resume-upload-form__main">
                <label for="resume-file" class="resume-dropzone">
                    <span class="resume-dropzone__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M12 16V4m0 0L7.5 8.5M12 4l4.5 4.5M5 14v4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <strong>Drag and drop your resume here</strong>
                    <span class="resume-dropzone__hint">or choose a file from your device</span>
                    <span class="resume-dropzone__filename" data-resume-file-name aria-live="polite" hidden></span>
                    <input id="resume-file" class="resume-dropzone__input" type="file" name="file" accept=".pdf,.docx,.txt" aria-label="Choose a resume file" aria-describedby="resume-file-rules" required>
                </label>

                <div class="resume-upload-form__details">
                    <div class="resume-title-field">
                        <label for="resume-title">Resume title <span>(optional)</span></label>
                        <input id="resume-title" type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Product Analyst Resume" maxlength="150" aria-invalid="{{ $errors->has('title') ? 'true' : 'false' }}">
                    </div>
                    <p id="resume-file-rules">PDF, DOCX, or TXT · Up to 5 MB</p>
                    <div class="resume-upload-form__actions">
                        <label for="resume-file" class="resume-action-button resume-action-button--choose">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M3 7.5A2.5 2.5 0 0 1 5.5 5H10l2 2h6.5A2.5 2.5 0 0 1 21 9.5v8a2.5 2.5 0 0 1-2.5 2.5h-13A2.5 2.5 0 0 1 3 17.5v-10Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                            </svg>
                            Choose File
                        </label>
                        <button type="submit" class="resume-action-button resume-action-button--upload">
                            Upload Resume
                        </button>
                    </div>
                </div>
            </div>

            @error('file')
            <div class="resume-field-error">{{ $message }}</div>
            @enderror
            @error('title')
            <div class="resume-field-error">{{ $message }}</div>
            @enderror
        </form>
    </section>

    <section class="resumes-card resumes-list-card" aria-labelledby="resumes-list-title">
        <header class="resumes-card__heading resumes-list-card__heading">
            <span class="resumes-card__heading-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <rect x="4" y="4" width="5" height="5" rx="1" fill="currentColor" />
                    <rect x="4" y="11" width="5" height="5" rx="1" fill="currentColor" />
                    <rect x="4" y="18" width="5" height="2" rx="1" fill="currentColor" />
                    <path d="M12 6.5h8M12 13.5h8M12 19h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </span>
            <div>
                <h2 id="resumes-list-title">Your Resumes</h2>
                <p>View and manage your uploaded resumes.</p>
            </div>
            <div class="resumes-list-card__filter">
                <label for="resume-type-filter" class="visually-hidden">Filter resumes by file type</label>
                <select id="resume-type-filter" aria-label="Filter resumes by file type">
                    <option value="all">All Files</option>
                    <option value="pdf">PDF</option>
                    <option value="docx">DOCX</option>
                    <option value="txt">TXT</option>
                </select>
            </div>
        </header>

        <div class="resumes-table-wrap">
            <table class="resumes-table">
                <thead>
                    <tr>
                        <th scope="col">File Name</th>
                        <th scope="col">File Type</th>
                        <th scope="col">Upload Date</th>
                        <th scope="col">Size</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($resumes as $resume)
                    @php
                    $extension = strtolower(pathinfo($resume->original_name, PATHINFO_EXTENSION));
                    @endphp
                    <tr data-resume-row data-file-type="{{ $extension }}">
                        <td>
                            <div class="resume-file-cell">
                                <span class="resume-file-cell__icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <path d="M7 3.5h7l5 5V20a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2V5.5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                        <path d="M14 4v5h5m-9 4h5m-5 3h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                    </svg>
                                </span>
                                <span class="resume-file-cell__details">
                                    <strong>{{ $resume->title }}</strong>
                                    <small>{{ $resume->original_name }}</small>
                                </span>
                                @if ($resume->is_primary)
                                <span class="resume-primary-badge">Primary</span>
                                @endif
                            </div>
                        </td>
                        <td><span class="resume-type-label">{{ strtoupper($extension ?: 'FILE') }}</span></td>
                        <td>{{ $resume->created_at?->format('M d, Y') ?? '—' }}</td>
                        <td>
                            @if ($resume->size >= 1048576)
                            {{ number_format($resume->size / 1048576, 1) }} MB
                            @else
                            {{ number_format($resume->size / 1024, 0) }} KB
                            @endif
                        </td>
                        <td>
                            <div class="resume-row-actions">
                                <a href="{{ route('resumes.download', $resume->id) }}" class="resume-icon-button" aria-label="Download {{ $resume->title }}" title="Download">
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M12 4v11m0 0 4-4m-4 4-4-4m-3 8h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                @unless ($resume->is_primary)
                                <form method="POST" action="{{ route('resumes.primary', $resume->id) }}">
                                    @csrf
                                    <button type="submit" class="resume-icon-button" aria-label="Set {{ $resume->title }} as primary" title="Set as primary">
                                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.6l6.2-.9L12 3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>
                                @endunless
                                <form method="POST" action="{{ route('resumes.destroy', $resume->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="resume-icon-button resume-icon-button--danger" aria-label="Delete {{ $resume->title }}" title="Delete">
                                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M4 7h16m-10 4v6m4-6v6M6 7l1 14h10l1-14M9 7V4h6v3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="resumes-empty-state">
                                <span class="resumes-empty-state__icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <path d="M7 3.5h7l5 5V20a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2V5.5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                        <path d="M14 4v5h5m-9 4h5m-5 3h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                    </svg>
                                </span>
                                <strong>No resumes uploaded yet</strong>
                                <span>Upload your first resume to keep it ready for analysis.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    @if ($resumes->isNotEmpty())
                    <tr data-resume-no-match hidden>
                        <td colspan="5">
                            <div class="resumes-empty-state resumes-empty-state--compact">
                                <strong>No resumes match this file type.</strong>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>
</div>

<script>
    (function() {
        const page = document.querySelector('[data-resume-page]');
        if (!page) return;

        const fileInput = page.querySelector('#resume-file');
        const fileName = page.querySelector('[data-resume-file-name]');
        if (fileInput && fileName) {
            fileInput.addEventListener('change', function() {
                const file = fileInput.files && fileInput.files[0];
                fileName.textContent = file ? file.name : '';
                fileName.hidden = !file;
            });
        }

        const typeFilter = page.querySelector('#resume-type-filter');
        const resumeRows = Array.from(page.querySelectorAll('[data-resume-row]'));
        const noMatchRow = page.querySelector('[data-resume-no-match]');
        if (typeFilter && noMatchRow) {
            typeFilter.addEventListener('change', function() {
                let visibleRows = 0;
                resumeRows.forEach(function(row) {
                    const matches = typeFilter.value === 'all' || row.dataset.fileType === typeFilter.value;
                    row.hidden = !matches;
                    if (matches) visibleRows++;
                });
                noMatchRow.hidden = visibleRows > 0;
            });
        }
    })();
</script>
@endsection
