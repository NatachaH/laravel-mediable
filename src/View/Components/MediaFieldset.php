<?php

namespace Nh\AccessControl\View\Components;

use Illuminate\View\Component;

class PermissionFieldset extends Component
{

    /**
     * The legend of the fieldset
     * @var string
     */
    public $legend;

    /**
     * Array of the checked options
     * @var string
     */
    private $optionsChecked;

    /**
     * Check if the option is checked
     * @param  string  $option
     * @return boolean
     */
    public function isOptionChecked($option)
    {
        $currentValues = old('permissions',$this->optionsChecked);
        return in_array($option, $currentValues);
    }

    /**
     * The path for the $key translation
     * @var string
     */
    public $translation;

    /**
     * Are all the checkboxes disabled.
     *
     * @var boolean
     */
    public $isDisabled;

    /**
     * The options who are disabled in the list.
     *
     * @var array
     */
    private $optionsDisabled;

    /**
     * Check if the option is disabled
     * @param  string  $option
     * @return boolean
     */
    public function isOptionDisabled($option)
    {
        return in_array($option, $this->optionsDisabled);
    }

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($legend, $checked = [], $translation = 'permission', $disabled = false)
    {
        $this->legend           = $legend;
        $this->optionsChecked   = (array)$checked;
        $this->translation      = $translation;
        $this->isDisabled       = is_bool($disabled) ? $disabled : false;
        $this->optionsDisabled  = is_array($disabled) ? $disabled : [];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('ac::permissions.fieldset');
    }
}
