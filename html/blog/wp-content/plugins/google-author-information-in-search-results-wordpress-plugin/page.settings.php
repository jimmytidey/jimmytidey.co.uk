<?php
$lastPostPermalink = get_bloginfo('siteurl');
query_posts('showposts=1&post_status=publish');
while (have_posts()) : the_post();
	$lastPostPermalink = get_permalink();
endwhile;
?>
<script type="text/javascript">
/* <![CDATA[ */
    (function() {
        var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'http://api.flattr.com/js/0.6/load.js?mode=auto';
        t.parentNode.insertBefore(s, t);
    })();
/* ]]> */</script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<style>
#gplisting li {
	margin-bottom: 20px;
}
</style>
<div class="wrap">

	<div class="icon32" id="icon-options-general"><br /></div>
	<h2><?php echo __('Google Plus Author Information in Search Result (GPAISR)') ?></h2><br />
	
	<div id="poststuff" class="metabox-holder has-right-sidebar">
	
		<div id="post-body-content" class="has-sidebar-content" style="float: left; width: auto!important;" >
			<div class="postbox">
				<h3><label for=""><?php echo __('General'); ?></label></h3>
				<div class="inside">
				<?php	
					echo '<p>'. __('This plugin will replace your author link in your template with your Google+ Profile link to make sure that the picture will be shown at the search results.', 'gpaisr').'</p>';
					echo '<p>'. __('Alternatively the link can be included after the content if your template does not show the author  link.', 'gpaisr').'</p>';
					?>
				</div>
			</div>
			
			<div class="postbox">
				<h3><label for=""><?php echo  __('What to do', 'gpaisr'); ?></label></h3>
				<div class="inside">
					<?php	
					echo '<ol id="gplisting">
							<li><a href="http://plus.google.com">'.__('Create a Google+ Profile', 'gpaisr').'</a></li>
							<li>'.__('Login to Google+', 'gpaisr').'</li>
							<li><a href="http://plus.google.com/me" target="_blank">'.__('Click here to open your profile', 'gpaisr').'</a></li>
							<li>'.__('Find your Google+ Profile link by visiting your own page and copy the link (shown and marked in the image below) to clipboard', 'gpaisr').'<br />
								<img  style="border: 1px solid black;" src="'.plugins_url( 'images/gplus-profile.png', __FILE__ ).'" alt="How to find the Google Plus Profile Link" /></li>
							<li>'.__('Activate this plugin.', 'gpaisr').'</li>
							<li><a href="profile.php">'.__('Go to your profile page', 'gpaisr').'</a> '.__('and paste your profile link where it says "Google Plus Link"', 'gpaisr').'. '.__('Do not add the tag "?ref=author" because that will be added automatically.', 'gpaisr').'<br />
								<img style="border: 1px solid black;" src="'.plugins_url( 'images/gplus-update-profile.png', __FILE__ ).'" alt="Add the link to your profile" />
							</li>
							<li>'.__('Go to Settings > Google Plus Author and make changes if needed (this page - see below)', 'gpaisr').'</li>
							<li><a href="'.__('http://support.google.com/webmasters/bin/answer.py?hl=en&answer=1408986', 'gpaisr').'">'.__('Follow this instructions to link your Google+ Profile with your blog.', 'gpaisr').'</a></li>
							<li>'.__('Test your site using the', 'gpaisr').' <a href="http://www.google.com/webmasters/tools/richsnippets?url='.urlencode($lastPostPermalink).'" target="_blank">Rich Snippets Testing Tool</a></li>
							<li>'.__('If you can see your profile picture everything is okay. If not, you have made something wrong.', 'gpaisr').'</li>
							<li>'.__('Note that there is no guarantee that a Rich Snippet will be shown for your page on actual search results!', 'gpaisr').'</li>
							<li><a href="http://social2business.com/google-author-information-in-search-results-wordpress-plugin" target="_blank">'.__('Go to the plugins homepage to get more information.', 'gpaisr').'</a></li>
						</ol>';
					?>
				</div>
			</div>
			
			<div class="postbox">
				<h3><label for=""><?php echo  __('Settings'); ?></label></h3>
				<div class="inside">
					<form action="options.php" method="post">
					<?php settings_fields('gpaisr_options_group'); ?>
					<?php do_settings_sections('gpaisr'); ?>
					<p class="submit"  style="float: left;">
						<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
					</p>
					</form>
					<form action="http://www.google.com/webmasters/tools/richsnippets?url=<?php echo urlencode($lastPostPermalink); ?>" method="post" target="_blank">
					<p class="submit">
						<input name="Submit" type="submit" class="button-primary" value="<?php echo __('Test the latest post or page.', 'gpaisr'); ?>" />
					</p>
					</form>
				</div>
			</div>
			
				
		</div><!-- post-body-content -->
		
		<div class="inner-sidebar" id="side-info-column" style="float:right; height: 100%; ">
			<div class="meta-box-sortables ui-sortable" id="side-sortables">
				<div class="postbox " id="linksubmitdiv">
					<div title="Zum umschalten klicken" class="handlediv"><br></div>
					<h3 class="hndle"><span><?php echo  __('Share', 'gpaisr'); ?></span></h3>
					<div class="inside">
						<p><a href="http://social2business.com/blog/google-author-information-in-search-results-wordpress-plugin/" target="_blank"><?php echo __('Go to the plugins page', 'gpaisr'); ?></a></p>
					
						<!-- Flattr Button -->
						<p><a class="FlattrButton" style="display:none;" rev="flattr;button:compact;" href="http://social2business.com/blog/google-author-information-in-search-results-wordpress-plugin/"></a>
						<noscript><a href="http://flattr.com/thing/669124/Google-Author-Information-in-Search-Results-WordPress-Plugin" target="_blank"><img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a></noscript></p>
						
						<!-- Twitter-Button -->
						<p><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://social2business.com/blog/google-author-information-in-search-results-wordpress-plugin/" data-via="floriansimeth">Tweet</a></p>

						<!-- Google+ Button -->
						<p><g:plusone size="medium" annotation="inline" width="230" href="http://social2business.com/blog/google-author-information-in-search-results-wordpress-plugin/"></g:plusone></p>
						
						<!-- Facebook button -->
						<p><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fsocial2business.com%2Fblog%2Fgoogle-author-information-in-search-results-wordpress-plugin%2F&amp;send=false&amp;layout=standard&amp;width=230&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:230px; height:80px;" allowTransparency="true"></iframe></p>
					</div>
				</div>
			</div>
		</div>
		
	</div><!-- poststuff -->
</div><!-- wrap -->

<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>