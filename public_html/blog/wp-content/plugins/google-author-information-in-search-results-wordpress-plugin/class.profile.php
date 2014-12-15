<?php


/**
 * GPAISRProfile class.
 */
class GPAISRProfile {


	/**
	 * __construct function.
	 *
	 * @access public
	 * @return \GPAISRProfile
	 * @since  0.6
	 */
	function __construct() {

		// new user contact field
		add_filter( 'user_contactmethods', array( &$this, 'user_contactmethods' ) );

		add_action( 'init', array( &$this, 'upgrade' ) );
	}

	/**
	 * @since 0.7.2
	 *
	 * @param array $contact_methods
	 *
	 * @return array
	 */
	function user_contactmethods( $contact_methods ) {
		$contact_methods['googleplus'] = __( 'Google+', 'gpaisr' );
		return $contact_methods;
	}

	/**
	 * Will upgrade the user meta data
	 *
	 * @since 0.7.2
	 *
	 */
	function upgrade() {
		if ( false === (bool) get_option( 'gpaisr_gplus_link_move', false ) ) {

			$users = get_users();
			foreach ( $users as $user ) {
				$old_gplus_link = get_user_meta( $user->ID, 'gplus_link', true );

				// check if there is a old gplus link. if not, continue
				if ( empty( $old_gplus_link ) ) {
					continue;
				}

				$new_gplus_link = get_user_meta( $user->ID, 'googleplus', true );

				// check if there is already a gplus link in the users meta (maybe from Yoast SEO Plugin). If yes, continue
				if ( ! empty( $new_gplus_link ) ) {
					continue;
				}

				// alright. there is no gplus link, so add the new one ...
				update_user_meta( $user->ID, 'googleplus', $old_gplus_link );

				// ... and delete the old one
				delete_user_meta( $user->ID, 'gplus_link' );
			}

			update_option( 'gpaisr_gplus_link_move', true );

		}
	}


}