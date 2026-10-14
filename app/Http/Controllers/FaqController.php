<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faq;
use App\Models\InquiryCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::where('is_active', true)->ordered()->get();
        $categories = InquiryCategory::where('is_active', true)->orderBy('display_order')->get();

        $query = Faq::with(['department', 'category'])->where('is_published', true);

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $keyword = '%' . $request->search . '%';
            $query->where(function ($q) use ($keyword) {
                $q->where('question', 'like', $keyword)
                  ->orWhere('answer', 'like', $keyword);
            });
        }

        $faqs = $query->orderBy('display_order')->paginate(12)->withQueryString();

        return view('faqs.index', compact('faqs', 'departments', 'categories'));
    }

    public function helpful(Request $request, int $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->increment('helpful_count');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'count' => $faq->helpful_count,
            ]);
        }

        return back()->with('success', 'شكراً لمشاركتك رأيك!');
    }
}
