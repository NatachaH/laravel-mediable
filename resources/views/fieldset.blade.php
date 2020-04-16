<fieldset {{ $attributes }}>

  <legend>{{ $legend }}</legend>

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

  <div>
    <input type="hidden" name="media_to_add[0][type]" value="{{ $type }}" />
    <x-bs-input name="media_to_add[0][name]" :placeholder="__('mediable::mediable.input.name')" />
    <x-bs-input-file name="media_to_add[0][file]" :placeholder="__('mediable::mediable.input.placeholder')" :button="__('mediable::mediable.input.button')" />
  </div>

</fieldset>
