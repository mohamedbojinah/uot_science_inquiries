<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Faq;
use App\Models\Inquiry;
use App\Models\InquiryCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $inquiryQuery = Inquiry::query();
        // If department head, filter by their department by default or show full with highlight
        if ($user->role === 'department_head' && $user->department_id) {
            // keep query focused or general
        }

        $totalInquiries = Inquiry::count();
        $newInquiries = Inquiry::where('status', 'new')->count();
        $inReviewInquiries = Inquiry::where('status', 'in_review')->count();
        $answeredInquiries = Inquiry::where('status', 'answered')->count();
        $urgentPending = Inquiry::where('priority', 'urgent')->whereIn('status', ['new', 'in_review'])->count();
        $todayInquiries = Inquiry::whereDate('created_at', today())->count();
        $faqsCount = Faq::count();
        $usersCount = User::count();

        $recentInquiries = Inquiry::with(['department', 'category', 'repliedBy'])
            ->latest()
            ->take(8)
            ->get();

        $departmentStats = Department::withCount([
            'inquiries',
            'inquiries as pending_count' => function ($q) {
                $q->whereIn('status', ['new', 'in_review']);
            },
            'inquiries as answered_count' => function ($q) {
                $q->where('status', 'answered');
            }
        ])->where('is_active', true)->ordered()->get();

        return view('admin.dashboard', compact(
            'totalInquiries',
            'newInquiries',
            'inReviewInquiries',
            'answeredInquiries',
            'urgentPending',
            'todayInquiries',
            'faqsCount',
            'usersCount',
            'recentInquiries',
            'departmentStats'
        ));
    }
}
