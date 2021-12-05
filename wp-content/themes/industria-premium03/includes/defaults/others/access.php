<?php

// add_role( 'client', 'Cliente', array( 'read' => true, 'level_0' => true ) );

// remove_role('author');
// remove_role('editor');
// remove_role('contributor');
// remove_role('subscriber');

function add_theme_caps_configure_default() {
    global $wp_roles;
    if ( ! isset( $wp_roles ) ) $wp_roles = new WP_Roles();
    $admin_capabilities = $wp_roles->get_role('administrator');

    $wp_roles->add_role('wsg_super_admin', 'WebSites Goiás', $admin_capabilities->capabilities);
    $wp_roles->add_role('wsg_agency', 'Agência', $admin_capabilities->capabilities);

    $wsg_super_admin = get_role('wsg_super_admin');
    $wsg_agency = get_role('wsg_agency');

    $administrator = get_role('administrator');
    $administrator->remove_cap('edit_plugins');


    foreach ($admin_capabilities->capabilities as $key => $value) {
        $wsg_super_admin->add_cap($key);
        $wsg_agency->add_cap($key);
    }

    // $wsg_super_admin->remove_cap('edit_plugins');
    $wsg_agency->remove_cap('edit_plugins');

    $user_id_wsg = username_exists('wsg-super-admin');
    if(!$user_id_wsg && email_exists('superadmin@websitesgoias.com.br') == false){
        $user_id_wsg = wp_create_user('wsg-super-admin', 'admin123', 'superadmin@websitesgoias.com.br');
        $user = new WP_User($user_id_wsg);
        $user->set_role('wsg_super_admin');

        $user_id_agency = username_exists('agencia');
        if(!$user_id_agency && email_exists('agency@websitesgoias.com.br') == false){
            $user_id_agency = wp_create_user('agencia', 'admin123', 'agency@websitesgoias.com.br');
            $user = new WP_User($user_id_agency);
            $user->set_role('wsg_agency');
        }
        $user_id_admin = username_exists('user_admin');
        if(!$user_id_admin && email_exists('admin@websitesgoias.com.br') == false){
            $user_id_admin = wp_create_user('user_admin', 'admin123', 'admin@websitesgoias.com.br');
            $user = new WP_User($user_id_admin);
            $user->set_role('administrator');
        }
    }
}
add_action( 'admin_init', 'add_theme_caps_configure_default');






add_filter('editable_roles', 'remove_higher_levels');
function remove_higher_levels($all_roles) {
    $user = wp_get_current_user();
    if($user->roles[0] !== 'wsg_super_admin'){
        if($user->roles[0] == 'wsg_agency'){
            unset($all_roles['wsg_super_admin']);
        }else{
            unset($all_roles['wsg_agency']);
            unset($all_roles['wsg_super_admin']);
        }
    }
    return $all_roles;
}


function hide_info_sensitive(){
    $user = wp_get_current_user();
    if($user->roles[0] !== 'wsg_super_admin'){
        if($user->roles[0] == 'wsg_agency'){
            echo '  <style type="text/css">
                        body.users-php ul.subsubsub li.wsg_super_admin {
                            display: none;
                        }
                    </style>
                    ';
        }else{
            echo '  <style type="text/css">
                        body.users-php ul.subsubsub li.wsg_super_admin,
                        body.users-php ul.subsubsub li.wsg_agency {
                            display: none;
                        }
                    </style>
                    ';
        }
    }
}
add_action('admin_head','hide_info_sensitive');

function stop_access_profile() {
    $user = wp_get_current_user();  

    global $pagenow;
    if ($pagenow == 'user-edit.php') {
        if (!isset($_GET['user_id'])) {
            return;
        }
        $userCurrentEdit = get_user_by("ID", $_GET['user_id']);
        if (
                $userCurrentEdit->roles[0] == 'wsg_super_admin'
                &&
                $user->roles[0] !== 'wsg_super_admin'
            ) {
            wp_die('Acesso negado');
        }
        if (
                $userCurrentEdit->roles[0] == 'wsg_agency'
                &&
                    (
                        $user->roles[0] !== 'wsg_agency'
                        &&
                        $user->roles[0] !== 'wsg_super_admin'
                    )
            ) {
            wp_die('Acesso negado');
        }
    }
}
add_action( 'admin_init', 'stop_access_profile' );

?>