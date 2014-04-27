<div class="wrap" id="gpaisr">

	<h2><?php echo __( 'Google+ Authorship (Free) Settings', 'gpaisr' ) ?></h2><br />

	<div id="poststuff" class="metabox-holder has-right-sidebar">

		<div id="side-info-column" class="inner-sidebar">
			<?php do_meta_boxes( $this->_pagehook, 'side', array() ); ?>
		</div>

		<div id="post-body" class="has-sidebar">
			<div id="post-body-content" class="has-sidebar-content">
				<?php do_meta_boxes( $this->_pagehook, 'normal', array( 'lastPostPermalink' => $lastPostPermalink ) ); ?>
			</div>
		</div>

		<br class="clear" />

	</div>
	<!-- poststuff -->

</div><!-- wrap -->

<div id="fb-root"></div>

<script type="text/javascript">
	//<![CDATA[
	(function() {
		var po = document.createElement( 'script' );
		po.type = 'text/javascript';
		po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName( 'script' )[0];
		s.parentNode.insertBefore( po, s );
	})();

	jQuery( document ).ready( function( $ ) {
		// close postboxes that should be closed
		jQuery( '.if-js-closed' ).removeClass( 'if-js-closed' ).addClass( 'closed' );
		// postboxes setup
		postboxes.add_postbox_toggles( '<?php echo $this->_pagehook; ?>' );

		/*jQuery( '#gpaisr-contentbox-2' ).addClass( 'closed' );*/

		if( jQuery( '#gpaisr_replace_author_link_1' ).attr( 'checked' ) == 'checked' ) {
			jQuery( '#gpaisr-contentbox-3 table.form-table tr:not(:first)' ).css( 'display', 'none' );
		}

		jQuery( '#gpaisr_replace_author_link_0' ).click( function() {
			if( jQuery( this ).attr( 'checked' ) == 'checked' ) {
				jQuery( '#gpaisr-contentbox-3 table.form-table tr:not(:first)' ).fadeIn( 300 );
			}
		} );

		jQuery( '#gpaisr_replace_author_link_1' ).click( function() {
			if( jQuery( this ).attr( 'checked' ) == 'checked' ) {
				jQuery( '#gpaisr-contentbox-3 table.form-table tr:not(:first)' ).fadeOut( 300 );
			}
		} );
	} );

	(function( d, s, id ) {
		var js, fjs = d.getElementsByTagName( s )[0];
		if( d.getElementById( id ) ) return;
		js = d.createElement( s );
		js.id = id;
		js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1&appId=199493520090897";
		fjs.parentNode.insertBefore( js, fjs );
	}( document, 'script', 'facebook-jssdk' ));

	!function( d, s, id ) {
		var js, fjs = d.getElementsByTagName( s )[0];
		if( !d.getElementById( id ) ) {
			js = d.createElement( s );
			js.id = id;
			js.src = "//platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore( js, fjs );
		}
	}( document, "script", "twitter-wjs" );
	//]]>
</script>