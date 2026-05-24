@props(['tags' => []])

@if (!empty($tags))
    <div class="tag-row">
        @foreach ($tags as $tag)
            @php
                $label = is_array($tag) ? ($tag['label'] ?? $tag['name'] ?? '') : $tag;
                $icon = is_array($tag) ? ($tag['icon'] ?? null) : null;
            @endphp

            @if ($label)
                <span class="tag">
                    @if ($icon)
                        <img src="{{ asset($icon) }}" alt="{{ $label }}" loading="lazy" decoding="async">
                    @endif
                    {{ $label }}
                </span>
            @endif
        @endforeach
    </div>
@endif
