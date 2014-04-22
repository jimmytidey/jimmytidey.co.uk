<?php

/*
 * * * * * * * * * * * * * * * * * * *
 * 		  Shows the author links
 * * * * * * * * * * * * * * * * * * *
 */

class GPAISRFilter {
	
	function __construct(){
		$options = get_option('gpaisr');
		if($options['replacement'] == 1) add_filter('author_link', array($this, 'author_link_filter'), 0, 3);
		
		if($options['replacement'] != 1) {
			add_filter ( 'the_content', array($this, 'author_link_in_content'), 15);
		}
	}
	
	/**
	 * Just replaces the link with the google+ url
	 */
	function author_link_filter($link, $author_id, $author_nicename){
		$gplus_author_link = get_the_author_meta( 'gplus_link', $author_id );
		if(!empty($gplus_author_link)) return $gplus_author_link.'?rel=author';
		return $link;
	}
	
	/**
	 * Writes the Google+-URL right after the Content
	 */
	function author_link_in_content($content){
		// load the options from the settings page
		$options = get_option('gpaisr');
		
		// what's the author id?
		$authorId = get_the_author_meta('ID');
		
		// find the link
		$gplus_author_link = get_the_author_meta( 'gplus_link', $authorId );
		if(!empty($gplus_author_link)) $gplus_author_link = $gplus_author_link.'?rel=author';
		
		// open in a new window?
		$newWindow = '';
		if($options['hide'] == 1) $newWindow = 'target="_blank"';
		
		// show or hide?
		$showHide = '';
		if($options['hide'] == 1) {
			$showHide = 'style="display:none;"';
		}
		
		// is there a linktext?
		$linktext = 'Google+';
		if(!empty($options['link_text'])) $linktext = $options['link_text'];
		
		return $content .= '<a href="'.$gplus_author_link.'" '.$newWindow.' '.$showHide.'>'.$linktext.'</a>';
	}
	
}