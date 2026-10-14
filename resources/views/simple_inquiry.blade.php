<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوابة استفسارات كلية العلوم - جامعة طرابلس</title>
    <!-- Google Font: Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary-navy: #0f2b48;
            --primary-blue: #1d4ed8;
            --accent-gold: #f59e0b;
            --accent-emerald: #10b981;
            --bg-light: #f8fafc;
            --card-border: #e2e8f0;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Cairo', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background-color: var(--bg-light);
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, #091e36 0%, #0f2b48 100%);
            color: white;
            padding: 24px 20px;
            box-shadow: 0 4px 20px rgba(15, 43, 72, 0.15);
            border-bottom: 3px solid var(--accent-gold);
        }

        .header-container {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .brand-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand-logo {
            width: 58px;
            height: 58px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            color: var(--primary-navy);
            font-size: 28px;
        }

        .brand-text h1 {
            font-size: 20px;
            font-weight: 800;
            line-height: 1.3;
        }

        .brand-text p {
            font-size: 13px;
            color: #93c5fd;
            font-weight: 600;
        }

        .header-link {
            background: rgba(255, 255, 255, 0.12);
            color: white;
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header-link:hover {
            background: white;
            color: var(--primary-navy);
        }

        /* Main Content */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .form-card {
            background: white;
            width: 100%;
            max-width: 680px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--card-border);
            overflow: hidden;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-header {
            background: #f1f5f9;
            padding: 22px 28px;
            border-bottom: 1px solid var(--card-border);
            text-align: center;
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-navy);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .card-header p {
            color: var(--text-muted);
            font-size: 14px;
            margin-top: 6px;
        }

        .card-body {
            padding: 30px 28px;
        }

        /* Success Alert */
        .alert-success-box {
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

        .alert-icon {
            font-size: 28px;
            color: var(--accent-emerald);
            line-height: 1;
        }

        .alert-content h4 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .alert-content p {
            font-size: 14px;
            color: #047857;
            line-height: 1.6;
        }

        .alert-code {
            display: inline-block;
            background: #d1fae5;
            padding: 3px 10px;
            border-radius: 6px;
            font-weight: 700;
            color: #065f46;
            margin-top: 6px;
            letter-spacing: 0.5px;
            direction: ltr;
        }

        /* Error Messages */
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error ul {
            padding-right: 20px;
            margin-top: 5px;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
        }

        .required-star {
            color: #ef4444;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 15px;
            color: var(--text-dark);
            background-color: #fff;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.12);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .form-hint {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #0f2b48 0%, #1e40af 100%);
            color: white;
            border: none;
            width: 100%;
            padding: 15px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(15, 43, 72, 0.2);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(15, 43, 72, 0.3);
            background: linear-gradient(135deg, #0a1f35 0%, #172554 100%);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: var(--text-muted);
            border-top: 1px solid var(--card-border);
            background: white;
        }

        footer a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="header-container">
            <div class="brand-section">
                <div class="brand-logo">
                    <i class="bi-mortarboard-fill"></i>
                </div>
                <div class="brand-text">
                    <h1>كلية العلوم - جامعة طرابلس</h1>
                    <p>بوابة استقبال الأسئلة والاستفسارات الرسمية</p>
                </div>
            </div>
            <div>
                <a href="{{ route('inquiries.list') }}" class="header-link">
                    <i class="bi-view-list"></i>
                    استعراض الاستفسارات المخزنة
                </a>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main>
        <div class="form-card">
            <div class="card-header">
                <h2><i class="bi-chat-left-dots-fill text-primary"></i> إرسال سؤال أو استفسار</h2>
                <p>يرجى تعبئة النموذج أدناه وسيتم حفظ استفسارك في قاعدة بيانات الكلية لمراجعته والرد عليه</p>
            </div>

            <div class="card-body">

                <!-- Success Alert -->
                @if(session('success_inquiry'))
                    <div class="alert-success-box">
                        <div class="alert-icon">
                            <i class="bi-check-circle-fill"></i>
                        </div>
                        <div class="alert-content">
                            <h4>تم استلام استفسارك بنجاح!</h4>
                            <p>
                                شكراً لك <strong>{{ session('success_inquiry')['name'] }}</strong>، تم توجيه استفسارك بنجاح إلى (<strong>{{ session('success_inquiry')['department'] }}</strong>).
                            </p>
                            <div>
                                <span class="alert-code">رقم المرجع: {{ session('success_inquiry')['code'] }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert-error">
                        <strong>يرجى تصحيح الأخطاء التالية:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Inquiry Form -->
                <form action="{{ route('inquiry.submit') }}" method="POST">
                    @csrf

                    <!-- Full Name -->
                    <div class="form-group">
                        <label class="form-label" for="full_name">
                            الاسم الكامل <span class="required-star">*</span>
                        </label>
                        <input type="text" 
                               name="full_name" 
                               id="full_name" 
                               class="form-control" 
                               placeholder="مثال: أحمد محمد علي" 
                               value="{{ old('full_name') }}" 
                               required>
                    </div>

                    <!-- Contact (Email or Phone) -->
                    <div class="form-group">
                        <label class="form-label" for="contact">
                            البريد الإلكتروني أو رقم الهاتف للتواصل <span class="required-star">*</span>
                        </label>
                        <input type="text" 
                               name="contact" 
                               id="contact" 
                               class="form-control" 
                               placeholder="مثال: student@uot.edu.ly أو 0912345678" 
                               value="{{ old('contact') }}" 
                               required>
                        <div class="form-hint">سنستخدم هذه الوسيلة للتواصل معك أو إرسال الإجابة.</div>
                    </div>

                    <!-- Department -->
                    <div class="form-group">
                        <label class="form-label" for="department_id">
                            القسم الأكاديمي أو الإدارة المختصة
                        </label>
                        <select name="department_id" id="department_id" class="form-select">
                            <option value="">-- اختر القسم المختص (اختياري) --</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name_ar }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-hint">إذا كنت غير متأكد يمكنك تركه فارغاً وسيتم توجيهه للإدارة العامة.</div>
                    </div>

                    <!-- Question / Message -->
                    <div class="form-group">
                        <label class="form-label" for="message">
                            نص السؤال أو الاستفسار بالتفصيل <span class="required-star">*</span>
                        </label>
                        <textarea name="message" 
                                  id="message" 
                                  class="form-control" 
                                  placeholder="اكتب استفسارك أو سؤالك هنا بوضوح..." 
                                  required>{{ old('message') }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit">
                        <i class="bi-send-fill"></i>
                        إرسال الاستفسار وحفظه
                    </button>
                </form>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>
            كلية العلوم - جامعة طرابلس &copy; {{ date('Y') }} | جاهز للتشغيل السحابي على منصة Render
            &bull; <a href="{{ route('inquiries.list') }}">عرض الاستفسارات المخزنة</a>
        </p>
    </footer>

</body>
</html>
