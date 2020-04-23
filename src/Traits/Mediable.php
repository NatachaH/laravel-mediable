<?php
namespace Nh\Mediable\Traits;

use App;
use Illuminate\Database\Eloquent\Builder;

use Nh\Mediable\Media;

trait Mediable
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    protected static function bootMediable()
    {
        // After an item is saved
        static::saved(function ($model)
        {
            // Add some media
            if(request()->has('media_to_add'))
            {
                $model->addMedia(request()->media_to_add);
            }

            // Update some media
            if(request()->has('media_to_update'))
            {
                $model->updateMedia(request()->media_to_update);
            }

            // Delete some medias
            if(request()->has('media_to_delete'))
            {
                $model->deleteMedia(request()->media_to_delete,true);
            }
        });

        // Before an item is deleted
        static::deleting(function ($model)
        {
            if($model->hasMedia(true))
            {
                $media_to_delete = $model->media()->withTrashed()->get()->modelKeys();
                $hasSoftDelete = in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($model));
                $isForceDelete = !$hasSoftDelete || $model->isForceDeleting();
                $model->deleteMedia($media_to_delete,$isForceDelete);
            }
        });

        if(method_exists(static::class,'restoring'))
        {
            // Before an item is restored, restore the media
            static::restoring(function ($model)
            {
                if($model->hasMedia(true))
                {
                    $model->media()->withTrashed()->restore();
                }
            });
        }
    }

    /**
     * Get the model record associated with the media.
     * Order them by position (nh/sortable)
     * @return Illuminate\Database\Eloquent\Collection
     */
     public function media()
     {
          return $this->morphMany(Media::class, 'mediable')->byPosition();
     }

     /**
      * Check if the model has some media.
      * @param boolean $withTrashed
      * @return boolean
      */
     public function hasMedia($withTrashed = false)
     {
       return $withTrashed ? $this->media()->withTrashed()->exists() : $this->media()->exists();
     }

     /**
      * Add multiple media to a model (Save in DB and upload).
      * @param array $media_to_add
      * @return void
      */
     private function addMedia($media_to_add)
     {
          foreach ($media_to_add as $key => $media)
          {
              // If no file, don't do anything
              if(empty($media['file'])) { continue; }

              // Get the file
              $file = $media['file'];

              // Create a new Media
              $new = new Media;

              // Fill the information
              $new->fill([
                'name'        => $media['name'] ?? NULL,
                'mime'        => $file->getClientMimeType(),
                'extension'   => $file->getClientOriginalExtension(),
                'type'        => $media['type']
              ]);

              // Save in DB
              $this->media()->save($new);

              // Upload the file
              $upload = $new->upload($file);

              // Resize the media
              $this->resizeMediaByConfig($new);
          }
     }

     /**
      * Resize a media by config
      * @param  Nh\Mediable\Media $media
      * @return void
      */
     private function resizeMediaByConfig($media)
     {
         // If not an image stop
         if($media->format != 'image') { return; }

        // Get the mediable config sizes
        $config = config('mediable.sizes');

        // Create the thumbnail
        $media->resize($config['thumbnails'],'fit','thumbnails');

        if(!isset($config[$media->base_folder])) { return; }

        // Resize by size (fit)
        $sizes = (array)$config[$media->base_folder]['fit'];
        if(!empty($sizes))
        {
            foreach ($sizes as $size)
            {
                $media->resize($size);
            }
        }

        // Resize by height
        $heights = (array)$config[$media->base_folder]['height'];
        if(!empty($heights))
        {
            foreach ($heights as $height)
            {
                $media->resize($height,'height');
            }
        }

        // Resize by width
        $widths = (array)$config[$media->base_folder]['width'];
        if(!empty($widths))
        {
            foreach ($widths as $width)
            {
                $media->resize($width,'width');
            }
        }
     }

     /**
      * Update multiple media to a model (Only in DB)
      * @param  array $media_to_update
      * @return void
      */
     private function updateMedia($media_to_update)
     {
         foreach($media_to_update as $key => $media)
         {
             // Get the media and update the name
             $this->media->find($key)->update(['name' => $media['name'] ?? NULL]);
         }
     }

     /**
      * Delete multiple media to a model (Remove from storage and delete from DB).
      * @param  array $media_to_delete
      * @param  boolean $forceDelete
      * @return void
      */
     private function deleteMedia($media_to_delete,$forceDelete = false)
     {
         foreach($media_to_delete as $id)
         {
            // Find the Media (even if in trash)
            $media = $this->media()->withTrashed()->find($id);

            if($forceDelete)
            {
                // Remove all file in Storage
                $media->remove();
                // Force delete from the DB
                $media->forceDelete();
            } else {
                // Soft delete from the DB
                $media->delete();
            }
         }
     }

}
