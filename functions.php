<?php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
if (function_exists('add_theme_support')) {
  add_theme_support('post-thumbnails');
}
add_theme_support( 'menus' );
function my_function_admin_bar(){ return false; }
add_filter( 'show_admin_bar' , 'my_function_admin_bar');
// Load the Theme CSS
function theme_styles() {


	wp_enqueue_style( 'ie', get_template_directory_uri() . '/css/ie.css' );
	wp_enqueue_style( 'fonts', 'http://fonts.googleapis.com/css?family=Roboto+Condensed:400italic,700italic,400,300,700');
	wp_enqueue_style( 'main', get_template_directory_uri() . '/style.css' );



}

function theme_js() {

	wp_register_script( 'responsivenav', get_template_directory_uri() . '/js/responsive-nav.js', array('jquery'), null, false );
	wp_register_script( 'mainscript', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true );
	wp_enqueue_script( 'responsivenav', get_template_directory_uri() . '/js/responsive-nav.js', array('jquery'), null, false );

	wp_enqueue_script( 'mainscript');

	
	

}
add_action( 'wp_enqueue_scripts', 'theme_js' );

@ini_set( 'mysql.trace_mode', 0 );
add_action( 'wp_enqueue_scripts', 'theme_styles' );
// Enable custom menus

function get_url_contents($url){
    $crl = curl_init();
    $timeout = 5;
    curl_setopt ($crl, CURLOPT_URL,$url);
    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

function post_url_contents($url, $fields) {

    foreach($fields as $key=>$value) { $fields_string .= $key.'='.urlencode($value).'&'; }
    rtrim($fields_string, '&');

    $crl = curl_init();
    $timeout = 5;

    curl_setopt($crl, CURLOPT_URL,$url);
    curl_setopt($crl,CURLOPT_POST, count($fields));
    curl_setopt($crl,CURLOPT_POSTFIELDS, $fields_string);

    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}
?>