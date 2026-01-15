<?php

namespace Modules\Core\Listeners;

use Modules\Core\Events\ContentUpdated;
use Modules\Core\Services\CacheService;
use Modules\Core\Services\NotificationService;

class ClearRelatedCache
{
    public function __construct(
        private CacheService $cacheService,
        private NotificationService $notificationService
    ) {
    }

    public function handle(ContentUpdated $event): void
    {
        // Clear model cache
        if (method_exists($event->model, 'clearCache')) {
            $event->model->clearCache();
        }

        // Clear related caches
        $this->clearRelatedCaches($event->model);

        // Log activity
        $this->notificationService->logActivity(
            $event->action,
            "Content updated: " . class_basename($event->model),
            [
                'model_id' => $event->model->getKey(),
                'changes' => $event->changes
            ]
        );

        // Notify admin for important actions
        if (in_array($event->action, ['created', 'deleted'])) {
            $this->notificationService->notifyAdmin(
                $event->action,
                [
                    'model' => class_basename($event->model),
                    'id' => $event->model->getKey(),
                    'changes' => $event->changes
                ]
            );
        }
    }

    private function clearRelatedCaches($model): void
    {
        // Clear homepage cache
        $this->cacheService->forget('homepage_data');

        // Clear listing caches
        $modelName = strtolower(class_basename($model));
        $this->cacheService->flushTags(["{$modelName}_list", "{$modelName}_featured"]);
    }
}
