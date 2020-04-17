<?php

namespace Nh\Mediable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class Media extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mime', 'extension', 'type'
    ];

    /**
     * Get the filename.
     *
     * @return string
     */
    public function getFilenameAttribute()
    {
        return $this->id.'.'.$this->extension;
    }

    /**
     * Get the base folder.
     * Exemple: App/Post => posts
     *
     * @return string
     */
    public function getBaseFolderAttribute()
    {
        $model = class_basename($this->mediable_type);
        return Str::lower(Str::plural($model));
    }

    /**
     * Get the folder.
     * Exemple: posts/images
     *
     * @return string
     */
    public function getFolderAttribute()
    {
        return $this->base_folder.'/'.Str::plural($this->format);
    }

    /**
     * Get the media format by mime type.
     *
     * @return string
     */
    public function getFormatAttribute()
    {
        switch ($this->mime) {

          // Image
          case 'image/jpeg':
          case 'image/png':
            return 'image';
            break;

          // Vector
          case 'image/svg+xml':
            return 'vector';

          // PDF
          case 'application/pdf':
            return 'pdf';
            break;

          // Word
          case 'application/msword':
          case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
            return 'word';
            break;

          // Excel
          case 'application/vnd.ms-excel':
          case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
          case 'text/csv':
            return 'excel';
            break;

          // Audio
          case 'audio/mpeg':
            return 'audio';
            break;

          // Video
          case 'video/mpeg':
          case 'video/mp4':
            return 'video';
            break;

          // Unknown
          default:
            return 'unknown';
            break;
        }

    }

    /**
     * Get url of a media.
     * @param  string $subfolder
     * @return string
     */
    public function getUrl($subfolder = null)
    {
        $subfolder = is_null($subfolder) ? '/' : '/'.$subfolder.'/';
        return Storage::disk(config('mediable.disk'))->url($this->folder.$subfolder.$this->filename);
    }

    /**
     * Get file of a media.
     * @param  string $subfolder
     * @return string
     */
    public function getFile($subfolder = null)
    {
        $subfolder = is_null($subfolder) ? '/' : '/'.$subfolder.'/';
        return Storage::disk(config('mediable.disk'))->get($this->folder.$subfolder.$this->filename);
    }

    /**
     * Get the thumbnail url of a media.
     *
     * @return string
     */
    public function getThumbnailAttribute()
    {
        return $this->format == 'image' ? $this->getUrl('thumbnails') : '';
    }

    /**
     * Get the url of a media.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return $this->getUrl($subfolder);
    }

    /**
     * Upload a media in the storage.
     * @param  Illuminate\Http\UploadedFile $file
     * @param  string $folder
     * @return Response
     */
    public function upload($file)
    {
        // Create the folder if needed
        Storage::disk(config('mediable.disk'))->makeDirectory($this->folder);

        // Store the file
        return Storage::disk(config('mediable.disk'))->putFileAs($this->folder, $file, $this->filename);
    }

    /**
     * Remove a media from Storage.
     *
     * @return void
     */
    public function remove()
    {
        // Delete file at the root: foos/images/1.jpg
        Storage::disk(config('mediable.disk'))->delete($this->folder.'/'.$this->filename);

        // Get all subfolder and delete the file in each of them : foos/images/thumbnails/myfile_1.jpg
        foreach (Storage::disk(config('mediable.disk'))->allDirectories($this->folder) as $directory)
        {
           Storage::disk(config('mediable.disk'))->delete($directory.'/'.$this->filename);
        }
    }

    /**
     * Resize an image.
     * @param  int $size        The new size of the media
     * @param  string $method   The method to use for the resize
     * @param  string $folder   The custom folder where to save it
     * @return void
     */
    public function resize($size, $method = 'fit', $folder = null)
    {
        // If not an image stop
        if($this->format != 'image') { return; }

        // Make a new image from original
        $file = Image::make($this->getFile());

        // Resize by method
        switch ($method)
        {
            case 'height':
                $prefix = 'h-';
                $file->resize(null, $size, function ($constraint) {
                    $constraint->aspectRatio();
                });
                break;
            case 'width':
                $prefix = 'w-';
                $file->resize($size, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                break;
            default:
                $prefix = 'f-';
                $file->fit($size);
                break;
        }

        // Save the new file in the an other folder
        $subfolder = is_null($folder) ? $prefix.$size : $folder;
        $newFolder = $this->folder.'/'.$subfolder;
        Storage::disk(config('mediable.disk'))->makeDirectory($newFolder);
        $file->save(storage_path('app/public/'.$newFolder).'/'.$this->filename);

    }



}
