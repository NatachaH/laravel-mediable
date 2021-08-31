<?php

namespace Nh\Mediable\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Nh\Mediable\Models\Media;

class MediaEvent
{
    use Dispatchable, SerializesModels;

    public $name;
    public $model;
    public $relation;
    public $comment;

    /**
     * Create a new event instance.
     * @param string  $name
     * @param \Illuminate\Database\Eloquent\Model  $model
     */
    public function __construct($name,$model,$relation = null,$comment = null)
    {
          $this->name     = $name;
          $this->model    = $model;
          $this->relation = is_null($relation) ? new Media : $relation;
          $this->comment  = $comment;
    }
}
