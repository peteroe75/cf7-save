<?php
if (!defined('ABSPATH')) exit;

function ml_cf7_add_capability() {

    $roles = ['administrator', 'author'];

    foreach ($roles as $role_name) {
        $role = get_role($role_name);
        if ($role) {
            $role->add_cap('view_cf7_entries');
        }
    }
}

add_action('init', 'ml_cf7_add_capability');
