<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::with('department')->latest()->paginate(15);
        $departments = Department::where('is_active', true)->ordered()->get();

        return view('admin.users.index', compact('users', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,dean,department_head,staff',
            'department_id' => 'nullable|exists:departments,id',
            'phone' => 'nullable|string|max:30',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = true;

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'تم إنشاء حساب الموظف / المشرف بنجاح.');
    }

    public function toggleStatus(int $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'لا يمكنك تعطيل حسابك الحالي.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $statusText = $user->is_active ? 'تفعيل' : 'تعطيل';
        return back()->with('success', "تم {$statusText} حساب ({$user->name}) بنجاح.");
    }
}
