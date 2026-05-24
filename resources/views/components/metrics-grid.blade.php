@props(['heading' => '', 'description' => '', 'items' => [], 'ariaLabel' => 'Project summary'])

<section aria-label="{{ $ariaLabel }}">
    <div class="container">
        <div class="section-heading">
            <h2>{{ $heading }}</h2>
            <p>{{ $description }}</p>
        </div>

        <div class="metrics-grid">
            @foreach ($items as $item)
                <article class="metric-card spotlight-card" data-spotlight-color="{{ $item['spotlightColor'] ?? 'rgba(246, 207, 97, .16)' }}">
                    <span>{{ $item['label'] ?? '' }}</span>
                    <strong>{{ $item['value'] ?? '' }}</strong>
                    <p>{{ $item['text'] ?? '' }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
