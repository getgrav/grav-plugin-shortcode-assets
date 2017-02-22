# Grav Shortcode Assets Plugin


`shortcode-assets` is a [Grav](http://github.com/getgrav/grav) plugin that provides a convenient way to add CSS and JS assets directly from your pages.

# Installation

Installing the Shortcode Assets plugin can be done in one of two ways. Our GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file. 

## GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's Terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install shortcode-assets

This will install the Shortcode Assets plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/shortcode-assets`.

# Config Defaults

```
enabled: true
```

If you need to change any value, then the best process is to copy the [shortcode-assets.yaml](shortcode-assets.yaml) file into your `users/config/plugins/` folder (create it if it doesn't exist), and then modify there.  This will override the default settings.

# Usage

Once the plugin is installed you can use the following syntax in your page content to add various asset types [`css`, `inlineCss`, `js`, `inlineJs`]:

```
[assets=css]
custom-style.css
/blog/some-blog/post/style.css
//cdnjs.cloudflare.com/ajax/libs/1140/2.0/1140.css
http://somesite.com/js/cookies.min.css
[/assets]

[assets=js]
custom-script.js
/blog/some-blog/post/script.js
//cdnjs.cloudflare.com/ajax/libs/1140/2.0/1140.min.js
http://somesite.com/js/cookies.min.js
[/assets]

[assets=inlineCss]
h1 {color: red !important;}
[/assets]

[assets=inlineJs]
  function initialize() {
    var mapCanvas = document.getElementById('map_canvas');
    var mapOptions = {
      center: new google.maps.LatLng(44.5403, -78.5463),
      zoom: 8,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(mapCanvas, mapOptions);
  }
[/assets]
```

## Advanced

The Shortcode Assets plugin supports all the available options That the [Grav Asset Manager supports](https://learn.getgrav.org/themes/asset-manager#options).  You can specify `priority`, `pipeline` and `media` for **CSS files**, and `priority`, `pipeline`, `loading`, and `group` for **JS files**.  

For example:

```
[assets=css priority=100 pipeline=false]custom-style.css[/assets]

[assets=js loading="async defer" group="bottom"]custom-script.js[/assets]
```

> Note: Any changes you have made to any of the files listed under this directory will also be removed and replaced by the new set. Any files located elsewhere (for example a YAML settings file placed in `user/config/plugins`) will remain intact.
