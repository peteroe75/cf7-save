<?php
if (!defined('ABSPATH')) exit;

add_shortcode('cf7_entries', function () {

    if (!current_user_can('view_cf7_entries')) {
        return '<p>Access denied.</p>';
    }

    global $wpdb;
    $table = $wpdb->prefix . 'ml_cf7_entries';

    $entries = $wpdb->get_results(
        "SELECT * FROM $table ORDER BY created_at DESC LIMIT 100"
    );

    if (!$entries) {
        return '<p>No entries found.</p>';
    }

    ob_start();

    echo '<div class="ml-cf7-entries">';
    echo '<table style="width:100%;border-collapse:collapse;">';
    echo '<tr>
            <th style="text-align:left;border-bottom:1px solid #ccc;">Date</th>
            <th style="text-align:left;border-bottom:1px solid #ccc;">Form</th>
            <th style="text-align:left;border-bottom:1px solid #ccc;">IP</th>
            <th style="text-align:left;border-bottom:1px solid #ccc;">Submission</th>
          </tr>';

    foreach ($entries as $entry) {
        echo '<tr>';
        echo '<td style="vertical-align:top;padding:10px 0;">' . esc_html($entry->created_at) . '</td>';
        echo '<td style="vertical-align:top;padding:10px 0;">' . esc_html($entry->form_name) . '</td>';
        echo '<td style="vertical-align:top;padding:10px 0;">' . esc_html($entry->ip_address) . '</td>';
        echo '<td style="vertical-align:top;padding:10px 0;"><pre style="white-space:pre-wrap;">' . esc_html($entry->submission) . '</pre></td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';

    return ob_get_clean();
});
