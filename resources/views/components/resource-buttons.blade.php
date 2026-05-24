@props(['resources' => []])

@if (!empty($resources))
    <div class="floating-resource-stack" aria-label="Project resources">
        @foreach ($resources as $resource)
            @php
                $type = $resource['type'] ?? 'link';
                $href = $resource['href'] ?? '#';
                $label = $resource['label'] ?? 'Open project resource';
            @endphp

            <a class="floating-resource-btn {{ $type }}" href="{{ $href }}" target="_blank" rel="noopener"
                aria-label="{{ $label }}">
                @if ($type === 'github')
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M12 .5A12 12 0 0 0 8.2 23.9c.6.1.8-.2.8-.6v-2.1c-3.3.7-4-1.4-4-1.4-.5-1.3-1.2-1.7-1.2-1.7-1-.7.1-.7.1-.7 1.1.1 1.7 1.2 1.7 1.2 1 .1.6 2.8 3.4 2 .1-.7.4-1.2.7-1.5-2.6-.3-5.4-1.3-5.4-5.9 0-1.3.5-2.4 1.2-3.2-.1-.3-.5-1.6.1-3.2 0 0 1-.3 3.3 1.2a11.4 11.4 0 0 1 6 0c2.3-1.5 3.3-1.2 3.3-1.2.6 1.6.2 2.9.1 3.2.8.8 1.2 1.9 1.2 3.2 0 4.6-2.8 5.6-5.4 5.9.4.4.8 1.1.8 2.2v3.2c0 .4.2.7.8.6A12 12 0 0 0 12 .5Z" />
                    </svg>
                @else
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 3.5h7.2L19 8.3v12.2H7V3.5Z" stroke="currentColor" stroke-width="1.8"
                            stroke-linejoin="round" />
                        <path d="M14 3.5V9h5" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                        <path d="M9.7 13h6.6M9.7 16h6.6" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                @endif
            </a>
        @endforeach
    </div>
@endif
