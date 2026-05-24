{{-- resources/views/portfolio/projects/powerbi.blade.php --}}
@extends('layouts.project-detail')

@section('title', 'Power BI KPI Dashboard — Portfolio Project')
@section('bodyClass', 'project-powerbi')
@section('enableParticles', 'true')

@section('content')
    @php
        $project = [
            'titleBefore' => 'Power BI KPI Dashboard for',
            'titleHighlight' => 'Company Performance',
            'titleAfter' => '',
            'lead' =>
                'A performance dashboard prototype that translates IT Balanced Scorecard indicators into a clear, interactive monitoring experience. The dashboard helps compare corporate contribution, customer orientation, operational excellence, and future orientation through structured KPI pages, slicers, score cards, trends, and target-based visuals.',
            'tags' => [
                'Power BI',
                'KPI Dashboard',
                'IT Balanced Scorecard',
                'Excel Dataset',
                'Data Modeling',
                'Performance Analytics',
            ],
            'actions' => [
                ['label' => 'View Dashboard Screens', 'href' => '#visuals', 'primary' => true],
                ['label' => 'See Design Process', 'href' => '#process', 'primary' => false],
            ],
            'panel' => [
                'type' => 'powerbi',
                'ariaLabel' => 'Power BI project preview',
                'windowLabel' => 'Power BI Prototype',
                'label' => 'Dashboard Scope',
                'headline' => 'IT Balanced Scorecard Performance Control',
                'score' => '4',
                'miniTitle' => 'Perspective Coverage',
                'items' => [
                    ['label' => 'Corporate Contribution', 'value' => 'CC'],
                    ['label' => 'Customer Orientation', 'value' => 'CO'],
                    ['label' => 'Operational Excellence', 'value' => 'OE'],
                    ['label' => 'Future Orientation', 'value' => 'FO'],
                ],
            ],
            'resources' => [
                ['type' => 'github', 'href' => 'LINK_GITHUB_KAMU', 'label' => 'Open GitHub repository'],
                ['type' => 'report', 'href' => 'LINK_LAPORAN_KAMU', 'label' => 'Open project report'],
            ],
            'summary' => [
                'heading' => 'What this dashboard solves.',
                'description' =>
                    'The project turns scattered KPI definitions and representative data into a dashboard structure that is easier to monitor, compare, and explain for management-level performance evaluation.',
                'metrics' => [
                    [
                        'label' => 'Framework',
                        'value' => 'IT-BSC',
                        'text' =>
                            'Uses IT Balanced Scorecard perspectives to connect digital initiatives with business impact.',
                    ],
                    [
                        'label' => 'Data Source',
                        'value' => 'Excel',
                        'text' =>
                            'Built from structured KPI tables and mockup performance data prepared for dashboard modeling.',
                    ],
                    [
                        'label' => 'Tool',
                        'value' => 'Power BI',
                        'text' =>
                            'Designed with slicers, cards, line charts, column charts, gauge visuals, and page navigation.',
                    ],
                    [
                        'label' => 'Output',
                        'value' => '2 Levels',
                        'text' =>
                            'Includes a central dashboard view and branch-level dashboard views for more contextual analysis.',
                    ],
                ],
            ],
            'process' => [
                'heading' => 'From KPI structure to dashboard experience.',
                'description' =>
                    'The workflow focuses on making the dashboard practical: define the right indicators, prepare the dataset, transform the data, then design a visual flow that guides users from overview to detail.',
                'steps' => [
                    [
                        'title' => 'KPI Definition',
                        'text' =>
                            'Mapped KPI indicators into four IT-BSC perspectives: Corporate Contribution, Customer Orientation, Operational Excellence, and Future Orientation.',
                        'tags' => ['KPI Mapping', 'IT-BSC'],
                    ],
                    [
                        'title' => 'Dataset Preparation',
                        'text' =>
                            'Organized mockup KPI data in Excel so each indicator had the needed period, target, score, branch, and measurement fields for visualization.',
                        'tags' => ['Excel', 'Mockup Data'],
                    ],
                    [
                        'title' => 'ETL & Data Modeling',
                        'text' =>
                            'Cleaned, transformed, and connected the data inside Power BI so dashboard visuals could read consistent KPI values across multiple pages.',
                        'tags' => ['Power Query', 'Data Model'],
                    ],
                    [
                        'title' => 'Dashboard Wireframe',
                        'text' =>
                            'Planned a navigation-first layout with a main overview page, perspective pages, year slicers, KPI score panels, and target comparison areas.',
                        'tags' => ['Figma', 'Layout'],
                    ],
                    [
                        'title' => 'Visual Development',
                        'text' =>
                            'Built charts based on KPI behavior: cards for summary numbers, line charts for trends, column charts for comparison, and gauges for target status.',
                        'tags' => ['Charts', 'Targets'],
                    ],
                    [
                        'title' => 'Interpretation',
                        'text' =>
                            'Framed each dashboard page so users can quickly identify which indicators are on target, below target, or showing important performance movement.',
                        'tags' => ['Insights', 'Monitoring'],
                    ],
                ],
            ],
            'visualsSection' => [
                'heading' => 'Dashboard screens and interaction flow.',
                'description' =>
                    'Each screen is structured around a specific decision-making need, from executive context to KPI monitoring by perspective.',
                'visuals' => [
                    [
                        'title' => 'Main Dashboard',
                        'tabTitle' => 'Main Dashboard',
                        'tabDescription' => 'Opening screen for context and navigation.',
                        'description' =>
                            'Introduces the dashboard context, company values, vision, and mission before users explore KPI performance pages.',
                        'image' => asset('images/projects/powerbi/dashboard-main.png'),
                    ],
                    [
                        'title' => 'Corporate Contribution',
                        'tabTitle' => 'Corporate Contribution',
                        'tabDescription' => 'Business contribution and digital value indicators.',
                        'description' =>
                            'Shows the contribution of digital initiatives through KPI scores, ROI cards, revenue movement, strategic alliance performance, and budget utilization.',
                        'image' => asset('images/projects/powerbi/corporate-contribution.png'),
                    ],
                    [
                        'title' => 'Customer Orientation',
                        'tabTitle' => 'Customer Orientation',
                        'tabDescription' => 'Customer-facing service and experience metrics.',
                        'description' =>
                            'Tracks digital customer experience through satisfaction, complaints, active users, completion time, and customer data security trust.',
                        'image' => asset('images/projects/powerbi/customer-orientation.png'),
                    ],
                    [
                        'title' => 'Operational Excellence',
                        'tabTitle' => 'Operational Excellence',
                        'tabDescription' => 'System stability, downtime, and incident indicators.',
                        'description' =>
                            'Monitors operational reliability through system downtime, cost efficiency, website uptime, incident ratio, and UT Connect uptime.',
                        'image' => asset('images/projects/powerbi/operational-excellence.png'),
                    ],
                    [
                        'title' => 'Future Orientation',
                        'tabTitle' => 'Future Orientation',
                        'tabDescription' => 'Innovation, modernization, and capability growth.',
                        'description' =>
                            'Highlights digital readiness through implemented innovations, audit completion, approval rate, legacy modernization, and IT employee certification.',
                        'image' => asset('images/projects/powerbi/future-orientation.png'),
                    ],
                ],
            ],
            'takeaways' => [
                'heading' => 'What this project demonstrates.',
                'description' =>
                    'Beyond making charts, this project shows how dashboard design can make complex performance data easier to read, compare, and discuss.',
                'items' => [
                    [
                        'title' => 'Analytical Value',
                        'text' =>
                            'The dashboard gives users a structured way to monitor digital performance across multiple perspectives. Instead of reading KPI tables one by one, users can immediately see trends, target achievement, and performance gaps from one visual interface.',
                    ],
                    [
                        'title' => 'Technical Strength',
                        'list' => [
                            'Translated KPI documents into a dashboard-ready data model.',
                            'Designed a multi-page Power BI dashboard with clear navigation and visual hierarchy.',
                            'Matched chart types to KPI behavior so each metric is easier to interpret.',
                            'Used target lines, score cards, slicers, and summary panels to support quick monitoring.',
                        ],
                    ],
                ],
            ],
        ];
    @endphp

    <x-hero :project="$project" />
    <x-metrics-grid :heading="$project['summary']['heading']" :description="$project['summary']['description']" :items="$project['summary']['metrics']" />
    <x-process-grid :heading="$project['process']['heading']" :description="$project['process']['description']" :steps="$project['process']['steps']" />
    <x-visual-gallery :heading="$project['visualsSection']['heading']" :description="$project['visualsSection']['description']" :visuals="$project['visualsSection']['visuals']" />
    <x-takeaways :heading="$project['takeaways']['heading']" :description="$project['takeaways']['description']" :items="$project['takeaways']['items']" />

@endsection
