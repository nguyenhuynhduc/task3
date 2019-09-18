<?php

/*
Plugin Name: My footer Setting
Plugin URI:
Description: Add post types footer
Version: 1.0.0
Author: DUC NGUYEN
Author URI: http://localhost:8080/task2/
 */

defined('ABSPATH') or die("HEY, WHAT DO YOU DOING?, you silly human!");
class MyFooter
{
    public function  __construct()
    {
        add_action('admin_menu',array($this,'settingMenu'));
        add_action( 'wp_footer', array($this,'selectOption') );
    }
    public function selectOption()
    {
        global $wpdb;
        $table_name= $wpdb->prefix ."options";
        $footer=$wpdb->get_var( "SELECT option_value FROM $table_name WHERE option_name ='footer_option'" );
        echo $footer;
    }

    public function settingMenu()
    {
        add_menu_page('My Menu Title',
            'My Menu',
            'manage_options',
            'mymenupage',
            array($this,'exampleMenu'),
            '',
            6
        );
    }
    function exampleMenu()
    {
        require_once 'pageSetting.php';
    }
    function active_plugin()
    {
        $optionVersion="my Footer Create";
        add_option("footer_option",$optionVersion,"","yes");
        global $wpdb;
        $table_name= $wpdb->prefix ."options";
        $wpdb->update(
            $table_name,
            array('autoload'=>'yes'),
            array('option_name'=>'footer_option')
        );
    }
    function deactive(){
        global $wpdb;
        $table_name= $wpdb->prefix ."options";
        $wpdb->update(
            $table_name,
            array('autoload'=>'no'),
            array('option_name'=>'footer_option')
        );
    }
}





if (class_exists('MyFooter'))
{
    $footerPlugin = new MyFooter();
}

register_activation_hook(__FILE__,array($footerPlugin,'active_plugin'));

register_deactivation_hook(__FILE__,array($footerPlugin,'deactive'));


