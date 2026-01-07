<div class="space-y-4 max-h-96 overflow-y-auto scrollbar-thin">
    @forelse($recentActivities as $activity)
        <div
            class="flex items-start space-x-3 p-3 rounded-lg border border-gray-100 hover:border-gray-200 transition-colors duration-200">
            <div class="flex-shrink-0">
                <div class="flex items-center justify-center w-10 h-10 rounded-full {{ $activity->action_color }}">
                    <i class="{{ $activity->action_icon }} text-sm"></i>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900">
                    {{ $activity->admin->username }}
                    <span class="font-normal text-gray-600">{{ $activity->description }}</span>
                </p>
                <div class="flex items-center mt-1 text-xs text-gray-500">
                    <i class="fas fa-clock mr-1"></i>
                    <span>{{ $activity->created_at->diffForHumans() }}</span>
                    <span class="mx-2">•</span>
                    <i class="fas fa-globe mr-1"></i>
                    <span>{{ $activity->ip_address }}</span>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-4">
            <i class="fas fa-history text-3xl text-gray-300 mb-2"></i>
            <p class="text-gray-500">Belum ada aktivitas</p>
        </div>
    @endforelse
</div>
