<?php

namespace Modules\Core\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'action',
        'model_type',
        'model_id',
        'description',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function getActionColorAttribute()
    {
        return match ($this->action) {
            'created' => 'text-green-600 bg-green-100',
            'updated' => 'text-blue-600 bg-blue-100',
            'deleted' => 'text-red-600 bg-red-100',
            'login' => 'text-purple-600 bg-purple-100',
            default => 'text-gray-600 bg-gray-100'
        };
    }

    public function getActionIconAttribute()
    {
        return match ($this->action) {
            'created' => 'fas fa-plus-circle',
            'updated' => 'fas fa-edit',
            'deleted' => 'fas fa-trash-alt',
            'login' => 'fas fa-sign-in-alt',
            default => 'fas fa-info-circle'
        };
    }
}
