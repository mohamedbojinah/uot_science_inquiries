<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Faq;
use App\Models\InquiryCategory;
use Illuminate\Http\Request;

class FaqAdminController extends Controller
{
    public function index()
    {
        $faqs = Faq::with(['department', 'category'])->orderBy('display_order')->paginate(15);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $departments = Department::where('is_active', true)->get();
        $categories = InquiryCategory::where('is_active', true)->get();
        return view('admin.faqs.create', compact('departments', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|min:5',
            'answer' => 'required|string|min:10',
            'department_id' => 'nullable|exists:departments,id',
            'category_id' => 'nullable|exists:inquiry_categories,id',
            'display_order' => 'nullable|integer',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'تم إضافة السؤال الشائع بنجاح.');
    }

    public function edit(int $id)
    {
        $faq = Faq::findOrFail($id);
        $departments = Department::where('is_active', true)->get();
        $categories = InquiryCategory::where('is_active', true)->get();
        return view('admin.faqs.edit', compact('faq', 'departments', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $faq = Faq::findOrFail($id);

        $validated = $request->validate([
            'question' => 'required|string|min:5',
            'answer' => 'required|string|min:10',
            'department_id' => 'nullable|exists:departments,id',
            'category_id' => 'nullable|exists:inquiry_categories,id',
            'display_order' => 'nullable|integer',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'تم تحديث السؤال الشائع بنجاح.');
    }

    public function destroy(int $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'تم حذف السؤال بنجاح.');
    }
}
