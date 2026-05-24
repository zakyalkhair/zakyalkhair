@props(['heading' => '', 'description' => '', 'items' => []])

<section id="takeaways">
    <div class="container">
        <div class="section-heading">
            <h2>{{ $heading }}</h2>
            <p>{{ $description }}</p>
        </div>

        <div class="takeaway-grid">
            @foreach ($items as $item)
                <article class="takeaway-card spotlight-card" data-spotlight-color="{{ $item['spotlightColor'] ?? 'rgba(246, 207, 97, .15)' }}">
                    <h3>{{ $item['title'] ?? '' }}</h3>

                    @if (!empty($item['list']))
                        <ul>
                            @foreach ($item['list'] as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ $item['text'] ?? '' }}</p>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>
