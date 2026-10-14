<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كلية العلوم - جامعة طرابلس | البوابة التعريفية والاستفسارات</title>
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --navy-dark: #07192f;
            --navy-primary: #0f2b48;
            --blue-accent: #2563eb;
            --gold-accent: #f59e0b;
            --emerald: #10b981;
            --bg-light: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Cairo', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* Top Bar */
        .top-notice {
            background: #091e36;
            color: #93c5fd;
            padding: 8px 20px;
            font-size: 13px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Navbar */
        nav {
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .brand-box {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: inherit;
        }

        .brand-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--blue-accent) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 26px;
            box-shadow: 0 4px 12px rgba(15, 43, 72, 0.2);
        }

        .brand-info h1 {
            font-size: 19px;
            font-weight: 800;
            color: var(--navy-primary);
            line-height: 1.2;
        }

        .brand-info span {
            font-size: 13px;
            color: var(--blue-accent);
            font-weight: 600;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #334155;
            font-size: 15px;
            font-weight: 600;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--blue-accent);
        }

        .btn-admin {
            background: linear-gradient(135deg, #0f2b48 0%, #1e40af 100%);
            color: white !important;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700 !important;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 10px rgba(15, 43, 72, 0.15);
        }

        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(15, 43, 72, 0.25);
            background: linear-gradient(135deg, #091e36 0%, #172554 100%);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #07192f 0%, #0f2b48 60%, #1e3a8a 100%);
            color: white;
            padding: 80px 20px 90px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 4px solid var(--gold-accent);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(37, 99, 235, 0.2) 0%, transparent 60%);
            pointer-events: none;
        }

        .hero-container {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 6px 18px;
            border-radius: 30px;
            font-size: 14px;
            color: #fde047;
            font-weight: 700;
            margin-bottom: 24px;
            backdrop-filter: blur(4px);
        }

        .hero h2 {
            font-size: 38px;
            font-weight: 900;
            line-height: 1.35;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 18px;
            color: #cbd5e1;
            margin-bottom: 35px;
            line-height: 1.8;
            max-width: 750px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            background: var(--gold-accent);
            color: #0f172a;
            padding: 14px 32px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 800;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.35);
        }

        .btn-hero-primary:hover {
            background: #d97706;
            color: white;
            transform: translateY(-2px);
        }

        .btn-hero-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1.5px solid rgba(255, 255, 255, 0.3);
            padding: 14px 28px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.25s ease;
            backdrop-filter: blur(4px);
        }

        .btn-hero-secondary:hover {
            background: white;
            color: var(--navy-primary);
        }

        /* Stats Bar */
        .stats-bar {
            max-width: 1100px;
            margin: -40px auto 60px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            background: white;
            border-radius: 16px;
            padding: 25px 30px;
            box-shadow: 0 10px 35px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-icon.blue { background: #dbeafe; color: #1e40af; }
        .stat-icon.gold { background: #fef3c7; color: #b45309; }
        .stat-icon.green { background: #d1fae5; color: #065f46; }
        .stat-icon.purple { background: #ede9fe; color: #5b21b6; }

        .stat-num {
            font-size: 22px;
            font-weight: 800;
            color: var(--navy-primary);
            line-height: 1.2;
        }

        .stat-desc {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* Content Sections */
        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px 70px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 45px;
        }

        .section-title span {
            color: var(--blue-accent);
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
            margin-bottom: 6px;
        }

        .section-title h3 {
            font-size: 28px;
            font-weight: 800;
            color: var(--navy-primary);
        }

        .section-title p {
            color: var(--text-muted);
            font-size: 16px;
            max-width: 600px;
            margin: 8px auto 0;
        }

        /* About Grid */
        .about-card {
            background: white;
            border-radius: 16px;
            padding: 35px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            border: 1px solid var(--border-color);
            margin-bottom: 60px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: center;
        }

        @media (max-width: 768px) {
            .about-card { grid-template-columns: 1fr; padding: 25px; }
            .hero h2 { font-size: 28px; }
        }

        .about-content h4 {
            font-size: 22px;
            color: var(--navy-primary);
            font-weight: 800;
            margin-bottom: 15px;
        }

        .about-content p {
            color: #475569;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .feature-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 20px;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: #1e293b;
            font-weight: 600;
        }

        .feature-list li i {
            color: var(--emerald);
            font-size: 18px;
        }

        .highlight-box {
            background: #eff6ff;
            border-radius: 14px;
            padding: 30px;
            border: 1.5px dashed #bfdbfe;
        }

        .highlight-box h5 {
            color: var(--blue-accent);
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Departments Cards */
        .dept-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
            gap: 22px;
            margin-bottom: 70px;
        }

        .dept-card {
            background: white;
            border-radius: 14px;
            padding: 24px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .dept-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(15, 43, 72, 0.08);
            border-color: #cbd5e1;
        }

        .dept-icon {
            width: 46px;
            height: 46px;
            background: #eff6ff;
            color: var(--blue-accent);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 16px;
        }

        .dept-card h4 {
            font-size: 17px;
            font-weight: 700;
            color: var(--navy-primary);
            margin-bottom: 8px;
        }

        .dept-card p {
            font-size: 13.5px;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 18px;
            flex: 1;
        }

        .dept-ask-btn {
            background: #f1f5f9;
            color: var(--navy-primary);
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            text-align: center;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .dept-ask-btn:hover {
            background: var(--blue-accent);
            color: white;
        }

        /* Inquiry Form Card */
        .inquiry-wrapper {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(15, 43, 72, 0.08);
            border: 1px solid var(--border-color);
            overflow: hidden;
            max-width: 800px;
            margin: 0 auto;
        }

        .inquiry-header {
            background: linear-gradient(135deg, #091e36 0%, #0f2b48 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .inquiry-header h3 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .inquiry-header p {
            color: #cbd5e1;
            font-size: 15px;
        }

        .inquiry-body {
            padding: 35px 30px;
        }

        /* Success Message */
        .alert-success {
            background: #ecfdf5;
            border: 1.5px solid #a7f3d0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            color: #065f46;
        }

        .alert-success i {
            font-size: 32px;
            color: var(--emerald);
        }

        .alert-code {
            display: inline-block;
            background: #d1fae5;
            padding: 4px 12px;
            border-radius: 6px;
            font-weight: 800;
            color: #065f46;
            margin-top: 8px;
            font-family: monospace;
            direction: ltr;
        }

        /* Form Controls */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-bottom: 18px;
        }

        @media (max-width: 600px) {
            .form-row { grid-template-columns: 1fr; }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 15px;
            color: var(--text-dark);
            background: white;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--blue-accent);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 130px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #0f2b48 0%, #1e40af 100%);
            color: white;
            border: none;
            width: 100%;
            padding: 16px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(15, 43, 72, 0.25);
            transition: all 0.25s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(15, 43, 72, 0.35);
            background: linear-gradient(135deg, #091e36 0%, #172554 100%);
        }

        /* Footer */
        footer {
            background: #091e36;
            color: #94a3b8;
            padding: 40px 20px 30px;
            border-top: 3px solid var(--gold-accent);
            font-size: 14px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-copy a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <!-- Top Notice -->
    <div class="top-notice">
        جامعة طرابلس | كلية العلوم &bull; البوابة الإلكترونية لاستقبال أسئلة واستفسارات الزوار والطلاب
    </div>

    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="{{ route('visitors') }}" class="brand-box">
                <div class="brand-icon">
                    <i class="bi-mortarboard-fill"></i>
                </div>
                <div class="brand-info">
                    <h1>كلية العلوم - جامعة طرابلس</h1>
                    <span>Faculty of Science - University of Tripoli</span>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="#about">عن الكلية</a></li>
                <li><a href="#departments">الأقسام العلمية</a></li>
                <li><a href="#inquiry">إرسال استفسار</a></li>
                <li>
                    <a href="{{ route('admin') }}" class="btn-admin" title="لوحة تحكم مخصصة لإدارة الكلية">
                        <i class="bi-shield-lock-fill"></i>
                        رابط الإدارة 🔐
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-badge">
                <i class="bi-stars"></i>
                البوابة التعريفية والاستفسارية الرسمية
            </div>
            <h2>مرحباً بكم في كلية العلوم بجامعة طرابلس</h2>
            <p>
                صرح أكاديمي رائد في نشر العلوم الأساسية والتطبيقية، وإعداد الكفاءات العلمية والبحثية المتميزة لخدمة المجتمع وبناء المستقبل في ليبيا منذ عام 1957.
            </p>
            <div class="hero-buttons">
                <a href="#inquiry" class="btn-hero-primary">
                    <i class="bi-chat-left-dots-fill"></i>
                    استفسر عن أي شيء الآن
                </a>
                <a href="#departments" class="btn-hero-secondary">
                    <i class="bi-grid-fill"></i>
                    استكشف الأقسام الأكاديمية
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <div class="stats-bar">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon blue">
                    <i class="bi-buildings"></i>
                </div>
                <div>
                    <div class="stat-num">{{ $departments->count() }} أقسام</div>
                    <div class="stat-desc">أقسام علمية وتخصصية رائدة</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon gold">
                    <i class="bi-mortarboard"></i>
                </div>
                <div>
                    <div class="stat-num">+15,000</div>
                    <div class="stat-desc">خريج مؤهل لسوق العمل</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon green">
                    <i class="bi-check-all"></i>
                </div>
                <div>
                    <div class="stat-num">متاح 24/7</div>
                    <div class="stat-desc">استقبال استفساراتكم وتخزينها</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon purple">
                    <i class="bi-shield-check"></i>
                </div>
                <div>
                    <div class="stat-num">متابعة دقيقة</div>
                    <div class="stat-desc">ردود رسمية من مكاتب الكلية</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <main class="section-container">

        <!-- About Section -->
        <section id="about" class="about-card">
            <div class="about-content">
                <h4>نبذة تعريفية عن كلية العلوم</h4>
                <p>
                    تعتبر كلية العلوم بجامعة طرابلس من أعرق وأكبر الكليات العلمية في ليبيا والمنطقة. تضم نخبة متميزة من أعضاء هيئة التدريس والباحثين في مجالات الحاسوب، الكيمياء، الفيزياء، الرياضيات، علوم الأرض، والعلوم البيولوجية.
                </p>
                <p>
                    تسعى الكلية إلى تقديم برامج دراسية حديثة تواكب التطور التكنولوجي، وتوفر مختبرات علمية متقدمة لتأهيل الطلاب لسوق العمل المحلي والإقليمي.
                </p>
                <ul class="feature-list">
                    <li><i class="bi-check-circle-fill"></i> برامج بكالوريوس ودراسات عليا معتمدة محلياً ودولياً.</li>
                    <li><i class="bi-check-circle-fill"></i> مختبرات علمية وبحثية مجهزة بأحدث أدوات القياس والتحليل.</li>
                    <li><i class="bi-check-circle-fill"></i> دعم متكامل للطلاب المستجدين والإرشاد الأكاديمي المستمر.</li>
                </ul>
            </div>
            <div class="highlight-box">
                <h5><i class="bi-info-circle-fill"></i> للزوار والطلبة المستجدين:</h5>
                <p style="font-size: 14px; color: #334155; line-height: 1.7; margin-bottom: 15px;">
                    يمكنكم من خلال هذه البوابة طرح أي تساؤل يتعلق بشروط القبول، معادلة المقررات، التنسيب بين الأقسام العلمية، مواعيد الدراسة والامتحانات، أو استخراج الوثائق والإفادات الرسمية.
                </p>
                <a href="#inquiry" style="color: var(--blue-accent); font-weight: 700; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 5px;">
                    إرسال استفسارك للإدارة مباشرة ➔
                </a>
            </div>
        </section>

        <!-- Academic Departments -->
        <section id="departments">
            <div class="section-title">
                <span>البرامج والتخصصات</span>
                <h3>الأقسام العلمية بكلية العلوم</h3>
                <p>تضم الكلية نخبة من الأقسام الأكاديمية والمكاتب الخدمية لتقديم أفضل تجربة تعليمية</p>
            </div>

            <div class="dept-grid">
                @foreach($departments as $dept)
                    <div class="dept-card">
                        <div>
                            <div class="dept-icon">
                                <i class="bi {{ $dept->icon ?? 'bi-book' }}"></i>
                            </div>
                            <h4>{{ $dept->name_ar }}</h4>
                            <p>{{ $dept->description ?? 'يقدم القسم برامج أكاديمية متقدمة وتدريبات معملية تؤهل الخريجين للمنافسة في سوق العمل والبحث العلمي.' }}</p>
                        </div>
                        <a href="#inquiry" class="dept-ask-btn" onclick="document.getElementById('department_id').value = '{{ $dept->id }}';">
                            <i class="bi-question-circle"></i>
                            استفسر عن {{ $dept->name_ar }}
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Inquiry Form Section -->
        <section id="inquiry">
            <div class="inquiry-wrapper">
                <div class="inquiry-header">
                    <h3><i class="bi-pencil-square"></i> استفسر عن أي شيء</h3>
                    <p>يرجى كتابة سؤالك وسيقوم فريق كلية العلوم بمراجعته والرد عليه</p>
                </div>

                <div class="inquiry-body">

                    <!-- Success Message -->
                    @if(session('success_inquiry'))
                        <div class="alert-success">
                            <i class="bi-check-circle-fill"></i>
                            <div>
                                <h4 style="font-size: 16px; font-weight: 700; margin-bottom: 4px;">تم استلام وتخزين استفسارك بنجاح في قاعدة البيانات!</h4>
                                <p style="font-size: 14px;">
                                    شكراً لتواصلك <strong>{{ session('success_inquiry')['name'] }}</strong>. تم تحويل استفسارك إلى جهة الاختصاص (<strong>{{ session('success_inquiry')['department'] }}</strong>).
                                </p>
                                <div>
                                    <span class="alert-code">الرقم المرجعي: {{ session('success_inquiry')['code'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div style="background: #fef2f2; color: #991b1b; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-size: 14px;">
                            <strong>يرجى التأكد من ملء الحقول المطلوبة:</strong>
                            <ul style="padding-right: 20px; margin-top: 6px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('inquiry.submit') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <!-- Full Name -->
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="form-label" for="full_name">
                                    الاسم الكامل <span style="color: #ef4444;">*</span>
                                </label>
                                <input type="text" 
                                       name="full_name" 
                                       id="full_name" 
                                       class="form-control" 
                                       placeholder="مثال: محمد علي الفرجاني" 
                                       value="{{ old('full_name') }}" 
                                       required>
                            </div>

                            <!-- Visitor Type -->
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="form-label" for="sender_type">
                                    صفتك (اختياري)
                                </label>
                                <select name="sender_type" id="sender_type" class="form-select">
                                    <option value="student">طالب بكلية العلوم</option>
                                    <option value="freshman">طالب مستجد / زائر</option>
                                    <option value="alumnus">خريج الكلية</option>
                                    <option value="parent">ولي أمر</option>
                                    <option value="other">استفسار عام</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <!-- Contact -->
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="form-label" for="contact">
                                    البريد الإلكتروني أو رقم الهاتف <span style="color: #ef4444;">*</span>
                                </label>
                                <input type="text" 
                                       name="contact" 
                                       id="contact" 
                                       class="form-control" 
                                       placeholder="مثال: email@domain.com أو 0912345678" 
                                       value="{{ old('contact') }}" 
                                       required>
                            </div>

                            <!-- Department -->
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="form-label" for="department_id">
                                    القسم المعني بالاستفسار
                                </label>
                                <select name="department_id" id="department_id" class="form-select">
                                    <option value="">-- عام / إدارة كلية العلوم --</option>
                                    @foreach($departments as $d)
                                        <option value="{{ $d->id }}" {{ old('department_id') == $d->id ? 'selected' : '' }}>
                                            {{ $d->name_ar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Question / Inquiry -->
                        <div class="form-group">
                            <label class="form-label" for="message">
                                نص السؤال أو الاستفسار بالتفصيل <span style="color: #ef4444;">*</span>
                            </label>
                            <textarea name="message" 
                                      id="message" 
                                      class="form-control" 
                                      placeholder="اكتب كل ما تريد الاستفسار عنه هنا بوضوح وسنقوم بمساعدتك..." 
                                      required>{{ old('message') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-submit">
                            <i class="bi-send-fill"></i>
                            إرسال الاستفسار وحفظه الآن
                        </button>
                    </form>

                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div>
                <strong style="color: white; font-size: 16px;">كلية العلوم - جامعة طرابلس</strong>
                <p style="margin-top: 4px; font-size: 13px;">مجمع الكليات العلمية - باب العكرمي، طرابلس، ليبيا</p>
            </div>
            <div class="footer-copy">
                <span>جاهز للتشغيل على منصة Render &bull; </span>
                <a href="{{ route('admin') }}" style="background: rgba(255,255,255,0.1); padding: 5px 12px; border-radius: 6px; color: #fde047;">
                    <i class="bi-lock"></i> رابط الإدارة لعرض الاستفسارات
                </a>
            </div>
        </div>
    </footer>

</body>
</html>
