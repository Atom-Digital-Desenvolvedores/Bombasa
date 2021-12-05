<?php
include_once ("libraries/sweetalert2/include.php");
include_once ("libraries/grid/include.php");
include_once ("libraries/mask/include.php");

include_once ("login/login.php");
include_once ("others/settings.php");
include_once ("others/access.php");
include_once ("others/css-default.php");

/*
$user_id = username_exists( "author" );
if ( !$user_id && email_exists("author@teste.com.br") == false ) {
    $user_id = wp_create_user( "author", "admin123", "author@teste.com.br" );
    $user_id = wp_update_user( array( 'ID' => $user_id, 'role' => 'author' ) );
}
$user_id = username_exists( "editor" );
if ( !$user_id && email_exists("editor@teste.com.br") == false ) {
    $user_id = wp_create_user( "editor", "admin123", "editor@teste.com.br" );
    $user_id = wp_update_user( array( 'ID' => $user_id, 'role' => 'editor' ) );
}
$user_id = username_exists( "contributor" );
if ( !$user_id && email_exists("contributor@teste.com.br") == false ) {
    $user_id = wp_create_user( "contributor", "admin123", "contributor@teste.com.br" );
    $user_id = wp_update_user( array( 'ID' => $user_id, 'role' => 'contributor' ) );
}
$user_id = username_exists( "subscriber" );
if ( !$user_id && email_exists("subscriber@teste.com.br") == false ) {
    $user_id = wp_create_user( "subscriber", "admin123", "subscriber@teste.com.br" );
    $user_id = wp_update_user( array( 'ID' => $user_id, 'role' => 'subscriber' ) );
}
*/

/*
// add_action( 'init', 'force_404', 1 );
function force_404() {
    $requested_uri = $_SERVER["REQUEST_URI"];

    if (  strpos( $requested_uri, '/wp-login.php') !== false ) {
        // The redirect codebase
        status_header( 404 );
        nocache_headers();
        include( get_query_template( '404' ) );
        die();
    }

    if (  strpos( $requested_uri, '/wp-login.php') !== false || strpos( $requested_uri, '/wp-register.php') !== false ) {
        // The redirect codebase
        status_header( 404 );
        nocache_headers();
        include( get_query_template( '404' ) );
        die();
    }

    if (  strpos( $requested_uri, '/wp-admin') !== false && !is_super_admin() ) {
        // The redirect codebase
        status_header( 404 );
        nocache_headers();
        include( get_query_template( '404' ) );
        die();
    }
}
*/
?>