<?php
/*
Plugin Name: Google Plus Author Information in Search Result (GPAISR)
Plugin URI: http://social2business.com/google-author-information-in-search-results-wordpress-plugin
Description: Replaces the author link with your Google+ Profile Link or adds the Special Link in your blogpost
Version: 0.2
Author: Florian Simeth
Author URI: http://hangout-lifestyle.de
License: GPL2
*/

/*  Copyright 2012  Florian Simeth  (email : florian.simeth@online.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// what's the path?
$gpX = plugin_dir_path(__FILE__);

// loads the translation file
require_once($gpX.'class.translation.php');
$gpTranslation = new GPAISRTranslation();

// this hooks in the fields in the profile page and the save-functions
require_once($gpX.'class.profile.php');
$gpProfile = new GPAISRProfile();

require_once($gpX.'class.settings.php');
$gpSettings = new GPAISRSettings();

// this hooks in the filter to show the author link
require_once($gpX.'class.filter.php');
$gpFilter = new GPAISRFilter();


