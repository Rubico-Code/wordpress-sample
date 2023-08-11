# WordPress tricks


### Conditionally load gtag.js
```php
add_action('wp_head', function () {
    if (get_option('blog_public') != 1) {
        echo "<!-- Google Tag Manager is disabled -->\n";
        return;
    }
    include get_template_directory() . '/inc/gtm-tracking-js.php';
}, 99);
```

### Make a script async
```php

add_filter('script_loader_tag', function ($tag, $handle, $src) {
    $scripts_to_async = array('google-map-api');

    if (!wp_script_is('google-map-api')) {
        array_push($scripts_to_async, 'frontend-js');
    }

    if (in_array($handle, $scripts_to_async)) {
        return str_replace(' src', ' async defer src', $tag);
    }

    return $tag;
}, 10, 3);

```

### Auto cache busting of css and js files
```
wp_enqueue_style('frontend-style', get_stylesheet_uri(), [], filemtime(get_template_directory() . '/style.css'));
```