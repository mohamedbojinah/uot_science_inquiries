<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'department_id',
        'phone',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function repliedInquiries()
    {
        return $this->hasMany(Inquiry::class, 'replied_by_user_id');
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'dean']);
    }

    public function getRoleLabelAttribute(): string
    {
        return match($this->role) {
            'admin' => 'مدير النظام',
            'dean' => 'عميد الكلية',
            'department_head' => 'رئيس قسم / مسؤول',
            'staff' => 'موظف شؤون الكلية',
            default => 'مستخدم',
        };
    }
}
