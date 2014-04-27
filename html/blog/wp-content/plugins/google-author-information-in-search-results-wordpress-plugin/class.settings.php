<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


/**
 * GPAISRSettings class.
 */
class GPAISRSettings {
	/**
	 * pagehook
	 * will be set in the menu-function
	 *
	 * (default value: '')
	 *
	 * @var string
	 * @access private
	 * @since  0.7
	 */
	private $_pagehook = '';


	/**
	 * @var string|null
	 * @since 0.7
	 */
	private $_plugin_file = null;


	/**
	 * __construct function.
	 *
	 * @access public
	 * @since  0.7
	 *
	 * @param $plugin_file
	 *
	 * @return \GPAISRSettings
	 */
	function __construct( $plugin_file ) {

		$this->_plugin_file = $plugin_file;

		// Creates the menu
		add_action( 'admin_menu', array( &$this, 'menu' ) );

		// Creates the settings (and the settings page)
		add_action( 'admin_init', array( &$this, 'settings' ) );

		add_filter( 'plugin_action_links_' . plugin_basename( $this->_plugin_file ), array( &$this, 'plugin_action_links' ) );

	}


	/**
	 * scripts function.
	 * adds the scripts which are important for add_metabox
	 *
	 * @access public
	 * @return void
	 * @since  0.7
	 */
	public function scripts() {
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
	}


	/**
	 * menu function.
	 * will add the menu in the WordPress backend
	 *
	 * @access public
	 *
	 * @return void
	 * @since  0.7
	 */
	public function menu() {
		$this->_pagehook = add_options_page( __( 'Google+ Author Free', 'gpaisr' ), __( 'Google+ Author Free', 'gpaisr' ), 'administrator', 'gpaisr', array( $this, 'settings_page' ) );
		add_action( 'load-' . $this->_pagehook, array( &$this, 'scripts' ) );
	}


	/**
	 * settings_page function.
	 * creates the settings page content and some metaboxes
	 *
	 * @access public
	 * @return void
	 * @since  0.7
	 */
	public function settings_page() {
		// add meteabox "General"
		add_meta_box( 'gpaisr-contentbox-1', __( 'General' ), array( &$this, 'metabox_general' ), $this->_pagehook, 'normal', 'core' );

		// add metabox "howto"
		add_meta_box( 'gpaisr-contentbox-2', __( 'What to do', 'gpaisr' ), array( &$this, 'metabox_howto' ), $this->_pagehook, 'normal', 'low' );

		// add metabox "settings
		add_meta_box( 'gpaisr-contentbox-3', __( 'Settings' ), array( &$this, 'metabox_settings' ), $this->_pagehook, 'normal', 'low' );

		// add metabox "about"
		add_meta_box( 'gpaisr-contentbox-4', __( 'About', 'gpaisr' ), array( &$this, 'metabox_about' ), $this->_pagehook, 'side', 'default' );

		// add metabox "share"
		add_meta_box( 'gpaisr-contentbox-5', __( 'Share', 'gpaisr' ), array( &$this, 'metabox_share' ), $this->_pagehook, 'side', 'default' );

		add_meta_box( 'gpaisr-contentbox-7', __( 'Discover', 'gpaisr' ), array( &$this, 'metabox_discover' ), $this->_pagehook, 'side', 'default' );

		// add the metabox "links"
		add_meta_box( 'gpaisr-contentbox-6', __( 'Helpful links', 'gpaisr' ), array( &$this, 'metabox_links' ), $this->_pagehook, 'side', 'default' );


		global $screen_layout_columns;

		$lastPostPermalink = get_bloginfo( 'url' );
		query_posts( 'showposts=1&post_status=publish' );
		while ( have_posts() ) : the_post();
			$lastPostPermalink = get_permalink();
		endwhile;

		include_once( 'page.settings.php' );
	}


	/**
	 * metabox_general function.
	 * creates the content for the general metabox
	 *
	 * @access public
	 *
	 * @param mixed $data
	 *
	 * @return void
	 * @since  0.6
	 */
	public function metabox_general( $data ) {
		echo '<p>' . __( 'This plugin will replace your author link in your template with your Google+ Profile link to make sure that the picture will be shown at the search results.', 'gpaisr' ) . '</p>';
		echo '<p>' . __( 'Alternatively the link can be included after the content if your template does not show the author  link.', 'gpaisr' ) . '</p>';

		echo '<p><strong>' . __( 'Please note:', 'gpaisr' ) . '</strong> ' . __( 'Google says that there is no guarantee that a Rich Snippet will be shown for your page on actual search results.', 'gpaisr' ) . ' <a href="http://support.google.com/webmasters/bin/answer.py?hl=en&answer=1306778&ctx=cb&src=cb&cbid=-1n2ig3z0a1yr8&cbrank=0" target="_blank">' . __( 'Please click here for more information', 'gpaisr' ) . '</a></p>';
	}


	/**
	 * metabox_howto function.
	 * creates the content for the howto-metabox
	 *
	 * @access public
	 *
	 * @param mixed $data
	 *
	 * @return void
	 * @since  0.6
	 */
	public function metabox_howto( $data ) {
		?>

		<h4><?php echo __( 'A) Set up authorship by linking your content to your Google+ profile', 'gpaisr' ); ?></h4>

		<ol id="gplisting">

			<li><?php echo sprintf( __( 'Follow this link to open your Google+ profile: %s', 'gpaisr' ), '<a href="http://plus.google.com/me" target="_blank">http://plus.google.com/me</a>' ); ?></li>

			<li><?php echo __( 'Copy your Profile-URL from the address bar to clipboard (see picture below):', 'gpaisr' ); ?>
				<br />
				<img src="<?php echo plugins_url( 'images/gplus-profile.jpg', __FILE__ ); ?>" alt="" style="border: 1px solid black;" />
			</li>

			<li><?php echo __( 'Go to your Wordpress Admin Panel and click Users -> Your Profile. Paste the above mentioned URL to the field where it says "Google+".', 'gpaisr' ); ?>
				<br />
				<img src="<?php echo plugins_url( 'images/gplus-update-profile.jpg', __FILE__ ); ?>" alt="" style="border: 1px solid black;" />
			</li>

			<li><?php echo __( 'Click Update Profile.', 'gpaisr' ); ?></li>

			<li><?php echo __( 'Repeat the above steps with all the other Wordpress authors on your blog.', 'gpaisr' ); ?></li>

		</ol>

		<br />
		<h4><?php echo __( 'B) Add a reciprocal link back from your profile to the site you just updated', 'gpaisr' ); ?></h4>

		<ol id="gplisting">

			<li><?php echo sprintf( __( 'Follow this link to edit the Contributor To section: %s', 'gpaisr' ), '<a href="http://plus.google.com/me/about/edit/co" target="_blank">http://plus.google.com/me/about/edit/co</a>' ); ?></li>


			<li><?php echo sprintf( __( 'A dialog will appear. Scroll down to the "Contributor to" section. Click "Add custom link" and enter your website URL: %s', 'gpaisr' ), site_url() ); ?></li>

			<li><?php echo sprintf( __( 'Optional: For the label you can use your website title: %s', 'gpaisr' ), get_bloginfo( 'name' ) ); ?></li>

			<li><?php echo __( 'If you want, click the drop-down list to specify who can see the link.', 'gpaisr' ); ?></li>

			<li><?php echo __( 'Click Save.', 'gpaisr' ); ?></li>

			<li><?php echo __( 'Tell your authors that they should also do step B.', 'gpaisr' ); ?></li>

		</ol>

		<br />
		<h4><?php echo __( 'C) Test', 'gpaisr' ); ?></h4>

		<ol id="gplisting">

			<li><?php echo __( 'To see what author data Google can extract from your page, use the Rich Snippet Testing Tool.', 'gpaisr' ); ?></li>

		</ol>

	<?php
	}


	/**
	 * metabox_settings function.
	 * creates the content for the settings metabox
	 *
	 * @access public
	 *
	 * @param mixed $data
	 *
	 * @return void
	 * @since  0.6
	 */
	public function metabox_settings( $data ) {
		?>
		<form action="options.php" method="post">

			<?php settings_fields( 'gpaisr_options_group' ); ?>

			<?php
			do_settings_sections( 'gpaisr' );
			wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
			wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
			?>

			<p class="submit" style="float:left;">
				<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes' ); ?>" />
			</p>
		</form>
		<form action="http://www.google.com/webmasters/tools/richsnippets" method="get" target="_blank">
			<input type="hidden" value="<?php echo $data['lastPostPermalink']; ?>" name="url" />

			<p class="submit">
				<input name="Submit" type="submit" class="button-primary" value="<?php echo __( 'Test the latest post or page.', 'gpaisr' ); ?>" />
			</p>
			<br class="clear" />
		</form>
	<?php
	}


	/**
	 * Shows the "about" metabox
	 * @since 0.7
	 */
	public function metabox_about() {
		?>
		<a href="http://bit.ly/TO0Z5w" target="_blank"><img src="https://wpbuddy.libra.uberspace.de/secure/wp-buddy-logo.png" alt="WPBuddy Logo" /></a><?php
	}

	/**
	 * metabox_share function.
	 * creates the content for the sare side-metabox
	 *
	 * @access public
	 *
	 * @param mixed $data
	 *
	 * @return void
	 * @since  0.6
	 */
	public function metabox_share( $data ) {
		?>

		<!-- Google+ Button -->
		<p><div style="width: 220px;" class="g-plusone" data-size="medium" data-annotation="inline" data-href="http://wp-buddy.com/products/plugins/google-authorship-wordpress-plugin/"></div></p>

		<!-- Facebook button -->
		<p>
		<div class="fb-like" data-href="http://wp-buddy.com/products/plugins/google-authorship-wordpress-plugin/" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div></p>

		<!-- Twitter-Button -->
		<p>
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://wp-buddy.com/products/plugins/google-authorship-wordpress-plugin/" data-via="floriansimeth">Tweet</a>
		</p>
	<?php
	}


	/**
	 * metabox_discover function.
	 * creates a metabox with the affiliate link to pro-version
	 *
	 * @access public
	 *
	 * @param mixed $data
	 *
	 * @return void
	 * @since  0.6
	 */
	public function metabox_discover( $data ) {
		?>
		<a href="http://bit.ly/Wn88bZ" target="_blank"><img src="https://wpbuddy.libra.uberspace.de/secure/google-author-pro.jpg" border="0" alt="" /></a>
	<?php
	}


	/**
	 * settings function.
	 * creates the settings-fields in the settings-metabox
	 *
	 * @access public
	 * @return void
	 * @since  0.6
	 */
	function settings() {

		register_setting( 'gpaisr_options_group', 'gpaisr' );

		add_settings_section( 'gpaisr_section_text', '', array( $this, 'sectionText' ), 'gpaisr' );

		add_settings_field( 'gpaisr_into_header', __( 'Add to the header', 'gpaisr' ), array( $this, 'field_into_header' ), 'gpaisr', 'gpaisr_section_text' );

		add_settings_field( 'gpaisr_replace_author_link', __( 'Replace author link with the Google Profile URL?', 'gpaisr' ), array( $this, 'field_replacement' ), 'gpaisr', 'gpaisr_section_text' );

		add_settings_field( 'gpaisr_hide_author_link_in_content', __( 'Show or hide the link in the content-section?', 'gpaisr' ), array( $this, 'field_hide' ), 'gpaisr', 'gpaisr_section_text' );

		add_settings_field( 'gpaisr_open_in_new_window', __( 'Open the link in a new window?', 'gpaisr' ), array( $this, 'field_new_window' ), 'gpaisr', 'gpaisr_section_text' );

		add_settings_field( 'gpaisr_rss', __( 'Display in Feed?', 'gpaisr' ), array( $this, 'field_rss' ), 'gpaisr', 'gpaisr_section_text' );

		add_settings_field( 'gpaisr_link_text', __( 'Link text', 'gpaisr' ), array( $this, 'field_link_text' ), 'gpaisr', 'gpaisr_section_text' );

		add_settings_field( 'gpaisr_affiliate', '', array( $this, 'field_affiliate' ), 'gpaisr', 'gpaisr_section_text' );

	}


	/**
	 * sectionText function.
	 * this is a text-section
	 *
	 * @access public
	 * @return void
	 * @since  0.6
	 */
	function sectionText() {
		echo '<p>' . __( 'Not every theme shows the Author-Link right beside a page or an article. In this case activate the link to be included after the content.', 'gpaisr' );
	}


	function field_into_header() {
		$options = get_option( 'gpaisr' );
		if ( ! isset( $options['into_header'] ) ) {
			$options['into_header'] = 0;
		}
		echo "<input " . checked( intval( $options['into_header'] ), 1, false ) . " id='gpaisr_into_header' name='gpaisr[into_header]'  type='checkbox' value='1' />";
		echo ' <small>' . __( '(Recommended. Not visible to the user.)', 'gpaisr' ) . '</small>';

		?>
		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery(document).ready(function () {
				if (jQuery('#gpaisr_into_header').is(':checked')) {
					jQuery('#gpaisr_into_header').closest('table').find('tr:gt(0)').hide();
				}

				jQuery('#gpaisr_into_header').on('click', function(){
					if (jQuery(this).is(':checked')) {
						jQuery(this).closest('table').find('tr:gt(0)').hide();
					} else {
						jQuery(this).closest('table').find('tr:gt(0)').show();
					}
				});
			});
			/* ]]> */
		</script>
	<?php
	}

	/**
	 * field_replacement function.
	 * shows the replacement-settings field
	 *
	 * @access public
	 * @return void
	 * @since  0.6
	 */
	function field_replacement() {
		$options = get_option( 'gpaisr' );
		if ( ! isset( $options['replacement'] ) ) {
			$options['replacement'] = 0;
		}
		echo "<input " . ( ( $options['replacement'] == 1 ) ? 'checked="checked"' : '' ) . " id='gpaisr_replace_author_link_1' name='gpaisr[replacement]' type='radio' value='1' /> " . __( 'Yes' ) . ' <small>' . __( '(Please note: Some themes does not support this.)', 'gpaisr' ) . '</small>';
		echo "<br /><input " . ( ( empty( $options['replacement'] ) ) ? 'checked="checked"' : '' ) . " id='gpaisr_replace_author_link_0' name='gpaisr[replacement]' type='radio' value='0' /> " . __( 'No' ) . '. <small>' . __( 'Instead show it in the content-area (see below)', 'gpaisr' ) . '</small>';
	}


	/**
	 * field_hide function.
	 * displays the show or hide settings field
	 *
	 * @access public
	 * @return void
	 * @since  0.6
	 */
	function field_hide() {
		$options = get_option( 'gpaisr' );
		if ( ! isset( $options['hide'] ) ) {
			$options['hide'] = 0;
		}
		echo "<input " . ( ( $options['hide'] == 1 ) ? 'checked="checked"' : '' ) . " id='gpaisr_replace_hide_1' name='gpaisr[hide]'  type='radio' value='1' /> " . __( 'Hide' ) . ' <small>' . __( '(Please not that Google does not like hidden links)', 'gpaisr' ) . '</small>';
		echo "<br /><input " . ( ( empty( $options['hide'] ) ) ? 'checked="checked"' : '' ) . " id='gpaisr_replace_hide_0' name='gpaisr[hide]'  type='radio' value='0' /> " . __( 'Show' );
	}


	/**
	 * field_new_window function.
	 * shows the new window settings field
	 *
	 * @access public
	 * @return void
	 * @since  0.6
	 */
	function field_new_window() {
		$options = get_option( 'gpaisr' );
		echo "<input " . ( ( isset( $options['new_window'] ) && $options['new_window'] == 1 ) ? 'checked="checked"' : '' ) . " id='gpaisr_new_window' name='gpaisr[new_window]'  type='checkbox' value='1' />";
	}


	/**
	 * field_rss function.
	 * shows the "no rss" settings field
	 *
	 * @access public
	 * @return void
	 * @since  0.6
	 */
	function field_rss() {
		$options = get_option( 'gpaisr' );
		echo "<input " . ( ( isset( $options['in_feed'] ) && $options['in_feed'] == 1 ) ? 'checked="checked"' : '' ) . " id='gpaisr_in_feed' name='gpaisr[in_feed]'  type='checkbox' value='1' /> <small>(" . __( 'Check this if you want to display the Google+ Link inside the feeds.', 'gpaisr' ) . ')</small>';
	}


	/**
	 * field_link_text function.
	 * displays the link text settings field
	 *
	 * @access public
	 * @return void
	 * @since  0.6
	 */
	function field_link_text() {
		$options = get_option( 'gpaisr' );
		echo "<input id='gpaisr_link_text' name='gpaisr[link_text]' size='40' type='text' value='" . ( ( ! isset( $options['link_text'] ) ) ? 'Google+' : $options['link_text'] ) . "' />";
	}


	/**
	 * field_affiliate function.
	 * displays the affiliate link to pro-version
	 *
	 * @access public
	 * @return void
	 * @since  0.6
	 */
	function field_affiliate() {
		echo '<a href="http://bit.ly/Wn88bZ" target="_blank">' . __( 'Need more options and an automatic test? Check out the Extended Version of this Plugin', 'gpaisr' ) . '</a>';
	}


	/**
	 * Adds links to the plugins menu (where the plugins are listed)
	 *
	 * @param array $links
	 *
	 * @since 0.7
	 * @return array
	 */
	public function plugin_action_links( $links ) {
		$links[] = '<a href="' . get_admin_url( null, 'options-general.php?page=' . str_replace( 'settings_page_', '', $this->_pagehook ) ) . '">' . __( 'Settings', 'gpaisr' ) . '</a>';
		$links[] = '<a href="http://wp-buddy.com/products/" target="_blank">' . __( 'More Plugins by WPBuddy', 'gpaisr' ) . '</a>';
		return $links;
	}


	/**
	 * Outputs the metabox content for the links
	 * @since 0.7
	 * @return void
	 */
	public function metabox_links() {
		?>
		<ul>
			<li>
				<a href="http://wordpress.org/extend/plugins/google-author-information-in-search-results-wordpress-plugin/installation/" target="_blank"><?php echo __( 'Installation manual', 'gpaisr' ); ?></a>
			</li>
			<li>
				<a href="http://wordpress.org/support/plugin/google-author-information-in-search-results-wordpress-plugin" target="_blank"><?php echo __( 'Support forum', 'gpaisr' ); ?></a>
			</li>
			<li>
				<a href="http://wordpress.org/extend/plugins/google-author-information-in-search-results-wordpress-plugin/changelog/" target="_blank"><?php echo __( 'Changelog', 'gpaisr' ); ?></a>
			</li>
			<li><a href="http://bit.ly/ZaaM8S" target="_blank"><?php echo __( 'Get the full version', 'gpaisr' ); ?></a></li>
			<li><a href="http://bit.ly/UlDG4t" target="_blank"><?php echo __( 'More cool stuff by WPBuddy', 'gpaisr' ); ?></a>
			</li>
		</ul>
	<?php
	}
}


