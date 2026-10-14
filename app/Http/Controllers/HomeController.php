<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faq;
use App\Models\Inquiry;
use App\Models\InquiryCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $departments = Department::where('is_active', true)->ordered()->get();
        $categories = InquiryCategory::where('is_active', true)->orderBy('display_order')->get();
        $faqs = Faq::where('is_published', true)->orderBy('display_order')->take(6)->get();

        $totalInquiries = Inquiry::count();
        $answeredInquiries = Inquiry::where('status', 'answered')->count();
        $inReviewInquiries = Inquiry::where('status', 'in_review')->count();
        $departmentsCount = $departments->count();
        $responseRate = $totalInquiries > 0 ? round(($answeredInquiries / $totalInquiries) * 100) : 98;

        return view('home', compact(
            'departments',
            'categories',
            'faqs',
            'totalInquiries',
            'answeredInquiries',
            'inReviewInquiries',
            'departmentsCount',
            'responseRate'
        ));
    }
}
