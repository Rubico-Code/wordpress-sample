#  Wordpress Functions

This file contains samples of wordpress custom and action/filters functions used in various applications showing conding standard and code usage.

## Disclaimer
Code fragments may not be complete, this is done to prevent sensitive/security related information to be leaked.

### Sample 1

How to localize variable to a script

```php
    wp_enqueue_script('custom_js', get_stylesheet_directory_uri() . '/js/custom.js');
        wp_localize_script('custom_js', '_searchConfigs', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        ));

```


### Sample 2
Hide dashboard for non admin users

```php
    add_action('admin_init', 'no_mo_dashboard');
    function no_mo_dashboard() {
        if (!current_user_can('administrator') && !wp_doing_ajax()) {
            wp_redirect(home_url()); exit;
        }
    }

```


### Sample 3

Hide admin bar for non admin

```php
    add_action('after_setup_theme', 'remove_admin_bar');
    
    function remove_admin_bar() {
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
    }
```


### Sample 4

This function generate the register page link for non login user

```php
    /**
     * this function generate the register page link for non login user
     * @param string $before
     * @param string $after
     * @param bool $echo
     * @return mixed|string|void
     */
    function theme_name_register($before = '', $after = '', $echo = true)
    {
        if (!is_user_logged_in()) {
            if (get_option('users_can_register')) {
                $link = $before . '<a class="btn-link" href="' . esc_url(get_permalink(get_page_by_path('register-user'))) . '">' . __('Register', 'text-domain') . '</a>' . $after;
            } else {
                $link = '';
            }
        } elseif (current_user_can('read')) {
            $link = $before . '<a class="btn-link" href="' . esc_url(get_permalink(get_page_by_path('edit-profile'))) . '">' . __('Profile','text-domain') . '</a>' . $after;
        } else {
            $link = '';
        }
    
        /**
         * Filters the HTML link to the Registration or Admin page.
         *
         * Users are sent to the admin page if logged-in, or the registration page
         * if enabled and logged-out.
         *
         * @since 1.5.0
         *
         * @param string $link The HTML code for the link to the Registration or Admin page.
         */
        $link = apply_filters('register-user', $link);
    
        if ($echo) {
            echo $link;
        } else {
            return $link;
        }
    }
```


### Sample 5

Register widget area

```php
    function theme_name_widgets_init()
    {
        register_sidebar(array(
            'name' => esc_html__('Sidebar', 'text-domain'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'text-domain'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
    }
```


### Sample 6

Adding defer attribute to the scripts

```php
    function theme_name_add_defer_attribute($tag, $handle)
    {
        // add script handles to the array below
        $scripts_to_defer = array('bootstrap-js', 'jquery', 'navigation', 'pagination-js', 'link-focus-fix', 'slick-js');
    
        foreach ($scripts_to_defer as $defer_script) {
            if ($defer_script === $handle) {
                return str_replace(' src', ' defer="defer" src', $tag);
            }
        }
        return $tag;
    }
    
    add_filter('script_loader_tag', 'theme_name_add_defer_attribute', 10, 2);

```