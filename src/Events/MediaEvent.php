<?php

namespace Nh\Mediable\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Media;

class MediaEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Name of the event
     * @var string
     */
    public $name;

    /**
     * The model parent of the media
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;

    /**
     * The media model
     * @var \App\Models\Media
     */
    public $relation;

    /**
     * The number of media model affected
     * @var int
     */
    public $number;

    /**
     * Create a new event instance.
     * @param string  $name
     * @param \Illuminate\Database\Eloquent\Model  $model
     * @param \App\Models\Media  $relation
     * @param int  $number
     */
    public function __construct($name,$model,$relation = null,$number = null)
    {
          $this->name     = $name;
          $this->model    = $model;
          $this->relation = is_null($relation) ? new Media : $relation;
          $this->number   = $number;
    }
}
