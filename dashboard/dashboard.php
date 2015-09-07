<?php
	// ### Add formular functions
	function easyshare() {
		add_option( 'fdbac_link', '' );
			if ( $key == $fdbac_link ) {
				echo "$value"; 
			}
		add_option( 'fdbac_color', '' );
			if ( $key == $fdbac_color ) {
				echo "$value"; 
			}
		add_option( 'fdbac_position', '' );
			if ( $key == $fdbac_position ) {
				echo "$value"; 
			}
		add_option( 'fdbac_display', '' );
			if ( $key == $fdbac_display ) {
				echo "$value"; 
			}
		add_option( 'fdbac_activation' , '');
			if ( $key == $fdbac_activation ) {
				echo "$value"; 
			}
		$fdbac_activation = get_option('fdbac_activation');
			if ('insert' == $_POST['action_activation']) {
				update_option( 'fdbac_activation', esc_html( $_POST['fdbac_activation'] ) );
			}
			
		$fdbac_link = get_option('fdbac_link');
			if ('insert' == $_POST['action_link']) {
				update_option( 'fdbac_link', esc_html( $_POST['fdbac_link'] ) );
			}
		$fdbac_color = get_option('fdbac_color');
			if ('insert' == $_POST['action_color']) {
				update_option( 'fdbac_color', esc_html( $_POST['fdbac_color'] ) );
			}
		$fdbac_position = get_option('fdbac_position');
			if ('insert' == $_POST['action_position']) {
				update_option( 'fdbac_position', esc_html( $_POST['fdbac_position'] ) );
			}
		$fdbac_display = get_option('fdbac_display');
			if ('insert' == $_POST['action_display']) {
				update_option( 'fdbac_display', esc_html( $_POST['fdbac_display'] ) );
			}
	// ### Importing the plugin header		
	require("header.php"); 
?>
<style>
.slideThree:after {content: '<?php _e('OFF' , 'fdbeasyshare') ; ?>';}
.slideThree:before {content: '<?php _e('ON' , 'fdbeasyshare') ; ?>';}
</style>
<div class="fdb-infobox">
	<h3><?php _e('Welcome to Feedbackstr easyShare.','fdbeasyshare') ;?></h3> 
	
</div>

<div class="fdb-panel">
	<form name="fdbac" method="post" action="<?=$location ?>">
		
		<!-- ### Add the survey shortkey to form ### -->
		<div class="fdb-option">
			<?php echo '<img class="options-ico"  src="' . plugins_url( 'images/ico_link.svg', __FILE__ ) . '" > '; ?>
			<div class="desc">
				<h4><?php _e('Surveys short URL', 'fdbeasyshare') ;?></h4>
				<h5><?php _e('Please enter your surveys short URL.', 'fdbeasyshare') ;?></h5>
			</div>
			<input name="fdbac_link" placeholder='http://www.fdb.ac/shortlink' value="<?php echo get_option('fdbac_link'); ?>" type="text" />
		</div>
		
		<!-- ### Add the tab style option to form ### -->
		<div class="fdb-option">	
			<?php echo '<img class="options-ico"  src="' . plugins_url( 'images/ico_design.svg', __FILE__ ) . '" > '; ?>
			<div class="desc">
				<h4><?php _e('Tab Style','fdbeasyshare') ;?></h4>
				<h5><?php _e('On which side should your tab be displayed?','fdbeasyshare') ;?></h5>
			</div>
			<select class="fdb" name="fdbac_position"> 
				<option class="selected" value="<?php echo get_option('fdbac_position'); ?>">
					<?php 
						if (get_option('fdbac_position') == 'Left') 
							{ _e('Left','fdbeasyshare') ; } 
						else if  (get_option('fdbac_position') == 'Right') 
							{ _e('Right','fdbeasyshare') ; } 
					?>
				</option>
				<option value="Left"><?php _e('Left','fdbeasyshare') ;?></option>
				<option value="Right"><?php _e('Right','fdbeasyshare') ;?></option>
			</select> 
		</div>
	
		<div class="fdb-option">	
			<?php echo '<img class="options-ico"  src="' . plugins_url( 'images/ico_open.svg', __FILE__ ) . '" > '; ?>
			<div class="desc">
				<h4><?php _e('Open','fdbeasyshare') ;?></h4>
				<h5><?php _e('How should the website open after clicking on the tab?','fdbeasyshare') ;?></h5>
			</div>
				
			
			
			<select class="fdb" name="fdbac_display"> 
				<option class="selected" value="<?php echo get_option('fdbac_display'); ?>" selected="selected">
					<?php 
						if (get_option('fdbac_display') == 'sliding') 
								{ _e('sliding','fdbeasyshare') ; } 
						else if  (get_option('fdbac_display') == 'fullpage') 
								{ _e('fullpage','fdbeasyshare') ; } 
						else if  (get_option('fdbac_display') == 'window') 
							{ _e('window','fdbeasyshare') ; } 
				?>
					
				</option>
				<option value="sliding"> <?php _e('sliding','fdbeasyshare') ;?> </option>
				<option value="fullpage"> <?php _e('fullpage','fdbeasyshare') ;?> </option>
				<option value="window" > <?php _e('window','fdbeasyshare') ;?> </option>
				
				<input name="action_link" value="insert" type="hidden" />
				<input name="action_activation" value="insert" type="hidden" />
				<input name="action_position" value="insert" type="hidden" />
				<input name="action_display" value="insert" type="hidden" />
			
			</select> 
		</div>
		
		<div class="fdb-option">	
			<?php echo '<img class="options-ico"  src="' . plugins_url( 'images/ico_color.svg', __FILE__ ) . '" > '; ?>
			<div class="desc">
				<h4><?php _e('Select tab color','fdbeasyshare') ;?></h4>
				<h5><?php _e('Which color should the tab have?','fdbeasyshare') ;?></h5>
			</div>
			<input class="my-color-field" name="fdbac_color" value="<?php echo get_option('fdbac_color'); ?>" type="text" />
			<input name="action_color" value="insert" type="hidden" />
		</div>			
		
<div class="slideThree">	



	<input type="checkbox" name="fdbac_activation" value="activated" id="slideThree" <?php 	if (get_option('fdbac_activation') == 'activated') { _e('checked','fdbeasyshare') ; }; ?> />
	<label for="slideThree"><?php _e('show sidetab' , 'fdbeasyshare'); ?></label>
	
</div>


		<input type="submit" value="<?php _e('Save Settings','fdbeasyshare') ;?>" />
	</form>		
				
	<div style="float: right; margin-right: 25px;margin-bottom: 20px;">	
	</div>
</div>
	
<?php require("footer.php"); 
	}
	
	function fdbeasyShare() {
		add_menu_page('Feedbackstr easyShare', 'Feedbackstr', 10, __FILE__, 'easyshare', plugin_dir_url( __FILE__ ) . 'images/wp_icon_4c.ico');
	}
		add_action('admin_menu', 'fdbeasyShare');
		add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
	
	function mw_enqueue_color_picker( $hook_suffix ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'my-script-handle', plugins_url('js/my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	};