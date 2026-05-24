@props(['heading' => '', 'description' => '', 'steps' => []])

<section id="process">
    <div class="container">
        <div class="section-heading">
            <h2>{{ $heading }}</h2>
            <p>{{ $description }}</p>
        </div>

        <div class="pipeline-grid">
            @foreach ($steps as $index => $step)
                <article class="step-card spotlight-card" data-step="{{ $step['number'] ?? str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}"
                    data-spotlight-color="{{ $step['spotlightColor'] ?? 'rgba(246, 207, 97, .16)' }}">
                    <h3>{{ $step['title'] ?? '' }}</h3>
                    <p>{{ $step['text'] ?? '' }}</p>
                    <x-tag-row :tags="$step['tags'] ?? []" />
                </article>
            @endforeach
        </div>
    </div>
</section>
