# Gridbuilder ᵂᴾ - Custom Facets

> Require this plugin [Gridbuilder ᵂᴾ](https://www.wpgridbuilder.com) for this custom facet plugin. This is a custom plugin which extend the facet functionality. 

It allows to add your own facets with your own logic. Creating custom facets requires advanced knowledge in PHP and SQL languages.

- [Installation](#installation)
- [Facets](#facets)

## Installation

Clone this repo to your plugins folder Download the plugin and put it in either the `plugins` or `mu-plugins` directory. Visit the WordPress dashboard and activate the plugin. Please note that this package supports Gridbuilder ᵂᴾ version 1.4 or higher.

## Custom Facets
* Price Range Selection
* Single Toggle Switch (On/Off)
* Two Toggle Switch (True and False)


###  Registering facets

```php
add_filter( 'wp_grid_builder/facets', 'prefix_register_facet', 10, 1 );
```

### Get facet by slug

You have now the possibility to get facet by slug

```php
wpgb_render_facet([
  'slug' => 'pagination',
  'grid' => 'post-list'
])
```

### Improved facet rendering

Facets have the slug class make you more powerful styling !

Note : by default, class are only added when `wpgb_render_facet` is called by slug. If you want to enable it when a facet is called by ID, you need to enable it with this filter :

```php
add_filter('wpgb_extended/enable_facet_class_from_db', '__return_true');
```

