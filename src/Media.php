<?php

namespace Nh\Mediable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
     * Get the folder.
     *
     * @return string
     */
    public function getFolderAttribute()
    {
        $model = class_basename($this->mediable_type);
        return Str::lower((Str::plural($model));
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
          case 'video/mp4'
            return 'video';
            break;

          // Unknown
          default:
            return 'unknown';
            break;
        }

    }

    /**
     * Upload a media in the storage
     * @param  Illuminate\Http\UploadedFile $file
     * @param  string $folder
     * @return Response
     */
    public function upload($file)
    {
        // Define the folder
        $folder = $this->folder.'/'.(Str::plural($this->format);

        // Create the folder if needed
        Storage::makeDirectory($folder);

        // Store the file
        Storage::putFileAs($folder, $file, $this->id);

        // Return the path
        return $path;
    }

    /**
     * Remove a media from Storage
     * @return void
     */
    public function remove()
    {
        $folder = $this->folder.'/'.(Str::plural($this->format);
        $filename = $this->filename;

        // Delete file at the root: foos/images/1.jpg
        Storage::delete($folder.'/'.$filename);

        // Get all subfolder and delete the file in each of them : foos/images/thumbnails/myfile_1.jpg
        foreach (Storage::allDirectories($folder) as $directory)
        {
           Storage::delete($directory.'/'.$filename);
        }
    }

}
