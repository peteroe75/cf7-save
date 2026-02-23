<?php
if (!defined('ABSPATH')) exit;

function ml_cf7_install() {
    global $wpdb;

    $table = $wpdb->prefix . 'ml_cf7_entries';
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        created_at DATETIME NOT NULL,
        form_id BIGINT NOT NULL,
        form_name VARCHAR(200) NOT NULL,
        ip_address VARCHAR(100),
        user_agent TEXT,
        submission LONGTEXT NOT NULL,
        PRIMARY KEY (id)
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

?>
