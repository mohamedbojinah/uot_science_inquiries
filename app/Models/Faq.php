<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'category_id',
        'question',
        'answer',
        'views_count',
        'helpful_count',
        'is_published',
        'display_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'views_count' => 'integer',
        'helpful_count' => 'integer',
        'display_order' => 'integer',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function category()
    {
        return $this->belongsTo(InquiryCategory::class, 'category_id');
    }
}
