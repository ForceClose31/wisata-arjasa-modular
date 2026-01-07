@foreach ($galleries as $gallery)
    <div class="relative w-full pb-[100%] rounded-xl overflow-hidden shadow-lg group transform transition-all duration-300 hover:scale-105 hover:shadow-xl cursor-pointer gallery-item"
        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"
        @click='openModal(
            @json($gallery->title),
            @json("storage/{$gallery->image_path}"),
            @json($gallery->description),
            @json($gallery->location),
            @json(optional($gallery->category)->name)
        )'>
        <img src="storage/{{ $gallery->image_path }}" alt="{{ $gallery->title }}"
            class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
        <div
            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            @if ($gallery->category)
                <span
                    class="inline-block px-3 py-1 mb-2 text-xs font-bold bg-blue-500 rounded-full self-start">
                    {{ $gallery->category->name }}
                </span>
            @endif
            <h3 class="font-bold text-sm leading-tight">{{ $gallery->title }}</h3>
            <p class="text-xs opacity-90 mt-1 line-clamp-2">{{ $gallery->description }}</p>
            @if ($gallery->location)
                <div class="absolute bottom-3 right-3 text-white bg-black/30 p-2 rounded-full">
                    <i class="fas fa-map-marker-alt text-sm"></i>
                </div>
            @endif
        </div>
    </div>
@endforeach