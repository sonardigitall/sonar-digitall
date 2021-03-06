<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$master_id = sptFilterData($_POST['master_id']);
$slave_id = sptFilterData($_POST['slave_id']);

if ((!empty($master_id) && is_numeric($master_id)) &&
	(!empty($slave_id) && is_numeric($slave_id))) {

	echo sptCreateSplitTestPost($master_id, $slave_id);

}

function sptCreateSplitTestPost($master_id, $slave_id) {
	global $wpdb;

	$new_post_author = wp_get_current_user();

	$new_post = array(
		'post_author' => $new_post_author->ID,
		'post_date' => current_time('mysql'),
		'post_date_gmt' => current_time('mysql', true),
		'post_status' => 'publish',
		'post_title' => get_the_title($master_id),
		'post_type' => 'spt',
	);

	$new_post_id = wp_insert_post($new_post, false);

	// Check if successfully created
	if ($new_post_id != 0) {
		// Add master and slave IDs

		$sptData = array(
			'master_id' => $master_id,
			'master_weight' => 50,
			'master_visits' => array(),
			'slave_id' => $slave_id,
			'slave_weight' => 50,
			'slave_visits' => array(),
			'winner_action' => 'archive'
		);

		update_post_meta($new_post_id, 'sptData', serialize($sptData));
		update_post_meta($master_id, 'sptID', $new_post_id);
		update_post_meta($slave_id, 'sptID', $new_post_id);

		$new_post = array();
		$new_post['ID'] = $new_post_id;

		// Update the post into the database
		wp_update_post($new_post);

		// Create archiver cron job for this split test
		wp_schedule_event( current_time( 'timestamp', true ), 'daily', 'spt_archive_stats', array( $new_post_id ) );

	}

	return $new_post_id;
}

?>
