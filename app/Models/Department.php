<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'code',
        'description',
        'email',
        'phone',
        'office_location',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
