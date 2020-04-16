<fieldset {{ $attributes }}>

  <legend>{{ $legend }}</legend>

  @if($currentMedia)
    <div class="list-group ">
      @foreach ($currentMedia as $key => $media)
        <div class="list-group-item d-flex align-items-center">
          <i class="icon icon-file-{{ $media->format }} mr-2"></i>
          {{ $media->name ?? $media->filename }}

          <div class="btn-group-toggle ml-auto btn-media-delete" data-toggle="buttons">
            <label class="btn btn-sm btn-danger active">
              <input type="checkbox" name="media_to_delete[]" value="{{ $media->id }}"> @lang('mediable::delete')
            </label>
          </div>

        </div>
      @endforeach
    </div>
  @endif

  <div class="d-flex align-items-end">
    <input type="hidden" name="media_to_add[0][type]" value="{{ $type }}" />
    @if($hasName)
      <x-bs-input class="w-50 mr-2" label="Name" name="media_to_add[0][name]" :placeholder="__('mediable::mediable.input.name')" />
    @endif
    <x-bs-input-file :class="$hasName ? 'w-50 mr-2' : 'w-100 mr-2'" label="File" name="media_to_add[0][file]" :placeholder="__('mediable::mediable.input.placeholder')" :button="__('mediable::mediable.input.button')" />
    <div class="flex-shrink-1 mb-1">
      <button type="button" class="btn btn-sm btn-gray rounded-circle" aria-label="Delete"><i class="icon icon-cross"></i></button>
    </div>
  </div>



</fieldset>
