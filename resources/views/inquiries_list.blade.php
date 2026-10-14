<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة الاستفسارات المخزنة - كلية العلوم جامعة طرابلس</title>
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
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: linear-gradient(135deg, #091e36 0%, #0f2b48 100%);
            color: white;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(15, 43, 72, 0.15);
            border-bottom: 3px solid var(--accent-gold);
        }

        .header-container {
            max-width: 1200px;
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
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-navy);
            font-size: 24px;
        }

        .btn-new {
            background: var(--accent-gold);
            color: #1e293b;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-new:hover {
            background: #d97706;
            color: white;
        }

        main {
            flex: 1;
            max-width: 1200px;
            width: 100%;
            margin: 30px auto;
            padding: 0 20px;
        }

        .stats-badge {
            background: white;
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 16px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }

        .stats-badge h2 {
            font-size: 18px;
            color: var(--primary-navy);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge-count {
            background: #dbeafe;
            color: #1e40af;
            font-size: 14px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
        }

        /* Alert */
        .alert-del {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Table Card */
        .table-card {
            background: white;
            border-radius: 14px;
            border: 1px solid var(--card-border);
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
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
            background: #f1f5f9;
            color: #475569;
            padding: 14px 18px;
            font-size: 13px;
            font-weight: 700;
            border-bottom: 1px solid var(--card-border);
            white-space: nowrap;
        }

        td {
            padding: 14px 18px;
            font-size: 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            vertical-align: top;
        }

        tr:hover td {
            background-color: #f8fafc;
        }

        .tracking-code {
            font-family: monospace;
            background: #f1f5f9;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            color: var(--primary-navy);
            direction: ltr;
            display: inline-block;
        }

        .dept-tag {
            background: #e0e7ff;
            color: #3730a3;
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
        }

        .msg-text {
            color: #1e293b;
            line-height: 1.6;
            max-width: 400px;
        }

        .date-text {
            color: var(--text-muted);
            font-size: 12px;
            white-space: nowrap;
        }

        .btn-delete {
            background: #fee2e2;
            color: #991b1b;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-delete:hover {
            background: #ef4444;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 48px;
            color: #cbd5e1;
            margin-bottom: 12px;
            display: block;
        }

        .pagination-container {
            padding: 15px 20px;
            border-top: 1px solid var(--card-border);
            display: flex;
            justify-content: center;
        }

        footer {
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: var(--text-muted);
            background: white;
            border-top: 1px solid var(--card-border);
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <header>
        <div class="header-container">
            <div class="brand-section">
                <div class="brand-logo">
                    <i class="bi-mortarboard-fill"></i>
                </div>
                <div>
                    <h1 style="font-size: 18px; font-weight: 800;">كلية العلوم - جامعة طرابلس</h1>
                    <p style="font-size: 13px; color: #93c5fd;">سجل الاستفسارات والأسئلة المخزنة في قاعدة البيانات</p>
                </div>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn-new">
                    <i class="bi-plus-circle-fill"></i>
                    إدخال استفسار جديد
                </a>
            </div>
        </div>
    </header>

    <main>
        <div class="stats-badge">
            <h2>
                <i class="bi-database-check text-primary"></i>
                الاستفسارات المحفوظة في قاعدة البيانات
            </h2>
            <div class="badge-count">
                إجمالي الاستفسارات: {{ $totalCount }}
            </div>
        </div>

        @if(session('deleted'))
            <div class="alert-del">
                <i class="bi-check-circle-fill"></i> {{ session('deleted') }}
            </div>
        @endif

        <div class="table-card">
            @if($inquiries->count() > 0)
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>الرقم المرجعي</th>
                                <th>اسم المرسل</th>
                                <th>وسيلة التواصل</th>
                                <th>القسم المعني</th>
                                <th>نص السؤال / الاستفسار</th>
                                <th>تاريخ الإرسال</th>
                                <th>إجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inquiries as $item)
                                <tr>
                                    <td>
                                        <span class="tracking-code">{{ $item->tracking_code }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $item->full_name }}</strong>
                                    </td>
                                    <td>
                                        <div style="font-size: 13px;">{{ $item->email ?? $item->phone }}</div>
                                    </td>
                                    <td>
                                        <span class="dept-tag">
                                            {{ $item->department ? $item->department->name_ar : 'عام / الإدارة' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="msg-text">{{ $item->message }}</div>
                                    </td>
                                    <td>
                                        <div class="date-text">{{ $item->created_at->format('Y-m-d') }}</div>
                                        <div class="date-text">{{ $item->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td>
                                        <form action="{{ route('inquiries.delete', $item->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا الاستفسار من قاعدة البيانات؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" title="حذف">
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
                    <div class="pagination-container">
                        {{ $inquiries->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="bi-inbox"></i>
                    <h3>لا توجد استفسارات مسجلة حالياً</h3>
                    <p>يمكنك البدء بإرسال أول استفسار عبر نموذج الصفحة الرئيسية.</p>
                    <div style="margin-top: 15px;">
                        <a href="{{ route('home') }}" class="btn-new">إدخال استفسار الآن</a>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <footer>
        <p>كلية العلوم - جامعة طرابلس &copy; {{ date('Y') }} | مهيأ للنشر على منصة Render</p>
    </footer>

</body>
</html>
