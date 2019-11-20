<?php
/*
* Plugin Name: NT Brand - WP admin modifications
* Plugin URI: http://webstudionovetrendy.eu/
* Description: Create Wordpress installation branded to webstudionovetrendy.eu
* Version: 1612111
* Text Domain: nt-brand
* Domain Path: /languages/
* WP tested up to: 4.7
* Author: Webstudio New Trends
* Author URI: http://webstudionovetrendy.eu/
* License: GPL2
* GitHub Plugin URI: https://github.com/novetrendy/NTBrand
*/
/** Localization */
 add_action('plugins_loaded', 'nt_brand_plugin_localization_init');
    function nt_brand_plugin_localization_init()  {
        load_plugin_textdomain( 'nt-brand', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
        }

add_action( 'wp_enqueue_scripts', 'nt_scripts' );
function nt_scripts() {
wp_enqueue_style( 'nt-css', get_template_directory_uri() . '/lib/css/style.css' );
}
/** NT dashboard widget */
add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');
    function add_custom_dashboard_widget() {
        wp_add_dashboard_widget('nt_dashboard_widget', __('Webstudio New Trends','nt-brand'), 'nt_dashboard_widget');
                                            }
    function nt_dashboard_widget() {
        echo '<center><img src="'. plugin_dir_url( __FILE__ ) .'/admin/images/web-studionovetrendy.png" /></center><h3 class="text-center">'. __('Dear client, if you have any question please call','nt-brand') . '</h3><h2 class="text-center">'. __("(+420) 736 635 842", "nt-brand") .'</h2><h3 class="text-center">' . __('or send an email to oveckovaalena@novetrendy.eu','nt-brand') .'</h3>';
                                        }
/** customization admin area - admin.css must be in root web folder */
add_action('admin_head', 'registerNTAdminCss');
    function registerNTAdminCss(){
        $src = get_stylesheet_directory_uri() . '/admin.css';
        wp_register_script('NTAdminCss', $src);
        wp_enqueue_style('NTAdminCss', $src, array(), false, false);
                                }
/** custom function (add text)for wp footer in admin area */
add_filter('admin_footer_text', 'nt_left_admin_footer_text_output'); //left side
    function nt_left_admin_footer_text_output($left_text)   {
        $left_text = __('If you have any question please call (+420)<strong> 736 635 842</strong>, or send an email to oveckovaalena@novetrendy.eu','nt-brand');
        return $left_text;
                                                    }
add_filter('update_footer', 'nt_right_admin_footer_text_output', 11); //right side
    function nt_right_admin_footer_text_output($right_text)  {
        $frontpage_id = (int)get_option( 'page_on_front' );
        $installdate = get_the_date(get_option('date_format'), $frontpage_id);
        $right_text = __('Created by','nt-brand') . ' <a href="https://webstudionovetrendy.eu" target="_blank">' . __('Webstudio New Trends','nt-brand') . '</a> '.$installdate;
        return $right_text;
                                                    }
/** CUSTOM ADMIN LOGIN HEADER LOGO */
add_action('login_head',  'nt_custom_login_logo');
    function nt_custom_login_logo()     {
        echo '<style  type="text/css"> h1 a {background-image:url(' . get_stylesheet_directory_uri() . '/logo_admin.png)!important;background-size:476px 70px!important;width:476px!important;height:70px!important;position: relative;left: -80px;}</style>';
                                        }
/** CUSTOM ADMIN LOGIN LOGO LINK */
add_filter( 'login_headerurl', 'nt_login_logo_url' );
    function nt_login_logo_url()    {
        $nturl = 'https://webstudionovetrendy.eu';
        return $nturl;
                                    }
/** CUSTOM ADMIN LOGIN LOGO LINK */
add_filter( 'login_headertext', 'nt_login_logo_url_title' );
    function nt_login_logo_url_title()  {
    return __('Webstudio New Trends', 'nt-brand');
                                        }
/** CUSTOM ADMIN LOGIN MESSAGE */
add_filter('login_message', 'nt_custom_login_message');
    function nt_custom_login_message() {
    $message_style='text-align:center;line-height:1.2em;background-color:rgba(255,255,255,1);padding:10px;-webkit-border-top-right-radius:5px;-webkit-border-bottom-right-radius:5px;-moz-border-radius-topright:5px;-moz-border-radius-bottomright:5px;border-top-right-radius:5px;border-bottom-right-radius:5px;border:1px solid #ebebeb;border-left:5px solid #BCEE00;-webkit-box-shadow:5px 5px 5px 0px rgba(0,0,0,0.36);-moz-box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.36);box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.36);font-size:18px;';
    $message = '<div style="'. $message_style. '">'. __('If you have any question please call','nt-brand').'<br />'.__('(+420)','nt-brand').'<strong>&nbsp;' .__('736 635 842','nt-brand') .'</strong><br />'.__('or send an email to','nt-brand').'<br />'.__('oveckovaalena@novetrendy.eu','nt-brand') .'</a></div>';
    return $message;
                                        }
