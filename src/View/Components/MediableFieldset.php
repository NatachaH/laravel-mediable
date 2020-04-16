<?php

namespace Nh\Mediable\View\Components;

use Illuminate\View\Component;

class MediableFieldset extends Component
{

    /**
     * The legend of the fieldset
     * @var string
     */
    public $legend;

    /**
     * The type of the media in the fieldset
     * @var string
     */
    public $type;

    /**
     * Array of the current media
     * @var array
     */
    public $currentMedia;

    /**
     * Media with name input
     * @var boolean
     */
    public $hasName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($legend, $type, $current = [], $hasName = false)
    {
        $this->legend       = $legend;
        $this->type         = $type;
        $this->currentMedia = $current;
        $this->hasName      = $hasName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('mediable::fieldset');
    }
}
