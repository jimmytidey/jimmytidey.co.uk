<?php

/*
 * * * * * * * * * * * * * * * * * * *
 * 		  Shows the author links
 * * * * * * * * * * * * * * * * * * *
 */

class GPAISRFilter {

	/**
	 * @since 0.6
	 */
	function __construct() {
		$options = get_option( 'gpaisr' );

		if ( isset( $options['into_header'] ) && 1 == $options['into_header'] ) {
			add_action( 'wp_head', array( &$this, 'to_header' ) );
		}
		elseif ( isset( $options['replacement'] ) && $options['replacement'] == 1 ) {
			add_filter( 'author_link', array( $this, 'author_link_filter' ), 0, 3 );
		}
		else {
			add_filter( 'the_content', array( $this, 'author_link_in_content' ), 15 );
		}
	}

	/**
	 * Just replaces the link with the google+ url
	 *
	 * @param $link
	 * @param $author_id
	 * @param $author_nicename
	 *
	 * @since 0.6
	 *
	 * @return string
	 */
	function author_link_filter( $link, $author_id, $author_nicename ) {
		$gplus_author_link = get_the_author_meta( 'googleplus', $author_id );
		if ( ! empty( $gplus_author_link ) ) {
			return $gplus_author_link . '?rel=author';
		}
		return $link;
	}

	/**
	 * Writes the Google+-URL right after the Content
	 *
	 * @param $content
	 *
	 * @since 0.6
	 *
	 * @return string
	 */
	function author_link_in_content( $content ) {

		if ( ! is_singular() ) {
			return $content;
		}

		// load the options from the settings page
		$options = get_option( 'gpaisr' );

		// is this the feed? if yes, should we display the link?
		if ( ! isset( $options['in_feed'] ) ) {
			$options['in_feed'] = 0;
		}
		if ( is_feed() && $options['in_feed'] != 1 ) {
			return $content;
		}

		// what's the author id?
		$authorId = get_the_author_meta( 'ID' );

		// find the link
		$gplus_author_link = get_the_author_meta( 'googleplus', $authorId );
		if ( ! empty( $gplus_author_link ) ) {
			$gplus_author_link = $gplus_author_link . '?rel=author';
		}

		// open in a new window?
		$newWindow = '';
		if ( isset( $options['new_window'] ) && $options['new_window'] == 1 ) {
			$newWindow = 'target="_blank"';
		}

		// show or hide?
		$showHide = '';
		if ( isset( $options['hide'] ) && $options['hide'] == 1 ) {
			$showHide = 'style="display:none;"';
		}

		// is there a linktext?
		$linktext = 'Google+';
		if ( ! empty( $options['link_text'] ) ) {
			$linktext = $options['link_text'];
		}

		return $content .= '<a rel="author" href="' . $gplus_author_link . '" ' . $newWindow . ' ' . $showHide . '>' . $linktext . '</a>';
	}


	/**
	 * Adds the Google profile link to the header
	 * @since 0.7.2
	 * @return void
	 */
	function to_header() {

		global $post;
		if ( ! $post instanceof WP_Post ) {
			return;
		}

		if ( ! is_singular() ) {
			return;
		}

		$authorId = $post->post_author;

		// find the link
		$gplus_author_link = get_the_author_meta( 'googleplus', $authorId );

		if ( ! empty( $gplus_author_link ) ) {
			echo '<link href="' . $gplus_author_link . '" rel="author" />';
		}


	}

}