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

By default the media are upload in the public disk, but you can change this in the config **mediable.php**.

The media are saved in:
- A folder with the model classname in plural *(exemple: App\Post => posts)*
- A folder with the media format name in plural *(exemple: 42.jpg => images)*
- For the images, a folder with the resize value *(exemple: 42.jpg which is resized with a 100px height => h-100)*

# Components view

The package come with some view components:

- MediaFieldset : to add, edit and delete some media in a form.
- MediaListing : to display the list of the media of a model.

For use these components you need to add some JS and SCSS files:

## Javascript & SCSS

Add in your package.json the libraries:

```
"bs-custom-file-input" : "^1.3.4",
"sortablejs" : "^1.10.2"
```

Then in you JS file add:

```
window.bsCustomFileInput = require('bs-custom-file-input');
require('../../vendor/nh/bs-component/resources/js/dynamic');
require('../../vendor/nh/sortable/resources/js/sortable');
require('../../vendor/nh/mediable/resources/js/mediable');
```

And in you SCSS file add:

```
@import '../../vendor/nh/mediable/resources/sass/mediable';
```

## Config

You can change the classes and the value of all the buttons in the config file **mediable.php**.
The values can be plain text or some HTML.

## Views

In your form, add the MediaFieldset component:

```
<x-mediable-fieldset legend="Medias" type="pictures" :current="$post->media" min="1" max="3" formats="JPEG" has-name is-multiple has-download sortable/>
```

In your view, add the MediaListing component:
*To init the list as sortable, check the package nh/sortable*

```
<x-mediable-listing :items="$post->media" show-dates has-download sortable/>
```

# Manually add, edit and delete

If you don't want to use the view components, you can add some inputs in your form:

## Add a media

*The names of the inputs must be: media_to_add[KEY][name] and media_to_add[KEY][file] and in option you can add media_to_add[KEY][position]*

```
<label>Name of the media</label>
<input type="text" name="media_to_add[0][name]" />

<label>File to upload</label>
<input type="file" name="media_to_add[0][file]" />
```

## Edit a media

*The name of the input must be: media_to_update[KEY][name] and in option you can add media_to_update[KEY][position]*

```
<label>Name of the media</label>
<input type="text" name="media_to_edit[0][name]" />
```

## Delete a media

*The name of the input must be: media_to_delete[] and the value must be the ID*

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

You can retrieve the file of a media, and you can add a subfolder.
*Exemple: 42.jpg which is resized with a 100px height => 'posts/images/h-100/42.jpg'*

```
$media->getFile('h-100')
```
