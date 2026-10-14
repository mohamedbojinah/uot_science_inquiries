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

    
    public function scopeOrdered($query)
    {
        return $query->orderByRaw("CASE WHEN code = 'MATH' OR name_ar LIKE '%رياضيات%' THEN 0 ELSE 1 END")
                     ->orderBy('name_ar');
    }
}
