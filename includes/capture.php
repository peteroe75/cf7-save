<?php
if (!defined('ABSPATH')) exit;

add_action('wpcf7_mail_sent', function ($contact_form) {

    global $wpdb;

    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return;

    $data = $submission->get_posted_data();
    $table = $wpdb->prefix . 'ml_cf7_entries';

    $clean = '';

    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $value = implode(', ', $value);
        }

        $clean .= sanitize_text_field($key) . ': ' . sanitize_text_field($value) . "\n\n";
    }

    $wpdb->insert($table, [
        'created_at' => current_time('mysql'),
        'form_id'    => $contact_form->id(),
        'form_name'  => $contact_form->title(),
        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        'submission' => $clean
    ]);
});
