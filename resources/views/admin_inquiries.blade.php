<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الإدارة | استعراض استفسارات كلية العلوم</title>
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
            --bg-light: #f1f5f9;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #cbd5e1;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Cairo', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Admin Bar */
        header {
            background: linear-gradient(135deg, #07192f 0%, #0f2b48 100%);
            color: white;
            padding: 16px 24px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            border-bottom: 3px solid var(--gold-accent);
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-badge {
            background: #ef4444;
            color: white;
            font-size: 11px;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 4px;
            letter-spacing: 0.5px;
        }

        .brand h1 {
            font-size: 18px;
            font-weight: 800;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-action {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn-light {
            background: rgba(255, 255, 255, 0.12);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-light:hover {
            background: white;
            color: var(--navy-primary);
        }

        .btn-export {
            background: #10b981;
            color: white;
        }

        .btn-export:hover {
            background: #059669;
        }

        /* Main Container */
        main {
            flex: 1;
            max-width: 1400px;
            width: 100%;
            margin: 25px auto;
            padding: 0 20px;
        }

        /* Metrics Cards */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .metric-card {
            background: white;
            border-radius: 14px;
            padding: 20px;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .metric-info h3 {
            font-size: 26px;
            font-weight: 800;
            color: var(--navy-primary);
            line-height: 1.2;
        }

        .metric-info p {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 600;
            margin-top: 2px;
        }

        .metric-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .metric-icon.blue { background: #dbeafe; color: #1e40af; }
        .metric-icon.green { background: #d1fae5; color: #065f46; }
        .metric-icon.amber { background: #fef3c7; color: #b45309; }
        .metric-icon.purple { background: #ede9fe; color: #5b21b6; }

        /* Filter Bar */
        .filter-card {
            background: white;
            border-radius: 14px;
            padding: 18px 22px;
            margin-bottom: 22px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .filter-form {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .search-input {
            flex: 2;
            min-width: 240px;
            padding: 10px 14px;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }

        .dept-select {
            flex: 1;
            min-width: 200px;
            padding: 10px 14px;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            background: white;
        }

        .btn-filter {
            background: var(--blue-accent);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-reset {
            background: #e2e8f0;
            color: #475569;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Success & Flash Alerts */
        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Inquiries Table */
        .table-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        th {
            background: #f8fafc;
            color: #475569;
            padding: 14px 18px;
            font-size: 13px;
            font-weight: 700;
            border-bottom: 1.5px solid var(--border-color);
            white-space: nowrap;
        }

        td {
            padding: 14px 18px;
            font-size: 14px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
            color: #334155;
        }

        tr:hover td {
            background-color: #f8fafc;
        }

        .code-tag {
            font-family: monospace;
            background: #f1f5f9;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            color: var(--navy-primary);
            direction: ltr;
            display: inline-block;
        }

        .sender-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
            margin-top: 4px;
        }

        .sender-badge.student { background: #dbeafe; color: #1e40af; }
        .sender-badge.freshman { background: #fef3c7; color: #b45309; }
        .sender-badge.alumnus { background: #ede9fe; color: #6d28d9; }
        .sender-badge.other { background: #f1f5f9; color: #475569; }

        .dept-badge {
            background: #e0e7ff;
            color: #3730a3;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
        }

        .inquiry-content {
            color: #1e293b;
            line-height: 1.6;
            max-width: 450px;
            white-space: pre-line;
        }

        .date-box {
            font-size: 12px;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .btn-delete {
            background: #fee2e2;
            color: #991b1b;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-delete:hover {
            background: #ef4444;
            color: white;
        }

        .empty-box {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-box i {
            font-size: 50px;
            color: #cbd5e1;
            margin-bottom: 12px;
            display: block;
        }

        .pagination-area {
            padding: 16px 24px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: center;
        }

        footer {
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: var(--text-muted);
            background: white;
            border-top: 1px solid var(--border-color);
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <!-- Admin Header -->
    <header>
        <div class="header-container">
            <div class="brand">
                <i class="bi-mortarboard-fill" style="font-size: 24px;"></i>
                <div>
                    <h1>كلية العلوم - جامعة طرابلس</h1>
                    <span class="brand-badge">لوحة تحكم الإدارة</span>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('admin.export') }}" class="btn-action btn-export" title="تصدير جدول الاستفسارات">
                    <i class="bi-file-earmark-excel"></i>
                    تصدير Excel / CSV
                </a>
                <a href="{{ route('visitors') }}" class="btn-action btn-light" target="_blank" title="مشاهدة رابط الزوار">
                    <i class="bi-globe"></i>
                    رابط الزوار (البوابة) ➔
                </a>
            </div>
        </div>
    </header>

    <main>

        <!-- Metrics -->
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-info">
                    <h3>{{ $totalCount }}</h3>
                    <p>إجمالي الاستفسارات المستلمة</p>
                </div>
                <div class="metric-icon blue">
                    <i class="bi-chat-left-text-fill"></i>
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-info">
                    <h3>{{ $todayCount }}</h3>
                    <p>استفسارات وردت اليوم</p>
                </div>
                <div class="metric-icon green">
                    <i class="bi-calendar-check-fill"></i>
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-info">
                    <h3>{{ $studentCount }}</h3>
                    <p>استفسارات طلاب الكلية</p>
                </div>
                <div class="metric-icon amber">
                    <i class="bi-person-badge-fill"></i>
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-info">
                    <h3>{{ $visitorCount }}</h3>
                    <p>استفسارات زوار ومستجدين</p>
                </div>
                <div class="metric-icon purple">
                    <i class="bi-people-fill"></i>
                </div>
            </div>
        </div>

        @if(session('deleted'))
            <div class="alert-success">
                <i class="bi-check-circle-fill"></i>
                {{ session('deleted') }}
            </div>
        @endif

        <!-- Filter & Search -->
        <div class="filter-card">
            <form action="{{ route('admin') }}" method="GET" class="filter-form">
                <input type="text" 
                       name="search" 
                       class="search-input" 
                       placeholder="بحث بالاسم، البريد، رقم الهاتف، أو الرقم المرجعي..." 
                       value="{{ request('search') }}">

                <select name="department_id" class="dept-select">
                    <option value="">-- كل الأقسام العلمية --</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name_ar }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn-filter">
                    <i class="bi-search"></i>
                    تصفية
                </button>

                @if(request('search') || request('department_id'))
                    <a href="{{ route('admin') }}" class="btn-reset">
                        إلغاء التصفية
                    </a>
                @endif
            </form>
        </div>

        <!-- Inquiries Table -->
        <div class="table-card">
            @if($inquiries->count() > 0)
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>الرقم المرجعي</th>
                                <th>اسم الزائر / الطالب</th>
                                <th>وسيلة التواصل</th>
                                <th>القسم المختص</th>
                                <th>نص السؤال والاستفسار</th>
                                <th>تاريخ الإرسال</th>
                                <th>إجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inquiries as $inq)
                                <tr>
                                    <td>
                                        <span class="code-tag">{{ $inq->tracking_code }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $inq->full_name }}</strong>
                                        <div>
                                            <span class="sender-badge {{ $inq->sender_type }}">
                                                {{ $inq->sender_type_label }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600;">{{ $inq->email ?? $inq->phone }}</div>
                                        @if($inq->email && $inq->phone)
                                            <div style="font-size: 12px; color: var(--text-muted);">{{ $inq->phone }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="dept-badge">
                                            {{ $inq->department ? $inq->department->name_ar : 'عام / الإدارة' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="inquiry-content">{{ $inq->message }}</div>
                                    </td>
                                    <td>
                                        <div class="date-box">{{ $inq->created_at->format('Y-m-d') }}</div>
                                        <div class="date-box">{{ $inq->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.delete', $inq->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا الاستفسار من قاعدة البيانات؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" title="حذف من قاعدة البيانات">
                                                <i class="bi-trash3"></i> حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($inquiries->hasPages())
                    <div class="pagination-area">
                        {{ $inquiries->links() }}
                    </div>
                @endif
            @else
                <div class="empty-box">
                    <i class="bi-inbox"></i>
                    <h3>لا توجد استفسارات مطابقة</h3>
                    <p>لم يتم العثور على أي استفسارات مسجلة في قاعدة البيانات وفق معايير البحث الحالية.</p>
                </div>
            @endif
        </div>

    </main>

    <footer>
        كلية العلوم - جامعة طرابلس &copy; {{ date('Y') }} &bull; منصة إدارة الاستفسارات والأسئلة الواردة
    </footer>

</body>
</html>
