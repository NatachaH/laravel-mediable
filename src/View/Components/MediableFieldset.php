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
     * Can you add/remove dynamically the inputs (nh/bs-component)
     * @var boolean
     */
    public $isDynamic;

    /**
     * Minimum nbr of inputs
     * @var int
     */
    public $min;

    /**
     * Maximum nbr of inputs
     * @var int
     */
    public $max;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($legend, $type, $current = [], $hasName = false, $isDynamic = false, $min = 1, $max = null)
    {
        $this->legend       = $legend;
        $this->type         = $type;
        $this->currentMedia = $current;
        $this->hasName      = $hasName;
        $this->isDynamic    = $isDynamic;
        $this->min          = $min;
        $this->max          = $max;
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
