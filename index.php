<?php
/*
Plugin Name: Feedbackstr easyShare
Plugin URI: http://feedbackstr.com/en/feedbackstr-easyshare
Description: Integrate your <a href="http://feedbackstr.com">Feedbackstr.com</a> feedback tab or your entire survey into your Wordpress page. You can also change all tab settings directly on the Wordpress administration area. 
Version: 1.0.0
Author: Spectos
Author URI: http://spectos.com
Text Domain: fdbeasyshare
Domain Path: /languages/
License: GPL3
Min WP Version: 3.8.0
Max WP Version: 4.2.2

Copyright 2014 - 2015  Spectos GmbH  (email : benjamin.sonnenschein@spectos.com)

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

require("dashboard/dashboard.php");
require("shortcode-button.php");

if (get_option('fdbac_activation') == 'activated') 
	{
		add_action('wp_footer', 'fdbackstr');
			function fdbackstr() {
				echo "	<!-- start #Feedbackstr Side Tab -->
					<script type=\"text/javascript\" src=\"https://www.feedbackstr.com/js/sidetab.js\"></script>
					<style type=\"text/css\" media=\"screen, projection\">
						@import url(https://www.feedbackstr.com/css/sidetab.css);
						#side_tab {width:47px !important; height:110px !important;}
					</style>
					<script type=\"text/javascript\">
					if (typeof(SideTab) !== \"undefined\") {
						SideTab.init(
					{ 
						assetHost : \"https://www.feedbackstr.com/\" , 
						url:\""; echo get_option('fdbac_link'); echo "\",
						tabColor: \""; echo get_option('fdbac_color'); echo "\", 
						tabPosition: \""; echo get_option('fdbac_position'); echo "\", 
						tabDisplay : \""; echo get_option('fdbac_display'); echo "\"
					}
					);
					}
				</script>
		<!-- end #Feedbackstr Side Tab -->";
			}
	}
	function add_css(){
		wp_enqueue_style( 'style', plugins_url('/style.css', __FILE__), false, '1.0.0', 'all');
	}
    
	add_action('admin_enqueue_scripts', "add_css");
	add_action( 'plugins_loaded', 'fdbeasyshare_load_textdomain' );

	function fdbeasyshare_load_textdomain() {
		load_plugin_textdomain( 'fdbeasyshare', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
