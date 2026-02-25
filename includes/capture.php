<?php
if (!defined('ABSPATH')) exit;

add_action('wpcf7_before_send_mail', function ($contact_form) {

    // Defensive type check
    if (!($contact_form instanceof WPCF7_ContactForm)) {
        return;
    }

    global $wpdb;

    $submission = WPCF7_Submission::get_instance();
    if (!$submission) {
        return;
    }

    $data  = $submission->get_posted_data();
    $table = $wpdb->prefix . 'ml_cf7_entries';

    $clean = '';

    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $value = implode(', ', $value);
        }

        $clean .= sanitize_text_field($key) . ': ' .
                  sanitize_textarea_field($value) . "\n\n";
    }

    $form_id   = (int) $contact_form->id();
    $form_name = sanitize_text_field($contact_form->title());
    $ip        = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $user_agent = sanitize_text_field($_SERVER['HTTP_USER_AGENT'] ?? '');

    $wpdb->insert(
        $table,
        [
            'created_at' => current_time('mysql'),
            'form_id'    => $form_id,
            'form_name'  => $form_name,
            'ip_address' => $ip,
            'user_agent' => $user_agent,
            'submission' => $clean
        ],
        [
            '%s',
            '%d',
            '%s',
            '%s',
            '%s',
            '%s'
        ]
    );
});
