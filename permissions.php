<?php
if (!defined('ABSPATH')) exit;

function ml_cf7_add_capability() {
    $role = get_role('administrator');
    if ($role) {
        $role->add_cap('view_cf7_entries');
    }
}
