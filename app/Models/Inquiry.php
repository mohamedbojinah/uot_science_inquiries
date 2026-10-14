<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_code',
        'sender_type',
        'full_name',
        'national_id_or_student_id',
        'email',
        'phone',
        'department_id',
        'category_id',
        'priority',
        'subject',
        'message',
        'attachment_path',
        'attachment_name',
        'status',
        'reply_message',
        'replied_by_user_id',
        'replied_at',
        'internal_notes',
        'is_public_faq',
        'faq_question',
        'faq_answer',
        'viewed_by_student_at',
        'ip_address',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
        'viewed_by_student_at' => 'datetime',
        'is_public_faq' => 'boolean',
    ];

    public static function generateTrackingCode(): string
    {
        $year = date('Y');
        do {
            $random = strtoupper(Str::random(4));
            $num = rand(100, 999);
            $code = "UOT-SCI-{$year}-{$random}{$num}";
        } while (static::where('tracking_code', $code)->exists());

        return $code;
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function category()
    {
        return $this->belongsTo(InquiryCategory::class, 'category_id');
    }

    public function repliedBy()
    {
        return $this->belongsTo(User::class, 'replied_by_user_id');
    }

    public function logs()
    {
        return $this->hasMany(InquiryLog::class)->orderBy('created_at', 'desc');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'new' => 'جديد',
            'in_review' => 'قيد المراجعة',
            'answered' => 'تم الرد',
            'closed' => 'مغلق',
            default => 'غير محدد',
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'new' => 'bg-warning text-dark',
            'in_review' => 'bg-primary text-white',
            'answered' => 'bg-success text-white',
            'closed' => 'bg-secondary text-white',
            default => 'bg-light text-dark',
        };
    }

    public function getPriorityLabelAttribute(): string
    {
        return match($this->priority) {
            'urgent' => 'عاجل',
            'normal' => 'عادي',
            default => 'عادي',
        };
    }

    public function getPriorityBadgeAttribute(): string
    {
        return match($this->priority) {
            'urgent' => 'badge-urgent',
            default => 'badge-normal',
        };
    }

    public function getSenderTypeLabelAttribute(): string
    {
        return match($this->sender_type) {
            'student' => 'طالب بالكلية',
            'alumnus' => 'خريج',
            'visitor' => 'مستجد / زائر',
            'faculty_staff' => 'عضو هيئة تدريس / موظف',
            default => 'طالب بالكلية',
        };
    }
}
