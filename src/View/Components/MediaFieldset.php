<?php

namespace Nh\AccessControl\View\Components;

use Illuminate\View\Component;

class MediaFieldset extends Component
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
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($legend, $type)
    {
        $this->legend = $legend;
        $this->type   = $type;
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
