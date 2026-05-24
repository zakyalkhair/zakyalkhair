@props(['project' => []])

@php
    $panel = $project['panel'] ?? [];
    $panelType = $panel['type'] ?? 'bars';
    $actions = $project['actions'] ?? [];
@endphp

<section id="overview" class="hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            @isset($project['eyebrow'])
                <p class="eyebrow">{{ $project['eyebrow'] }}</p>
            @endisset

            <h1>
                {{ $project['titleBefore'] ?? '' }}
                @isset($project['titleHighlight'])
                    <span>{{ $project['titleHighlight'] }}</span>
                @endisset
                {{ $project['titleAfter'] ?? '' }}
            </h1>

            @isset($project['lead'])
                <p class="lead">{{ $project['lead'] }}</p>
            @endisset

            <x-tag-row :tags="$project['tags'] ?? []" />

            @if (!empty($actions))
                <div class="hero-actions">
                    @foreach ($actions as $action)
                        <a class="btn {{ !empty($action['primary']) ? 'btn-primary' : '' }}" href="{{ $action['href'] ?? '#' }}">
                            {{ $action['label'] ?? 'Open' }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <aside class="hero-panel" data-spotlight-color="{{ $panel['spotlightColor'] ?? 'rgba(246, 207, 97, .14)' }}"
            aria-label="{{ $panel['ariaLabel'] ?? 'Project preview' }}">
            <div class="mock-window">
                @if ($panelType !== 'cluster')
                    <div class="window-bar">
                        <div class="window-dots" aria-hidden="true">
                            @if ($panelType === 'powerbi')
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            @endif
                        </div>

                        @isset($panel['windowLabel'])
                            <span class="window-label">{{ $panel['windowLabel'] }}</span>
                        @endisset
                    </div>
                @endif

                <div class="window-content">
                    @if ($panelType === 'cluster')
                        <div class="cluster-card spotlight-card" data-spotlight-color="{{ $panel['spotlightColor'] ?? 'rgba(246, 207, 97, .16)' }}">
                            <p class="mini-title">{{ $panel['miniTitle'] ?? 'Cluster Preview' }}</p>

                            <div class="cluster-map" aria-hidden="true">
                                @foreach ($panel['dots'] ?? [] as $dot)
                                    <span class="cluster-dot"
                                        style="--dot-color: {{ $dot['color'] ?? '#f6cf61' }}; left: {{ $dot['left'] ?? '50%' }}; top: {{ $dot['top'] ?? '50%' }}; animation-delay: {{ $dot['delay'] ?? '0s' }};"></span>
                                @endforeach
                            </div>
                        </div>

                        <div class="cluster-stat-grid">
                            @foreach ($panel['stats'] ?? [] as $stat)
                                <div class="cluster-stat spotlight-card" data-spotlight-color="{{ $stat['spotlightColor'] ?? 'rgba(246, 207, 97, .14)' }}">
                                    <strong>{{ $stat['value'] ?? '' }}</strong>
                                    <span>{{ $stat['text'] ?? '' }}</span>
                                </div>
                            @endforeach
                        </div>
                    @elseif ($panelType === 'powerbi')
                        <div class="dashboard-preview">
                            <div class="preview-header spotlight-card" data-spotlight-color="{{ $panel['spotlightColor'] ?? 'rgba(246, 207, 97, .13)' }}">
                                <div>
                                    <p>{{ $panel['label'] ?? 'Dashboard Scope' }}</p>
                                    <strong>{{ $panel['headline'] ?? '' }}</strong>
                                </div>
                                <div class="score-pill">{{ $panel['score'] ?? '' }}</div>
                            </div>

                            <div class="bar-list spotlight-card" data-spotlight-color="{{ $panel['barSpotlightColor'] ?? 'rgba(246, 207, 97, .13)' }}">
                                <p class="mini-title">{{ $panel['miniTitle'] ?? 'Perspective Coverage' }}</p>

                                @foreach ($panel['items'] ?? [] as $item)
                                    <div class="bar-row compact">
                                        <span>{{ $item['label'] ?? '' }}</span>
                                        <strong>{{ $item['value'] ?? '' }}</strong>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="chart-card spotlight-card" data-spotlight-color="{{ $panel['spotlightColor'] ?? 'rgba(143, 214, 148, .16)' }}">
                            <p class="mini-title">{{ $panel['miniTitle'] ?? 'Preview' }}</p>

                            @foreach ($panel['bars'] ?? [] as $bar)
                                <div class="bar-row">
                                    <span>{{ $bar['label'] ?? '' }}</span>
                                    <div class="bar-track">
                                        <div class="bar-fill" style="width: {{ $bar['width'] ?? 0 }}%"></div>
                                    </div>
                                    <strong>{{ $bar['value'] ?? '' }}</strong>
                                </div>
                            @endforeach
                        </div>

                        @if (!empty($panel['notes']))
                            <div class="panel-note">
                                @foreach ($panel['notes'] as $note)
                                    <div class="note-box spotlight-card" data-spotlight-color="{{ $note['spotlightColor'] ?? 'rgba(246, 207, 97, .16)' }}">
                                        <strong>{{ $note['value'] ?? '' }}</strong>
                                        <span>{{ $note['text'] ?? '' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <x-resource-buttons :resources="$project['resources'] ?? []" />
        </aside>
    </div>
</section>
