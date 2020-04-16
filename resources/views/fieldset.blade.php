<fieldset {{ $attributes }}>

  <legend>{{ $legend }}</legend>

  <div>
    <input type="hidden" name="media_to_add[0][type]" value="{{ $type }}" />
    <x-bs-input-file name="media_to_add[0][file]" placeholder="@lang('mediable::mediable.input.placeholder')" button="@lang('mediable::mediable.input.button')" />
  </div>

</fieldset>
