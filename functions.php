<?php
function load_prayer_user_assets()
{
    wp_enqueue_style('prayer-user-style',plugins_url( 'assets/css/style.css', __FILE__ ) );
    wp_enqueue_script( 'prayer-user-script', plugins_url( 'assets/js/user.js', __FILE__ ),array('jquery'),false,true );
    wp_localize_script( 'prayer-user-script', 'ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
}
add_action('wp_enqueue_scripts','load_prayer_user_assets');
function load_prayer_admin_assets() {
    wp_enqueue_style( 'prayer-admin-style', plugins_url( 'assets/css/admin.css', __FILE__ ) );
    wp_enqueue_style( 'sweetalert-style', plugins_url( 'assets/css/sweetalert2.min.css', __FILE__ ) );
    wp_enqueue_script( 'sweetalert-script', plugins_url( 'assets/js/sweetalert2.min.js', __FILE__ ),array('jquery'),false,true );
    wp_enqueue_script( 'prayer-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ),array('jquery'),false,true );
}
add_action( 'admin_enqueue_scripts', 'load_prayer_admin_assets' , 100);
function format_am_pm($el) { 
    return str_replace(array('%am%', '%pm%'), array('AM', 'PM'), $el);
}
function timeToSeconds ($time) {
    $hours = floor($time);
    $minutes = ($time - $hours) * 100;
    $seconds = ($hours * 3600) +  ($minutes * 60);
    return $seconds;
}
function secondsToTime ($seconds) {
    $hours = floor($seconds / 3600);
    $minutes = ($seconds - ($hours * 3600)) / 60;
    $time = "" . $hours . "." . $minutes;
    return $time;
}