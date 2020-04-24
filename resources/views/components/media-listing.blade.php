<ul {{ $attributes->merge(['class' => 'list-group '.($sortable ? 'media-sortable' : '')]) }} @if($sortable) data-sortable-model="Nh\Mediable\Media" @endif>

  @foreach ($items as $item)

      <li class="list-group-item d-flex align-items-center" data-id="{{ $item->id }}">

          @if($sortable)
            <button class="btn drag {{ config('mediable.buttons.sortable.class') }}" aria-label="{{ __(config('mediable.buttons.sortable.label')) }}">
              {!! config('mediable.buttons.sortable.value') ?? __(config('mediable.buttons.sortable.label'))  !!}
            </button>
          @endif

          <span class="mr-auto {{ $sortable ? 'border-left pl-3' : '' }}">
            <i class="mediable-file-{{ $item->format }} mr-1"></i>
            {{ $item->name ?? $item->filename }} @isset($item->name) <small class="text-muted font-italic">{{ $item->filename }}</small> @endisset
          </span>

          @if($showDate)
            <small class="text-muted font-italic mr-4">{{ $item->created_at }}</small>
          @endif

          @if($hasDownload)
            <a href="{{ $item->url }}" class="btn {{ config('mediable.buttons.download.class') }}" download target="_blank" aria-label="{{ __(config('mediable.buttons.download.label')) }}">
              {!! config('mediable.buttons.download.value') ?? __(config('mediable.buttons.download.label')) !!}
            </a>
          @endif

      </li>

  @endforeach

</ul>
