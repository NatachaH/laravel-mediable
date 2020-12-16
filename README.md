# Installation

Install the package via composer:

```
composer require nh/mediable
```

Publish the database and the config for the media:

```
php artisan vendor:publish --tag=mediable
```

To make a model mediable, add the **Mediable** trait to your model:
*To retrieve the media of your model => $post->media*
*To check if of your model has any media => $post->hasMedia()*

```
use Nh\Mediable\Traits\Mediable;

use Mediable;
```

If you need to resize the picture media (JPEG/PNG), add the sizes in the config **mediable.php** at **'sizes'**:

```
'posts' => [
  'fit'    => null,
  'height' => [100,200],
  'width'  => 400,800
]
```

If you need to add a watermark you can activate the functionnality in the config **mediable.php**, add the sizes in the config **mediable.php** at **'sizes'**:

```
'watermark' => [
    'enable' => true, // Enable the watermark
    'src' => 'images/watermark.png', // Must be in public folder
    'position' => [
      'name' => 'bottom-right',
      'x' => 5,
      'y' => 5
     ]
],
```

By default the media are upload in the public disk, but you can change this in the config **mediable.php**.

The media are saved in:
- A folder with the model classname in plural *(exemple: App\Post => posts)*
- A folder with the media format name in plural *(exemple: 42.jpg => images)*
- For the images, a folder with the resize value *(exemple: 42.jpg which is resized with a 100px height => h-100)*




## Views

## Add a media

The names of the inputs must be: **media_to_add[KEY][name]** and **media_to_add[KEY][file]** and in option you can add **media_to_add[KEY][position]**

```
<label>Name of the media</label>
<input type="text" name="media_to_add[0][name]" />

<label>File to upload</label>
<input type="file" name="media_to_add[0][file]" />
```

## Edit a media

The name of the input must be: **media_to_update[KEY][name]** and in option you can add **media_to_update[KEY][position]**

```
<label>Name of the media</label>
<input type="text" name="media_to_edit[0][name]" />
```

## Delete a media

The name of the input must be: **media_to_delete[]** and the value must be the ID

```
<input type="checkbox" name="media_to_delete[]" value="1"/>
```

# Model

## Attributes

You can retrieve the filename of a media
*Return: 42.jpg*

```
$media->filename
```

You can retrieve the base folder of a media
*Return: posts*

```
$media->base_folder
```

You can retrieve the folder of a media
*Return: posts/images*

```
$media->folder
```

You can retrieve the format of a media
*The format is defined by the extension, exemple a .jpg will return 'image'*

```
$media->format
```

You can retrieve the default url of a media
*Return: posts/images/42.jpg*

```
$media->url
```

You can retrieve the url of a the thumbnail of a media **(Only if the format is 'image')**
*Return: posts/images/thumbnails/42.jpg*

```
$media->thumbnail
```

## Function

You can retrieve the url of a media, and you can add a subfolder.
*Exemple: 42.jpg which is resized with a 100px height => 'posts/images/h-100/42.jpg'*

```
$media->getUrl('h-100')
```

You can retrieve the absolute url of a media from the server, and you can add a subfolder.
*Exemple: 42.jpg which is resized with a 100px height => '/Users/YOURUSERNAME/Web/MYPROJECT/public/storage/FOLDER/images/SUBFOLDER/42.png'*

```
$media->getAbsoluteUrl('h-100')
```

You can retrieve the file of a media, and you can add a subfolder.
*Exemple: 42.jpg which is resized with a 100px height => 'posts/images/h-100/42.jpg'*

```
$media->getFile('h-100')
```

# Events

You can use the **MediaEvent** for dispatch events that happen to the media.
*This will return an event with the $event->name as my-event, $event->relation as media and $event->model as an instance of Nh/Models/Media*

```
MediaEvent::dispatch('my-event', $model);
```
