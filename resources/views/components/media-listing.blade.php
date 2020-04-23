<ul {{ $attributes->merge(['class' => 'list-group '.($sortable ? 'media-sortable' : '')]) }} @if($sortable) data-sortable-model="Nh\Mediable\Media" @endif>

  @foreach ($items as $item)

      <li class="list-group-item d-flex align-items-center" data-id="{{ $item->id }}">

          @if($sortable)
            <button class="btn drag {{ config('mediable.buttons.drag.class') }}" aria-label="@lang('mediable::media.move')">
              {!! config('mediable.buttons.drag.value') !!}
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
            <a href="{{ $item->url }}" class="btn {{ config('mediable.buttons.download.class') }}" download target="_blank" aria-label="@lang('mediable::media.action.download')">
              {!! config('mediable.buttons.download.value') !!}
            </a>
          @endif

      </li>

  @endforeach

</ul>
