<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('inquiries')
            ->where('is_active', true)
            ->orderBy('id')
            ->get();

        return view('departments.index', compact('departments'));
    }
}
