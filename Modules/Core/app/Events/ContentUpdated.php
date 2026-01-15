<?php

namespace Modules\Core\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContentUpdated
{
    use Dispatchable, SerializesModels;

    public Model $model;
    public string $action;
    public array $changes;

    public function __construct(Model $model, string $action, array $changes = [])
    {
        $this->model = $model;
        $this->action = $action;
        $this->changes = $changes;
    }
}
