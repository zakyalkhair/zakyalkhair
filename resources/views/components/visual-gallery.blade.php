@props(['heading' => '', 'description' => '', 'visuals' => []])

@php
    $initial = $visuals[0] ?? [
        'title' => '',
        'description' => '',
        'image' => '',
    ];
    $galleryId = 'projectGallery-' . uniqid();
    $modalId = 'projectImageModal-' . uniqid();
@endphp

<section id="visuals">
    <div class="container">
        <div class="section-heading">
            <h2>{{ $heading }}</h2>
            <p>{{ $description }}</p>
        </div>

        <div class="gallery-layout" data-project-gallery="{{ $galleryId }}">
            <div class="gallery-tabs" role="tablist" aria-label="Analysis visuals">
                @foreach ($visuals as $index => $visual)
                    <button class="tab-button {{ $index === 0 ? 'active' : '' }}" type="button"
                        data-title="{{ $visual['title'] ?? '' }}"
                        data-desc="{{ $visual['description'] ?? '' }}"
                        data-img="{{ $visual['image'] ?? '' }}">
                        <strong>{{ $visual['tabTitle'] ?? $visual['title'] ?? '' }}</strong>
                        <span>{{ $visual['tabDescription'] ?? $visual['description'] ?? '' }}</span>
                    </button>
                @endforeach
            </div>

            <article class="visual-card spotlight-card" data-spotlight-color="rgba(246, 207, 97, .12)">
                <div class="visual-frame">
                    <img class="visual-image" src="{{ $initial['image'] ?? '' }}" alt="{{ $initial['title'] ?? 'Project visual' }} visual">
                </div>

                <div class="visual-caption">
                    <div>
                        <h3 class="visual-title">{{ $initial['title'] ?? '' }}</h3>
                        <p class="visual-desc">{{ $initial['description'] ?? '' }}</p>
                    </div>

                    <button class="open-btn" type="button">Open Image</button>
                </div>
            </article>
        </div>
    </div>
</section>

<div class="image-modal" data-project-modal="{{ $modalId }}" aria-hidden="true">
    <div class="modal-inner">
        <button class="modal-close" type="button" aria-label="Close image preview">×</button>
        <img class="modal-image" src="{{ $initial['image'] ?? '' }}" alt="Expanded project visual">
    </div>
</div>
