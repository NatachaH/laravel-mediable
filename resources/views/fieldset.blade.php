<x-bs-dynamic :legend="$legend" :current="$currentMedia" :is-dynamic="$isDynamic" :min="$min" :max="$max" delete-name="media_to_delete[]">

  <x-slot name="form">

    <input type="hidden" name="media_to_add[KEY][type]" value="{{ $type }}" />

    @if($hasName)
      <x-bs-input class="w-50 mr-2" label="Name" name="media_to_add[KEY][name]" :placeholder="__('mediable::mediable.input.name')" />
    @endif

    <x-bs-input-file :class="$hasName ? 'w-50 mr-2' : 'w-100 mr-2'" label="File" name="media_to_add[KEY][file]" :placeholder="__('mediable::mediable.input.placeholder')" :button="__('mediable::mediable.input.button')" />

  </x-slot>

</x-bs-dynamic>
