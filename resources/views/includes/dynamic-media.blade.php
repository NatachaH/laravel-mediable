@if($options['hasName'])
  <x-bs-input class="w-50 mr-2" :label="__('mediable::media.input.name')" :name="'media_to_update['.$item->id.'][name]'" :value="$item->name" />
@endif

<x-bs-input :class="$options['hasName'] ? 'w-50 mr-2' : 'w-100 mr-2'" :label="__('mediable::media.input.file.label')" :name="'media_to_update['.$item->id.'][file]'" :value="$item->filename" readonly :input-group="$options['hasDownload']">
  @if($options['hasDownload'])
    <x-slot name="after">
      <a href="{{ $item->url }}" class="btn {{ config('mediable.buttons.download-input-group.class') }}" download target="_blank" aria-label="{{ __(config('mediable.buttons.download-input-group.label')) }}">
        {!! config('mediable.buttons.download-input-group.value') ?? __(config('mediable.buttons.download-input-group.label')) !!}
      </a>
    </x-slot>
  @endif
</x-bs-input>
