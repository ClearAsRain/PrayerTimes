<?php
/*
Plugin Name: PrayerTimes
Description: نمایش  اوقات شرعی در سایت وردپرسی
Author: Seyed Alireza Seyedzade
Version: 1.0.0
Author URI: https://creatiweb.ir/
*/
defined("ABSPATH") or die('access denied');
define("OGHAT_PLUGIN_DIR", dirname(__FILE__));
function myplugin_load_textdomain() {
    load_plugin_textdomain( 'LazyCoalaCodes', false, dirname( plugin_basename( __FILE__ ) ) . '/libs/admin-page-framework/languages/' );
}
add_action( 'plugins_loaded', 'myplugin_load_textdomain' );
require_once(OGHAT_PLUGIN_DIR . '/functions.php');
require_once(OGHAT_PLUGIN_DIR . '/ajax.php');
require_once(OGHAT_PLUGIN_DIR . '/user/today.php');
require_once(OGHAT_PLUGIN_DIR . '/user/month.php');
require_once(OGHAT_PLUGIN_DIR . '/admin/admin-menu.php');