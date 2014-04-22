<?php

/*
 * * * * * * * * * * * * * * * * * * *
 * 		  Shows the settings
 * * * * * * * * * * * * * * * * * * *
 */

class GPAISRSettings {
	
	function __construct(){
		// Creates the menu
		add_action ('admin_menu', array($this, 'menu'));
		
		// Creates the settings
		add_action('admin_init', array($this, 'settings') );
	}
	
	/*
	 * This will ad the settings menu
	 */
	public function menu($id){
		add_options_page(__('Google Plus Author', 'gpaisr'), __('Google Plus Author', 'gpaisr'), 'administrator', 'gpaisr', array($this, 'settings_page'));
	}
	
	public function settings_page(){
		require_once('page.settings.php');
	}
	
	/**
	 * This will add some setting fields
	 */
	function settings(){

		register_setting('gpaisr_options_group', 'gpaisr');
		
		add_settings_section('gpaisr_section_text', '', array($this, 'sectionText'), 'gpaisr');
		
		add_settings_field('gpaisr_replace_author_link', __('Replace author link with the Google Profile URL?', 'gpaisr'), array($this, 'field_replacement'), 'gpaisr', 'gpaisr_section_text');
		
		add_settings_field('gpaisr_hide_author_link_in_content', __('Show or hide the link in the content-section?', 'gpaisr'), array($this, 'field_hide'), 'gpaisr', 'gpaisr_section_text');
		
		add_settings_field('gpaisr_open_in_new_window', __('Open the link in a new window?', 'gpaisr'), array($this, 'field_new_window'), 'gpaisr', 'gpaisr_section_text');
		
		add_settings_field('gpaisr_link_text', __('Link text', 'gpaisr'), array($this, 'field_link_text'), 'gpaisr', 'gpaisr_section_text');
	}
	
	function sectionText(){
		echo '<p>'.__('Not every theme shows the Author-Link right beside a page or an article. In this case activate the link to be included after the content.', 'gpaisr');
	}
	
	function field_replacement(){
		$options = get_option('gpaisr');
		echo "<input ".(($options['replacement'] == 1) ? 'checked="checked"' : '')." id='gpaisr_replace_author_link_1' name='gpaisr[replacement]' type='radio' value='1' /> ".__('Yes');
		echo "<br /><input ".((empty($options['replacement'])) ? 'checked="checked"' : '')." id='gpaisr_replace_author_link_0' name='gpaisr[replacement]' type='radio' value='0' /> ".__('No').'. '.__('Instead show it in the content-area (see below)', 'gpaisr');
	}
	
	function field_hide(){
		$options = get_option('gpaisr');
		echo "<input ".(($options['hide'] == 1) ? 'checked="checked"' : '')." id='gpaisr_replace_hide_1' name='gpaisr[hide]'  type='radio' value='1' /> ".__('Hide') ." <small>(".__('Only applied when link is displayed after the content', 'gpaisr').')</small>';
		echo "<br /><input ".((empty($options['hide'])) ? 'checked="checked"' : '')." id='gpaisr_replace_hide_0' name='gpaisr[hide]'  type='radio' value='0' /> ".__('Show');
	}
	
	function field_new_window(){
		$options = get_option('gpaisr');
		echo "<input ".(($options['new_window'] == 1) ? 'checked="checked"' : '')." id='gpaisr_new_window' name='gpaisr[new_window]'  type='checkbox' value='1' /> <small>(".__('Only applied when link is displayed after the content', 'gpaisr').')</small>';
	}
	
	function field_link_text(){
		$options = get_option('gpaisr');
		echo "<input id='gpaisr_link_text' name='gpaisr[link_text]' size='40' type='text' value='".((empty($options['link_text'])) ? 'Google+' : $options['link_text'])."' /> <small>(".__('Only applied when link is displayed after the content', 'gpaisr').')</small>';
	}
}