{{-- resources/views/portfolio/projects/khamenei.blade.php --}}
@extends('layouts.project-detail')

@section('title', 'Analisis Sentimen Kematian Ali Khamenei — Zaky')
@section('bodyClass', 'project-khamenei')
@section('enableParticles', 'true')

@section('content')
    @php
        $project = [
            'titleBefore' => 'Analisis Sentimen',
            'titleHighlight' => 'Kematian Ali Khamenei',
            'titleAfter' => '.',
            'lead' =>
                'Studi komparatif berbasis NLP terhadap 487 artikel berita dari 5 platform media online Indonesia. Project ini mengolah artikel Kompas.com, Detik.com, CNN Indonesia, Tribunnews.com, dan Antaranews.com untuk melihat kecenderungan sentimen pemberitaan terkait kematian Ali Khamenei menggunakan pendekatan lexicon-based TextBlob, POS Tagging, Named Entity Recognition, dan TF-IDF.',
            'tags' => ['Python', 'BeautifulSoup4', 'Pandas', 'NLTK', 'PySastrawi', 'TextBlob', 'Stanza', 'TF-IDF'],
            'actions' => [
                ['label' => 'View Analysis Visuals', 'href' => '#visuals', 'primary' => true],
                ['label' => 'See Workflow', 'href' => '#process', 'primary' => true],
            ],
            'panel' => [
                'type' => 'bars',
                'ariaLabel' => 'Project analysis preview',
                'miniTitle' => 'Sentiment Distribution Preview',
                'spotlightColor' => 'rgba(143, 214, 148, .16)',
                'bars' => [
                    ['label' => 'Netral', 'width' => 60.8, 'value' => '60.8%'],
                    ['label' => 'Negatif', 'width' => 28.3, 'value' => '28.3%'],
                    ['label' => 'Positif', 'width' => 10.9, 'value' => '10.9%'],
                ],
                'notes' => [
                    [
                        'value' => '487',
                        'text' => 'Artikel valid dari 500 artikel yang dikumpulkan dari lima platform berita.',
                        'spotlightColor' => 'rgba(246, 207, 97, .16)',
                    ],
                    [
                        'value' => 'TextBlob',
                        'text' => 'Analisis sentimen lexicon-based setelah teks diterjemahkan ke Bahasa Inggris.',
                        'spotlightColor' => 'rgba(143, 214, 148, .16)',
                    ],
                ],
            ],
            'resources' => [
                [
                    'type' => 'github',
                    'href' => 'https://github.com/KurniaYufi/sentiment-analysis-kematian-ali-khamenei',
                    'label' => 'Open GitHub repository',
                ],
                ['type' => 'report', 'href' => asset('documents/PBA.pdf'), 'label' => 'Open project report'],
            ],
            'summary' => [
                'heading' => 'What this project is about.',
                'description' =>
                    'Project ini menjawab tiga pertanyaan utama: kecenderungan sentimen pemberitaan, perbedaan distribusi sentimen antar platform, dan pola sentimen yang muncul dari klasifikasi lexicon-based menggunakan TextBlob.',
                'metrics' => [
                    [
                        'label' => 'Collected',
                        'value' => '500',
                        'text' => 'Artikel dikumpulkan dari Kompas, Detik, CNN Indonesia, Tribunnews, dan ANTARA News.',
                        'spotlightColor' => 'rgba(246, 207, 97, .16)',
                    ],
                    [
                        'label' => 'Valid Data',
                        'value' => '487',
                        'text' => 'Artikel valid setelah proses penggabungan, pengecekan, dan preprocessing data.',
                        'spotlightColor' => 'rgba(143, 214, 148, .16)',
                    ],
                    [
                        'label' => 'Method',
                        'value' => 'Lexicon',
                        'text' =>
                            'Sentimen dihitung menggunakan TextBlob dengan bantuan penerjemahan GoogleTranslator.',
                        'spotlightColor' => 'rgba(147, 197, 253, .16)',
                    ],
                    [
                        'label' => 'Dominant Result',
                        'value' => '60.8%',
                        'text' => 'Mayoritas artikel berada pada kategori netral.',
                        'spotlightColor' => 'rgba(255, 255, 255, .14)',
                    ],
                ],
            ],
            'process' => [
                'heading' => 'How the news data was processed.',
                'description' =>
                    'Pipeline project terdiri dari pengumpulan data, preprocessing teks, analisis sentimen, POS Tagging, NER, TF-IDF, dan visualisasi hasil analisis.',
                'steps' => [
                    [
                        'title' => 'Web Scraping',
                        'text' =>
                            'Mengambil link dan isi artikel dari lima platform berita menggunakan Requests dan BeautifulSoup, dengan batas 100 artikel per platform.',
                        'tags' => ['Requests', 'BeautifulSoup'],
                    ],
                    [
                        'title' => 'Text Preprocessing',
                        'text' =>
                            'Membersihkan teks dengan lowercase, penghapusan URL, tanda baca, angka, tokenisasi, stopword removal bahasa Indonesia, dan stemming menggunakan Sastrawi.',
                        'tags' => ['NLTK', 'Sastrawi'],
                    ],
                    [
                        'title' => 'Sentiment Analysis',
                        'text' =>
                            'Mengklasifikasikan sentimen dengan TextBlob. Teks diterjemahkan ke Bahasa Inggris, lalu dikategorikan positif, negatif, atau netral berdasarkan nilai polaritas.',
                        'tags' => ['TextBlob', 'GoogleTranslator'],
                    ],
                    [
                        'title' => 'POS Tagging & NER',
                        'text' =>
                            'Menggunakan Stanza untuk menganalisis kelas kata dan entitas seperti orang, organisasi, lokasi, negara, dan kategori entitas lain yang muncul pada artikel.',
                        'tags' => ['Stanza', 'NER'],
                    ],
                    [
                        'title' => 'TF-IDF Analysis',
                        'text' =>
                            'Menganalisis istilah penting secara global, per POS, per platform, dan per sentimen menggunakan TfidfVectorizer dengan unigram, bigram, dan trigram.',
                        'tags' => ['Scikit-learn', 'TF-IDF'],
                    ],
                    [
                        'title' => 'Visualization',
                        'text' =>
                            'Menyajikan hasil dalam bentuk distribusi sentimen, EDA dataset, word cloud, distribusi POS/NER, ranking TF-IDF, dan visualisasi per platform maupun per sentimen.',
                        'tags' => ['Matplotlib', 'WordCloud'],
                    ],
                ],
            ],
            'visualsSection' => [
                'heading' => 'Analysis visuals and interpretation.',
                'description' =>
                    'Visualisasi di bawah berasal dari output project: preprocessing, analisis sentimen, POS Tagging, Named Entity Recognition, dan TF-IDF.',
                'visuals' => [
                    [
                        'title' => 'Distribusi Analisis Sentimen',
                        'tabTitle' => 'Distribusi Sentimen',
                        'tabDescription' => 'Proporsi positif, negatif, dan netral dari 487 artikel valid.',
                        'description' =>
                            'Menampilkan komposisi sentimen keseluruhan: netral 60,8%, negatif 28,3%, dan positif 10,9%.',
                        'image' => asset('images/projects/khamenei/distribusi-analisis-sentimen.png'),
                    ],
                    [
                        'title' => 'Distribusi Panjang Artikel',
                        'tabTitle' => 'Panjang Artikel',
                        'tabDescription' => 'Distribusi panjang artikel pada dataset berita.',
                        'description' =>
                            'Menunjukkan variasi panjang artikel setelah data berita dikumpulkan dan diproses.',
                        'image' => asset('images/projects/khamenei/distribusi-panjang-artikel.png'),
                    ],
                    [
                        'title' => 'EDA Dataset Mentah',
                        'tabTitle' => 'EDA Dataset Mentah',
                        'tabDescription' => 'Gambaran awal data sebelum text cleaning.',
                        'description' => 'Exploratory data analysis pada dataset sebelum preprocessing dilakukan.',
                        'image' => asset('images/projects/khamenei/eda-dataset-mentah.png'),
                    ],
                    [
                        'title' => 'EDA Sesudah Preprocessing',
                        'tabTitle' => 'EDA After Preprocessing',
                        'tabDescription' => 'Perbandingan data setelah teks dibersihkan.',
                        'description' =>
                            'Menunjukkan kondisi dataset setelah proses cleaning, tokenisasi, stopword removal, dan stemming.',
                        'image' => asset('images/projects/khamenei/eda-sesudah-preprocessing.png'),
                    ],
                    [
                        'title' => 'Top 20 Kata',
                        'tabTitle' => 'Top 20 Kata',
                        'tabDescription' => 'Kata dominan dalam korpus berita.',
                        'description' => 'Menampilkan kata-kata yang paling sering muncul setelah preprocessing teks.',
                        'image' => asset('images/projects/khamenei/top-20-kata.png'),
                    ],
                    [
                        'title' => 'Word Cloud Analisis Sentimen',
                        'tabTitle' => 'Word Cloud Sentimen',
                        'tabDescription' => 'Ringkasan term dominan dalam berita.',
                        'description' =>
                            'Memberikan ringkasan visual kata yang sering muncul dalam hasil analisis sentimen.',
                        'image' => asset('images/projects/khamenei/wordcloud-analisis-sentimen.png'),
                    ],
                    [
                        'title' => 'NER Distribution',
                        'tabTitle' => 'NER Distribution',
                        'tabDescription' => 'Distribusi named entity pada artikel.',
                        'description' =>
                            'Menampilkan distribusi entitas yang dikenali pada artikel berita. Label GPE menjadi entitas terbesar dengan 8.863 entitas.',
                        'image' => asset('images/projects/khamenei/ner_distribution.png'),
                    ],
                    [
                        'title' => 'POS Distribution',
                        'tabTitle' => 'POS Distribution',
                        'tabDescription' => 'Komposisi kelas kata dalam artikel.',
                        'description' =>
                            'Menampilkan distribusi kelas kata hasil POS Tagging; NOUN menjadi kelas terbesar dengan 66.331 token.',
                        'image' => asset('images/projects/khamenei/pos_distribution.png'),
                    ],
                    [
                        'title' => 'TF-IDF Global Bar',
                        'tabTitle' => 'TF-IDF Global',
                        'tabDescription' => 'Term penting berdasarkan bobot TF-IDF.',
                        'description' =>
                            'Menampilkan ranking term penting berdasarkan skor TF-IDF global dari seluruh artikel.',
                        'image' => asset('images/projects/khamenei/viz_tfidf_bar.png'),
                    ],
                    [
                        'title' => 'TF-IDF per News Platform',
                        'tabTitle' => 'TF-IDF per News',
                        'tabDescription' => 'Perbandingan term khas antar media.',
                        'description' =>
                            'Membandingkan term penting antar platform berita untuk melihat karakteristik editorial masing-masing media.',
                        'image' => asset('images/projects/khamenei/viz_tfidf_per_news.png'),
                    ],
                    [
                        'title' => 'TF-IDF per Sentimen',
                        'tabTitle' => 'TF-IDF per Sentimen',
                        'tabDescription' => 'Term khas untuk tiap kategori sentimen.',
                        'description' =>
                            'Menunjukkan term penting yang muncul pada kategori positif, negatif, dan netral.',
                        'image' => asset('images/projects/khamenei/viz_tfidf_per_sentimen.png'),
                    ],
                    [
                        'title' => 'Global Word Cloud',
                        'tabTitle' => 'Global Word Cloud',
                        'tabDescription' => 'Visualisasi term dominan secara global.',
                        'description' =>
                            'Word cloud global dari hasil TF-IDF untuk melihat term dominan pada keseluruhan korpus artikel.',
                        'image' => asset('images/projects/khamenei/viz_wordcloud_global.png'),
                    ],
                ],
            ],
            'takeaways' => [
                'heading' => 'What this project shows.',
                'description' =>
                    'Project ini menunjukkan bagaimana artikel berita dapat diubah menjadi insight yang terstruktur melalui preprocessing, sentimen lexicon-based, POS Tagging, NER, dan TF-IDF.',
                'items' => [
                    [
                        'title' => 'Analytical Value',
                        'text' =>
                            'Hasil analisis menunjukkan bahwa mayoritas pemberitaan bersentimen netral, dengan 60,8% artikel netral, 28,3% negatif, dan 10,9% positif. CNN Indonesia memiliki proporsi negatif tertinggi, sedangkan Antaranews.com memiliki proporsi netral tertinggi.',
                        'spotlightColor' => 'rgba(246, 207, 97, .15)',
                    ],
                    [
                        'title' => 'Technical Strength',
                        'list' => [
                            'Membangun pipeline dari link scraping, content scraping, integrasi CSV, hingga preprocessing teks.',
                            'Menerapkan analisis sentimen lexicon-based dengan TextBlob dan deep-translator.',
                            'Menggunakan Stanza untuk POS Tagging dan Named Entity Recognition.',
                            'Menganalisis term penting secara global, per POS, per platform, dan per sentimen menggunakan TF-IDF.',
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
