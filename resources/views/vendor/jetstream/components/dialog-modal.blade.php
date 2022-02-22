@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="text-lg bg-indigo-800 text-white px-6 pt-3">
        {{ $title }}
    </div>
    
    <div class="px-6 py-4 bg-gray-100">
        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-between px-6 py-4 bg-gray-400 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>
