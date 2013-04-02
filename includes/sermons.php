<?php
/**
 * Sermon Functions
 */

/**********************************
 * ARCHIVES (Dates, Categories, Tags, Speakers)
 **********************************/

/**
 * Enable date archives for sermon posts
 * At time of making, WordPress (3.4 and possibly later) does not support dated archives for custom post types as it does for standard posts
 * This injects rules so that URL's like /cpt/2012/05 can be used with the custom post type archive template
 * Refer to includes/posts.php:ctc_cpt_date_archive_setup() for full details
 */

add_action( 'generate_rewrite_rules', 'ctc_sermon_date_archive' ); // enable date archive for sermon post type
 
function ctc_sermon_date_archive( $wp_rewrite ) {

	// Post types to setup date archives for
	$post_types = array(
		'ccm_sermon'
	);

	// Do it
	ctc_cpt_date_archive_setup( $post_types, $wp_rewrite );

}

/**********************************
 * DATA
 **********************************/

/**
 * Get sermon meta data
 */

function ctc_sermon_meta() {

	$meta = array();

	$post_id = get_the_ID();

	if ( $post_id ) {

		$fields = array( // without _ccm_sermon_ prefix
			'video_url',
			'audio_url',
			'pdf_url',
			'text'
		);

		foreach( $fields as $field ) {
			$meta[$field] = get_post_meta( $post_id, '_ccm_sermon_' . $field, true );
		}

	}

	return apply_filters( 'ctc_sermon_meta', $meta );

}


