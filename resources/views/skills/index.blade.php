@extends('layouts.dashboard')

@section('title', 'My Skills | CareerPilot AI')

@section('content')
@php
$skillCategories = $skills->pluck('category')->filter()->unique()->sort()->values();
@endphp
<div class="skills-page" data-skills-page>
    <header class="skills-page__hero">
        <div class="skills-page__title">
            <span class="skills-page__title-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="m12 3 9 4.5-9 4.5-9-4.5L12 3Zm-9 9 9 4.5 9-4.5M3 16.5l9 4.5 9-4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <div>
                <h1>My Skills</h1>
                <p>Add and manage your skills to build a stronger career profile.</p>
            </div>
        </div>

        <div class="skills-page__hero-art" aria-hidden="true">
            <svg viewBox="0 0 200 122" fill="none">
                <path d="M0 94c31-10 46-22 75-18 29 4 41 21 68 15 20-4 34-13 57-13v44H0V94Z" fill="#EEE9FF" />
                <path d="M0 103c34-11 49-18 76-14 28 4 42 17 68 11 19-4 34-11 56-12" stroke="#D8CEFF" stroke-width="2" />
                <rect x="34" y="12" width="87" height="70" rx="10" fill="white" stroke="#A18AF0" stroke-width="2" />
                <circle cx="48" cy="31" r="7" fill="#E9E3FF" />
                <path d="m45 31 2 2 4-5m-6 22 2 2 4-5m-6 22 2 2 4-5" stroke="#7254DC" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M63 30h43m-43 22h43M63 74h43" stroke="#D9D0FA" stroke-width="5" stroke-linecap="round" />
                <path d="m102 77 30-17 42 17-42 17-30-17Z" fill="#8061E8" />
                <path d="m112 82 20 9 20-9v12c-10 8-30 8-40 0V82Z" fill="#6744D4" />
                <path d="M174 78v21" stroke="#6744D4" stroke-width="3" stroke-linecap="round" />
                <path d="M170 100c0-4 2-6 4-6s4 2 4 6l-4 5-4-5Z" fill="#9A80F2" />
                <path d="m155 30 6-7m4 14 8-2m-19-9 1-7" stroke="#9A80F2" stroke-width="2.5" stroke-linecap="round" />
            </svg>
        </div>
    </header>

    <section class="skills-card skills-add-card" aria-labelledby="add-skill-title">
        <header class="skills-card__heading">
            <span class="skills-card__heading-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <rect x="3.5" y="3.5" width="17" height="17" rx="3" stroke="currentColor" stroke-width="1.8" />
                    <path d="M12 7.5v9m-4.5-4.5h9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </span>
            <div>
                <h2 id="add-skill-title">Add a New Skill</h2>
                <p>Add your skills, choose a category, and set your proficiency level.</p>
            </div>
        </header>

        <form method="POST" action="{{ route('skills.store') }}" class="skills-form row g-3">
            @csrf
            <div class="col-md-4">
                <label for="skill-name" class="form-label">Skill <span>*</span></label>
                <div class="skills-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="m12 3 9 4.5-9 4.5-9-4.5L12 3Zm-9 9 9 4.5 9-4.5M3 16.5l9 4.5 9-4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input id="skill-name" type="text" name="name" value="{{ old('name') }}" placeholder="e.g. React, Communication" maxlength="120" required aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}">
                </div>
                @error('name')
                <div class="skills-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="skill-category" class="form-label">Category <span>*</span></label>
                <div class="skills-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="m12 3 9 4.5-9 4.5-9-4.5L12 3Zm-9 9 9 4.5 9-4.5M3 16.5l9 4.5 9-4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input id="skill-category" type="text" name="category" list="skill-category-options" value="{{ old('category') }}" placeholder="Select or enter a category" maxlength="80" required aria-invalid="{{ $errors->has('category') ? 'true' : 'false' }}">
                    <datalist id="skill-category-options">
                        <option value="Development"></option>
                        <option value="Soft Skill"></option>
                        <option value="Management"></option>
                        <option value="Design"></option>
                        <option value="Data"></option>
                    </datalist>
                </div>
                @error('category')
                <div class="skills-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="skill-proficiency" class="form-label">Proficiency <span>*</span></label>
                <div class="skills-control">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 19v-5m5 5V9m5 10V5m5 14v-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <select id="skill-proficiency" name="proficiency_level" required aria-invalid="{{ $errors->has('proficiency_level') ? 'true' : 'false' }}">
                        @foreach (['Beginner', 'Intermediate', 'Advanced'] as $level)
                        <option value="{{ $level }}" @selected(old('proficiency_level', 'Beginner') === $level)>{{ $level }}</option>
                        @endforeach
                    </select>
                </div>
                @error('proficiency_level')
                <div class="skills-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="skill-description" class="form-label">Description <span class="skills-form__optional">(Optional)</span></label>
                <div class="skills-control skills-control--textarea">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 3.5h7l5 5V20a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2V5.5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                        <path d="M14 4v5h5m-9 4h5m-5 3h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                    </svg>
                    <textarea id="skill-description" name="description" rows="2" maxlength="500" placeholder="Add a short description about this skill..." aria-invalid="{{ $errors->has('description') ? 'true' : 'false' }}">{{ old('description') }}</textarea>
                </div>
                @error('description')
                <div class="skills-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 skills-form__actions">
                <button type="submit" class="skills-button skills-button--primary">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 5v14m-7-7h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    Add Skill
                </button>
                <button type="reset" class="skills-button skills-button--secondary">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M20 11a8 8 0 0 0-14.8-4L3 10m0-5v5h5m-4 3a8 8 0 0 0 14.8 4L21 14m0 5v-5h-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Clear
                </button>
            </div>
        </form>
    </section>

    <section class="skills-card skills-list-card" aria-labelledby="your-skills-title">
        <header class="skills-card__heading skills-list-card__heading">
            <span class="skills-card__heading-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <rect x="4" y="4" width="5" height="5" rx="1" fill="currentColor" />
                    <rect x="4" y="11" width="5" height="5" rx="1" fill="currentColor" />
                    <rect x="4" y="18" width="5" height="2" rx="1" fill="currentColor" />
                    <path d="M12 6.5h8M12 13.5h8M12 19h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </span>
            <div>
                <h2 id="your-skills-title">Your Skills</h2>
                <p>A list of your added skills and proficiency levels.</p>
            </div>
            <div class="skills-list-card__filter">
                <label for="skill-category-filter" class="visually-hidden">Filter skills by category</label>
                <select id="skill-category-filter" data-skill-category-filter aria-label="Filter skills by category">
                    <option value="all">All Categories</option>
                    @foreach ($skillCategories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
        </header>

        @forelse ($skills as $skill)
        @if ($loop->first)
        <div class="skills-grid">
        @endif
            <article class="skill-card" data-skill-card data-skill-category="{{ $skill->category }}">
                <span class="skill-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="m12 3 9 4.5-9 4.5-9-4.5L12 3Zm-9 9 9 4.5 9-4.5M3 16.5l9 4.5 9-4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <div class="skill-card__details">
                    <h3>{{ $skill->name }}</h3>
                    <span>{{ $skill->category }}</span>
                    @if ($skill->description)
                    <p>{{ $skill->description }}</p>
                    @endif
                </div>
                <span class="skill-proficiency-badge skill-proficiency-badge--{{ strtolower($skill->pivot->proficiency_level ?? 'Beginner') }}">
                    <svg viewBox="0 0 18 18" fill="none" aria-hidden="true">
                        <path d="M3 14V9m4 5V6m4 8V3m4 11V8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" />
                    </svg>
                    {{ $skill->pivot->proficiency_level ?? 'Beginner' }}
                </span>
                <details class="skill-card__menu">
                    <summary aria-label="Manage {{ $skill->name }}" title="Manage skill">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <circle cx="5" cy="12" r="1.6" />
                            <circle cx="12" cy="12" r="1.6" />
                            <circle cx="19" cy="12" r="1.6" />
                        </svg>
                    </summary>
                    <div class="skill-card__menu-panel">
                        <form method="POST" action="{{ route('skills.update', $skill->id) }}" class="skill-card__update-form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="name" value="{{ $skill->name }}">
                            <input type="hidden" name="category" value="{{ $skill->category }}">
                            <label for="skill-level-{{ $skill->id }}">Proficiency</label>
                            <select id="skill-level-{{ $skill->id }}" name="proficiency_level">
                                @foreach (['Beginner', 'Intermediate', 'Advanced'] as $level)
                                <option value="{{ $level }}" @selected(($skill->pivot->proficiency_level ?? 'Beginner') === $level)>{{ $level }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="skill-card__save-button">Save level</button>
                        </form>
                        <form method="POST" action="{{ route('skills.destroy', $skill->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="skill-card__remove-button">Remove skill</button>
                        </form>
                    </div>
                </details>
            </article>
        @if ($loop->last)
        </div>
        @endif
        @empty
        <div class="skills-empty-state">
            <span class="skills-empty-state__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="m12 3 9 4.5-9 4.5-9-4.5L12 3Zm-9 9 9 4.5 9-4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <strong>No skills added yet</strong>
            <span>Add your core strengths to build your career profile.</span>
        </div>
        @endforelse
        @if ($skills->isNotEmpty())
        <div class="skills-filter-empty" data-skill-filter-empty hidden>
            No skills in this category yet.
        </div>
        @endif
    </section>
</div>

<script>
    (function() {
        const page = document.querySelector('[data-skills-page]');
        if (!page) return;

        const filter = page.querySelector('[data-skill-category-filter]');
        const cards = Array.from(page.querySelectorAll('[data-skill-card]'));
        const emptyState = page.querySelector('[data-skill-filter-empty]');

        if (filter && emptyState) {
            filter.addEventListener('change', function() {
                let visibleCards = 0;
                cards.forEach(function(card) {
                    const matches = filter.value === 'all' || card.dataset.skillCategory === filter.value;
                    card.hidden = !matches;
                    if (matches) visibleCards++;
                });
                emptyState.hidden = visibleCards > 0;
            });
        }
    })();
</script>
@endsection
