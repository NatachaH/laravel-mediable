<x-bs-dynamic
  class="dynamic-media"
  :legend="$legend"
  :is-active="$isMultiple"
  :min="$min"
  :max="$max"
  :help="$help"
  :btnAdd="['class' => config('mediable.buttons.add.class'),'label' => __('mediable::media.add'),'value' => config('mediable.buttons.add.value') ?: ('mediable::media.add')]"
  :btnRemove="['class' => config('mediable.buttons.remove.class'),'label' => __('mediable::media.remove'),'value' => config('mediable.buttons.remove.value') ?: ('mediable::media.remove')]
">

  @foreach ($current as $key => $media)
    <div class="d-flex align-items-end dynamic-item dynamic-item-current">

        @if($sortable)
          <button class="btn drag {{ config('mediable.buttons.drag.class') }}" aria-label="@lang('mediable::media.move')">
            {!! config('mediable.buttons.drag.value') ?: __('mediable::media.move') !!}
          </button>
          <input type="hidden" class="dynamic-position" name="media_to_update[{{ $media->id }}][position]" value="{{ $media->position }}"/>
        @endif

        @if($hasName)
          <x-bs-input class="w-50 mr-2" :label="__('mediable::media.input.name')" :name="'media_to_update['.$media->id.'][name]'" :value="$media->name" />
        @endif

        <x-bs-input :class="$hasName ? 'w-50 mr-2' : 'w-100 mr-2'" :label="__('mediable::media.input.file.label')" :name="'media_to_update['.$media->id.'][file]'" :value="$media->filename" readonly :input-group="$hasDownload">
          @if($hasDownload)
            <x-slot name="after">
              <a href="{{ $media->url }}" class="btn {{ config('mediable.buttons.download-input-group.class') }}" download target="_blank" aria-label="@lang('mediable::media.action.download')">
                {!! config('mediable.buttons.download-input-group.value') ?: __('mediable::media.download') !!}
              </a>
            </x-slot>
          @endif
        </x-bs-input>

        <div class="dynamic-item-btn btn-group-toggle ml-auto" data-toggle="buttons">
           <label class="btn {{ config('mediable.buttons.delete.class') }}">
               <input class="dynamic-delete" type="checkbox" name="media_to_delete[]" value="{{ $media->id }}" aria-label="@lang('mediable::media.delete')">
               {!! config('mediable.buttons.delete.value') ?: __('mediable::media.delete') !!}
           </label>
        </div>

    </div>
  @endforeach

  <x-slot name="template">

      @if($sortable)
        <button class="btn drag {{ config('mediable.buttons.drag.class') }}" aria-label="@lang('mediable::media.move')">
          {!! config('mediable.buttons.drag.value') ?: __('mediable::media.move') !!}
        </button>
        <input type="hidden" class="dynamic-position" name="media_to_add[KEY_{{ $type }}][position]"/>
      @endif

      <input type="hidden" name="media_to_add[KEY_{{ $type }}][type]" value="{{ $type }}" />

      @if($hasName)
        <x-bs-input class="w-50 mr-2" :label="__('mediable::media.input.name')" :name="'media_to_add[KEY_'.$type.'][name]'" :placeholder="__('mediable::media.input.name')" />
      @endif

      <x-bs-input-file :class="$hasName ? 'w-50 mr-2' : 'w-100 mr-2'" :label="__('mediable::media.input.file.label')" :name="'media_to_add[KEY_'.$type.'][file]'" :placeholder="__('mediable::media.input.file.placeholder')" :button="__('mediable::media.input.file.button')" />

  </x-slot>

</x-bs-dynamic>
