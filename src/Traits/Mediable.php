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
        static::saved(function ($model)
        {
            // Add some media
            if(request()->has('media_to_add'))
            {
                $model->addMedia(request()->media_to_add);
            }

            // Delete some medias
            if(request()->has('media_to_delete'))
            {
                $model->deleteMedia(request()->media_to_delete);
            }
        });
    }

    /**
     * Get the model record associated with the media.
     * @return Illuminate\Database\Eloquent\Collection
     */
     public function media()
     {
          return $this->morphMany(Media::class, 'mediable');
     }

     /**
      * Check if the model has some media
      * @return boolean
      */
     public function hasMedia()
     {
       return $this->media()->exists();
     }

     /**
      * Add multiple media to a model (Save in DB and upload)
      * @param array $media_to_add
      * @return void
      */
     public function addMedia($media_to_add)
     {
          foreach ($media_to_add as $key => $media)
          {
              // If no file, don't do anything
              if(empty($media['file'])) { continue; }

              // Create a new Media
              $new = new Media;

              // Fill the information
              $new->fill([
                'name'        => 'file',
                'mime'        => $media['file']->getMimeType(),
                'extension'   => $media['file']->extension(),
                'type'        => $media['type']
              ]);

              // Save in DB
              $this->media()->save($new);

              // Upload the file
              $upload = $media->upload($media['file']);
          }
     }

     /**
      * Delete multiple media to a model (Remove from storage and delete from DB)
      * @param  array $media_to_delete 
      * @return void
      */
     public function deleteMedia($media_to_delete)
     {
         foreach($media_to_delete as $media)
         {
             // Remove all file in Storage and in DB foreach media
             $this->media->find($media)->remove()->delete();
         }
     }

}
