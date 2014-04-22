<?php

/*
 * * * * * * * * * * * * * * * * * * *
 * 		  Profile Page + Save
 * * * * * * * * * * * * * * * * * * *
 */

class GPAISRProfile {

	function __construct(){
		// Will show the field
		add_action( 'show_user_profile', array($this, 'link_profile_fields' ));
		add_action( 'edit_user_profile', array($this, 'link_profile_fields' ));
		
		// Will save the field
		add_action( 'personal_options_update', array($this, 'link_profile_fields_save' ));
		add_action( 'edit_user_profile_update', array($this, 'link_profile_fields_save' ));		
	}


	/**
	 * Displays the profile-field in the Authors Profile Page
	 */
	function link_profile_fields( $user ) { ?>
	
		<h3>Google Plus Author Link</h3>
	
		<table class="form-table">
	
			<tr>
				<th><label for="twitter">Google Plus Link</label></th>
	
				<td>
					<input type="text" name="gplus_link" id="gplus_link" value="<?php echo esc_attr( get_the_author_meta( 'gplus_link', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description">Please enter the URL to your Google+ Profile.</span>
				</td>
			</tr>
	
		</table>
	<?php }
	
	
	/**
	 * Saves the profile-field from the authors profile page
	 */
	function link_profile_fields_save( $user_id ) {
	
		if ( !current_user_can( 'edit_user', $user_id ) )
			return false;
		update_usermeta( $user_id, 'gplus_link', $_POST['gplus_link'] );
	}
	
	
	
	
}