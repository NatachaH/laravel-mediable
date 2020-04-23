<?php

namespace Nh\StarterPack\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class MediaListing extends Component
{
    /**
     * The media list.
     *
     * @var Illuminate\Database\Eloquent\Collection
     */
    public $items;

    /**
     * Display the creation date.
     *
     * @var boolean
     */
    public $showDate;

    /**
     * Enable the download button.
     *
     * @var boolean
     */
    public $hasDownload;

    /**
     * Enable the sortable.
     *
     * @var boolean
     */
    public $sortable;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($items, $showDates = false, $hasDownload = true, $sortable = false)
    {
        $this->items        = $items;
        $this->showDate     = $showDates;
        $this->hasDownload  = $hasDownload;
        $this->sortable     = $sortable;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('mediable::components.media-listing');
    }
}
