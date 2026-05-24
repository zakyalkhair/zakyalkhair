{{-- resources/views/portfolio/projects/clustering.blade.php --}}
@extends('layouts.project-detail')

@section('title', 'South Korea Health Clustering — Zaky')
@section('bodyClass', 'project-clustering')
@section('enableParticles', 'true')

@section('content')
    @php
        $clusterDots = [
            ['color' => '#93c5fd', 'left' => '15%', 'top' => '36%'],
            ['color' => '#93c5fd', 'left' => '21%', 'top' => '48%', 'delay' => '.3s'],
            ['color' => '#93c5fd', 'left' => '28%', 'top' => '55%', 'delay' => '.7s'],
            ['color' => '#93c5fd', 'left' => '33%', 'top' => '42%', 'delay' => '1.1s'],
            ['color' => '#f6cf61', 'left' => '62%', 'top' => '26%', 'delay' => '.2s'],
            ['color' => '#f6cf61', 'left' => '70%', 'top' => '32%', 'delay' => '.8s'],
            ['color' => '#f6cf61', 'left' => '78%', 'top' => '23%', 'delay' => '1.3s'],
            ['color' => '#f6cf61', 'left' => '67%', 'top' => '43%', 'delay' => '.5s'],
            ['color' => '#8fd694', 'left' => '42%', 'top' => '70%', 'delay' => '.4s'],
            ['color' => '#8fd694', 'left' => '52%', 'top' => '74%', 'delay' => '.9s'],
            ['color' => '#8fd694', 'left' => '58%', 'top' => '63%', 'delay' => '1.4s'],
            ['color' => '#8fd694', 'left' => '47%', 'top' => '58%', 'delay' => '.6s'],
        ];

        $project = [
            'titleBefore' => 'Clustering Health Burden in',
            'titleHighlight' => 'South Korea',
            'titleAfter' => '.',
            'lead' => 'A K-Means clustering project that analyzes disease prevalence, mortality rate, healthcare access, doctors availability, and hospital bed capacity in South Korea 2022. The workflow turns complex health indicators into three interpretable clusters to highlight differences in health burden and access to medical resources.',
            'tags' => ['R', 'K-Means', 'PCA', 'Elbow Method', 'Silhouette Score', 'Health Analytics'],
            'actions' => [
                ['label' => 'View Cluster Visuals', 'href' => '#visuals', 'primary' => true],
                ['label' => 'See Workflow', 'href' => '#process', 'primary' => false],
            ],
            'panel' => [
                'type' => 'cluster',
                'ariaLabel' => 'Project clustering preview',
                'miniTitle' => 'Three-Cluster Health Pattern',
                'spotlightColor' => 'rgba(246, 207, 97, .16)',
                'dots' => $clusterDots,
                'stats' => [
                    ['value' => '3', 'text' => 'groups formed from similar burden and healthcare access patterns.', 'spotlightColor' => 'rgba(246, 207, 97, .14)'],
                    ['value' => 'PCA', 'text' => 'Reduced indicators into a clearer two-dimensional visualization space.', 'spotlightColor' => 'rgba(143, 214, 148, .14)'],
                    ['value' => 'K-Means', 'text' => 'Used to group records based on normalized health-related indicators.', 'spotlightColor' => 'rgba(147, 197, 253, .14)'],
                ],
            ],
            'resources' => [
                ['type' => 'github', 'href' => 'LINK_GITHUB_KAMU', 'label' => 'Open GitHub repository'],
                ['type' => 'report', 'href' => 'LINK_LAPORAN_KAMU', 'label' => 'Open project report'],
            ],
            'summary' => [
                'heading' => 'What this project is about.',
                'description' => 'The analysis focuses on grouping health conditions by similarity, so disease burden and medical access patterns can be read faster than looking at raw indicators one by one.',
                'metrics' => [
                    ['label' => 'Dataset', 'value' => 'South Korea', 'text' => 'Filtered Global Health Statistics data for South Korea in 2022.', 'spotlightColor' => 'rgba(246, 207, 97, .16)'],
                    ['label' => 'Focus', 'value' => 'Health Access', 'text' => 'Uses prevalence, mortality, healthcare access, doctors, and hospital beds indicators.', 'spotlightColor' => 'rgba(147, 197, 253, .16)'],
                    ['label' => 'Method', 'value' => 'K-Means', 'text' => 'Groups data points after scaling and dimensionality reduction with PCA.', 'spotlightColor' => 'rgba(143, 214, 148, .16)'],
                    ['label' => 'Result', 'value' => '3 Clusters', 'text' => 'Chosen as the most balanced cluster structure using Elbow and Silhouette validation.', 'spotlightColor' => 'rgba(255, 255, 255, .14)'],
                ],
            ],
            'process' => [
                'heading' => 'How the health data was analyzed.',
                'description' => 'The workflow is designed to keep the clustering result explainable: start from focused data selection, make the scale fair, reduce dimensions, compare cluster options, then interpret the selected cluster profile.',
                'steps' => [
                    ['title' => 'Dataset Filtering', 'text' => 'Selected South Korea records from 2022 and kept only variables related to disease burden and healthcare service availability.', 'tags' => ['Country Filter', '2022']],
                    ['title' => 'Preparation & Encoding', 'text' => 'Checked data structure, converted categorical values into numeric format, and prepared all selected columns for statistical processing.', 'tags' => ['Encoding', 'R']],
                    ['title' => 'Outlier Cleaning', 'text' => 'Used the IQR approach to reduce the effect of extreme values, so the clustering process is not dominated by unusual records.', 'tags' => ['IQR', 'Cleaning']],
                    ['title' => 'Min-Max Scaling', 'text' => 'Normalized numeric indicators into the same 0 to 1 range, making prevalence, mortality, and health facility metrics comparable.', 'tags' => ['Scaling', '0–1 Range']],
                    ['title' => 'PCA Reduction', 'text' => 'Reduced the dataset into two principal components to simplify visualization while retaining meaningful variation from the original indicators.', 'tags' => ['PCA', 'PC1 & PC2']],
                    ['title' => 'Cluster Validation', 'text' => 'Compared K-Means with 3, 4, and 5 clusters, then selected three clusters based on Elbow and Silhouette Score interpretation.', 'tags' => ['Elbow', 'Silhouette']],
                ],
            ],
            'visualsSection' => [
                'heading' => 'Clustering visuals and interpretation.',
                'description' => 'These visuals show the important checkpoints: dataset preparation, PCA result, cluster comparison, validation method, and the final cluster profile.',
                'visuals' => [
                    ['title' => 'K-Means with 3 Clusters', 'tabTitle' => '3-Cluster Result', 'tabDescription' => 'Final cluster option used for interpretation.', 'description' => 'The selected clustering structure. Three clusters provide the clearest balance between separation and interpretability for the PCA-reduced health data.', 'image' => asset('images/projects/clustering/kmeans-3-clusters.webp')],
                    ['title' => 'Elbow Method', 'tabTitle' => 'Elbow Method', 'tabDescription' => 'Checks the cluster count from WCSS reduction.', 'description' => 'The WCSS curve drops sharply until around k=3, then becomes flatter. This supports three clusters as a balanced choice.', 'image' => asset('images/projects/clustering/elbow-method.webp')],
                    ['title' => 'Silhouette Score', 'tabTitle' => 'Silhouette Score', 'tabDescription' => 'Validates how well-separated the clusters are.', 'description' => 'The highest average Silhouette pattern appears at k=3, showing that this cluster count gives the strongest separation compared with other tested options.', 'image' => asset('images/projects/clustering/silhouette-score.webp')],
                    ['title' => 'PCA Summary', 'tabTitle' => 'PCA Result', 'tabDescription' => 'Shows the reduced feature space used for clustering.', 'description' => 'PCA reduces the health indicators into PC1 and PC2, making the clustering result easier to visualize and compare.', 'image' => asset('images/projects/clustering/pca-result.webp')],
                    ['title' => 'Cluster Mean Profile', 'tabTitle' => 'Cluster Mean', 'tabDescription' => 'Summarizes the center tendency of each cluster.', 'description' => 'The average PC values help explain how each cluster differs in disease burden and healthcare service capacity.', 'image' => asset('images/projects/clustering/cluster-mean.webp')],
                    ['title' => 'Healthcare Access Distribution', 'tabTitle' => 'Data Distribution', 'tabDescription' => 'Explores selected indicator spread before clustering.', 'description' => 'Before modeling, distribution plots are used to understand the spread of each selected health indicator.', 'image' => asset('images/projects/clustering/distribution-healthcare-access.webp')],
                ],
            ],
            'takeaways' => [
                'heading' => 'What this project shows.',
                'description' => 'The final output is not just a cluster plot, but a clearer way to read which health groups may require different resource planning or policy attention.',
                'items' => [
                    ['title' => 'Analytical Value', 'text' => 'Three clusters help separate health conditions into groups with different burden and access patterns. This makes it easier to identify where medical resource distribution may need more attention instead of treating all records as one general population.', 'spotlightColor' => 'rgba(246, 207, 97, .15)'],
                    ['title' => 'Technical Strength', 'list' => ['Built an end-to-end clustering workflow using R, from filtering to interpretation.', 'Applied Min-Max scaling and PCA so K-Means can work on comparable, lower-dimensional data.', 'Validated the number of clusters using Elbow Method and Silhouette Score before explaining the result.'], 'spotlightColor' => 'rgba(143, 214, 148, .15)'],
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
