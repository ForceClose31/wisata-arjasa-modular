<?php

namespace Modules\Core\app\Traits;

use Modules\Core\app\Models\AdminActivity;
use Illuminate\Support\Facades\Request;

trait Loggable
{
    public static function bootLoggable()
    {
        static::created(function ($model) {
            $model->logActivity('created', 'Created ' . class_basename($model));
        });

        static::updated(function ($model) {
            $model->logActivity('updated', 'Updated ' . class_basename($model));
        });

        static::deleted(function ($model) {
            $model->logActivity('deleted', 'Deleted ' . class_basename($model));
        });
    }

    protected function logActivity($action, $description)
    {
        if (auth()->guard('admin')->check()) {
            AdminActivity::create([
                'admin_id' => auth()->guard('admin')->id(),
                'action' => $action,
                'model_type' => get_class($this),
                'model_id' => $this->getKey(),
                'description' => $description,
                'old_values' => $this->getOriginal(),
                'new_values' => $action === 'deleted' ? null : $this->getAttributes(),
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
            ]);
        }
    }
}
