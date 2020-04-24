<x-bs-dynamic
  class="dynamic-media"
  :legend="$legend"
  :min="$min"
  :max="$max"
  name="media"
  :key="'KEY_'.$type"
  :sortable="$sortable"
  :items="$current"
  viewItem="mediable::includes.dynamic-media"
  :viewItemOptions="['hasName' => $hasName, 'hasDownload' => $hasDownload]"
  :help="$help"
>

  <x-slot name="template">

      <input type="hidden" name="media_to_add[KEY_{{ $type }}][type]" value="{{ $type }}" />

      @if($hasName)
        <x-bs-input class="w-50 mr-2" :label="__('mediable::media.input.name')" :name="'media_to_add[KEY_'.$type.'][name]'" :placeholder="__('mediable::media.input.name')" />
      @endif

      <x-bs-input-file :class="$hasName ? 'w-50 mr-2' : 'w-100 mr-2'" :label="__('mediable::media.input.file.label')" :name="'media_to_add[KEY_'.$type.'][file]'" :placeholder="__('mediable::media.input.file.placeholder')" :button="__('mediable::media.input.file.button')" />

  </x-slot>

</x-bs-dynamic>
