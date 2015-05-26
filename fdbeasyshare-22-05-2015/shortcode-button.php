<?php
	class fdbiframe_shortcode{
		public $shortcode_tag = 'fdb_iframe';
 
		function __construct($args = array()){
			add_shortcode( $this->shortcode_tag, array( $this, 'shortcode_handler' ) );
			if ( is_admin() ){
				add_action('admin_head', array( $this, 'admin_head') );
				add_action( 'admin_enqueue_scripts', array($this , 'admin_enqueue_scripts' ) );
			}
		}
 
		function shortcode_handler($atts , $content = null){
			extract( shortcode_atts(
				array(
					'shortcode' => 'no',
					'height' => 'no',
					'width' => 'no',
					'type' => 'default',
					'type' => 'default',
					'type' => 'default',
				), 
			$atts )
        );
 
		$panel_types = array('primary','success','info','warning','danger','default');
			$type = in_array($type, $panel_types)? $type: 'default';
 
			$output = '<div class="panel panel-'.$type.'">';
 
			if ('no' != $shortcode)
				$output .= '
					<!-- start #Feedbackstr Widget -->
					<script type="text/javascript" id="feedback-fillout-iframe" src="https://www.feedbackstr.com/legacy/js/feedback-iframe-widget.js"></script>
					<script type="text/javascript">
						if (typeof(FeedbackFilloutWidget) !== "undefined") {
							FeedbackFilloutWidget.init({ url: "' . $shortcode . '", w: "'. $width  .'", h: "'. $height  .'" });
						} 
					</script>
					<!-- end #Feedbackstr Widget -->';
					
					return $output;
		}
 
		function admin_head() {
			if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
				return;
			}
 
			if ( 'true' == get_user_option( 'rich_editing' ) ) {
				add_filter( 'mce_external_plugins', array( $this ,'mce_external_plugins' ) );
				add_filter( 'mce_buttons', array($this, 'mce_buttons' ) );
			}
		}
		
			function mce_external_plugins( $plugin_array ) {
			$plugin_array[$this->shortcode_tag] = plugins_url( __('js/shortcode-button.js' , 'fdbeasyshare') , __FILE__ );
			return $plugin_array;
		}
 
		function mce_buttons( $buttons ) {
			array_push( $buttons, $this->shortcode_tag );
			return $buttons;
		}
    
		function admin_enqueue_scripts(){
			wp_enqueue_style('fdb_iframe_shortcode', plugins_url( 'css/fdb-shortcode-button.css' , __FILE__ ) );
		}
}
 
new fdbiframe_shortcode();

?>