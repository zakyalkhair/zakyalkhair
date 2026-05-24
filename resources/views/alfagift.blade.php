{{-- resources/views/portfolio/projects/alfagift.blade.php --}}
@extends('layouts.project-detail')

@section('title', 'Alfagift Sentiment Analysis — Zaky')
@section('bodyClass', 'project-alfagift')
@section('enableParticles', 'true')

@section('content')
    @php
        $project = [
            'titleBefore' => 'Sentiment Analysis of',
            'titleHighlight' => 'Alfagift',
            'titleAfter' => ' Reviews.',
            'lead' =>
                'An end-to-end sentiment analysis project that turns Alfagift Google Play reviews into clearer customer signals. The workflow cleans Indonesian review text, converts it with TF-IDF, trains sentiment models, and summarizes which parts of the app experience users praise or complain about most.',
            'tags' => ['Python', 'Pandas', 'Sastrawi', 'TF-IDF', 'Scikit-learn', 'LightGBM'],
            'actions' => [
                ['label' => 'View Analysis Visuals', 'href' => '#visuals', 'primary' => true],
                ['label' => 'See Workflow', 'href' => '#process', 'primary' => true],
            ],
            'panel' => [
                'type' => 'bars',
                'ariaLabel' => 'Project dashboard preview',
                'miniTitle' => 'Review Signal Preview',
                'spotlightColor' => 'rgba(143, 214, 148, .16)',
                'bars' => [
                    ['label' => 'App Flow', 'width' => 88, 'value' => 'High'],
                    ['label' => 'Login', 'width' => 76, 'value' => 'Med'],
                    ['label' => 'Promo', 'width' => 70, 'value' => 'Med'],
                    ['label' => 'Checkout', 'width' => 82, 'value' => 'High'],
                ],
                'notes' => [
                    [
                        'value' => 'TF-IDF',
                        'text' => 'Weighted text features used to capture important review terms.',
                        'spotlightColor' => 'rgba(246, 207, 97, .16)',
                    ],
                    [
                        'value' => '3-Class',
                        'text' => 'Feedback grouped into positive, neutral, and negative sentiment.',
                        'spotlightColor' => 'rgba(143, 214, 148, .16)',
                    ],
                ],
            ],
            'resources' => [
                [
                    'type' => 'github',
                    'href' => 'https://github.com/zakyalkhair/alfagift-sentiment-analysis',
                    'label' => 'Open GitHub repository',
                ],
                ['type' => 'report', 'href' => 'LINK_LAPORAN_KAMU', 'label' => 'Open project report'],
            ],
            'summary' => [
                'heading' => 'What this project is about.',
                'description' =>
                    'This project starts from raw app reviews and ends with a simple question: what are Alfagift users actually feeling, and which issues appear often enough to deserve attention?',
                'metrics' => [
                    [
                        'label' => 'Dataset',
                        'value' => 'Google Play',
                        'text' => 'User feedback collected from Alfagift reviews on Google Play.',
                        'spotlightColor' => 'rgba(246, 207, 97, .16)',
                    ],
                    [
                        'label' => 'Problem',
                        'value' => 'Sentiment',
                        'text' =>
                            'Separating positive, neutral, and negative reviews so the feedback is easier to read at scale.',
                        'spotlightColor' => 'rgba(143, 214, 148, .16)',
                    ],
                    [
                        'label' => 'Method',
                        'value' => 'TF-IDF',
                        'text' =>
                            'Transforming cleaned review text into weighted features that machine learning models can understand.',
                        'spotlightColor' => 'rgba(147, 197, 253, .16)',
                    ],
                    [
                        'label' => 'Output',
                        'value' => 'Insights',
                        'text' => 'Charts and explanations that connect model output with product-level user feedback.',
                        'spotlightColor' => 'rgba(255, 255, 255, .14)',
                    ],
                ],
            ],
            'process' => [
                'heading' => 'How the review data was processed.',
                'description' =>
                    'The analysis follows a practical NLP workflow: collect the reviews, clean the text, build features, train the model, then interpret the prediction results in a way that is useful for product evaluation.',
                'steps' => [
                    [
                        'title' => 'Scraping & Dataset Preparation',
                        'text' =>
                            'Collected Alfagift reviews from Google Play, stored the review text and metadata, then organized the dataset so it was ready for cleaning and analysis.',
                        'tags' => ['Scraping', 'CSV'],
                    ],
                    [
                        'title' => 'Text Preprocessing',
                        'text' =>
                            'Prepared Indonesian review text by removing noise, normalizing words, filtering stopwords, applying stemming, and shaping the labels for training.',
                        'tags' => ['Cleaning', 'Sastrawi'],
                    ],
                    [
                        'title' => 'Feature Engineering',
                        'text' =>
                            'Converted each review into TF-IDF features so frequent and meaningful terms could be used as model input, while still keeping the result interpretable.',
                        'tags' => ['TF-IDF', 'Top Terms'],
                    ],
                    [
                        'title' => 'Model Comparison',
                        'text' =>
                            'Tested several algorithms and compared their evaluation results to choose the sentiment classifier with the most stable performance.',
                        'tags' => ['SVM', 'LR', 'LightGBM'],
                    ],
                    [
                        'title' => 'Model Improvement',
                        'text' =>
                            'Refined the selected pipeline through tuning and review of evaluation results before using it for final prediction.',
                        'tags' => ['Tuning', 'Evaluation'],
                    ],
                    [
                        'title' => 'Inference & Interpretation',
                        'text' =>
                            'Applied the trained model to predict sentiment, checked confidence patterns, and turned the results into insights about user experience.',
                        'tags' => ['Prediction', 'Confidence'],
                    ],
                ],
            ],
            'visualsSection' => [
                'heading' => 'Analysis visuals and interpretation.',
                'description' =>
                    'The visuals below show how the text data behaves, how the model performs, and which review patterns are most useful to explain the final sentiment results.',
                'visuals' => [
                    [
                        'title' => 'Model Comparison',
                        'tabTitle' => 'Model Comparison',
                        'tabDescription' => 'Performance comparison across candidate algorithms.',
                        'description' =>
                            'Compares baseline and candidate models to determine the most reliable sentiment classifier.',
                        'image' => asset('images/projects/alfagift/model_comparison.png'),
                    ],
                    [
                        'title' => 'Best Model Confusion Matrix',
                        'tabTitle' => 'Confusion Matrix',
                        'tabDescription' => 'Class-level view of correct and incorrect predictions.',
                        'description' =>
                            'Shows which sentiment classes are predicted correctly and where the model still makes mistakes.',
                        'image' => asset('images/projects/alfagift/best_model_test_cm.png'),
                    ],
                    [
                        'title' => 'TF-IDF Top Terms',
                        'tabTitle' => 'Top TF-IDF Terms',
                        'tabDescription' => 'Key review terms that influence the text features.',
                        'description' =>
                            'Highlights the strongest TF-IDF terms, making it easier to understand which words shape the sentiment signal.',
                        'image' => asset('images/projects/alfagift/top20_tfidf.png'),
                    ],
                    [
                        'title' => 'Word Cloud',
                        'tabTitle' => 'Word Cloud',
                        'tabDescription' => 'Fast overview of common words in the reviews.',
                        'description' =>
                            'Summarizes frequent words from user reviews, giving a quick sense of what users talk about most.',
                        'image' => asset('images/projects/alfagift/wordcloud_tfidf.png'),
                    ],
                    [
                        'title' => 'Inference Confidence',
                        'tabTitle' => 'Inference Confidence',
                        'tabDescription' => 'Confidence pattern of the final sentiment predictions.',
                        'description' =>
                            'Shows the model confidence during inference, helping check whether the predictions are strong or uncertain.',
                        'image' => asset('images/projects/alfagift/inference_confidence.png'),
                    ],
                ],
            ],
            'takeaways' => [
                'heading' => 'What this project shows.',
                'description' =>
                    'The goal is not only to build a classifier, but also to make the review data easier to understand and act on.',
                'items' => [
                    [
                        'title' => 'Analytical Value',
                        'text' =>
                            'This project helps translate long, scattered user reviews into sentiment groups and recurring feedback themes, so product teams can quickly see what users appreciate and what still creates friction.',
                        'spotlightColor' => 'rgba(246, 207, 97, .15)',
                    ],
                    [
                        'title' => 'Technical Strength',
                        'list' => [
                            'Built a complete Indonesian text-processing workflow, from raw reviews to sentiment prediction.',
                            'Used preprocessing and TF-IDF to make user comments usable for machine learning.',
                            'Explained the result through evaluation charts, important terms, and inference confidence.',
                        ],
                        'spotlightColor' => 'rgba(143, 214, 148, .15)',
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
