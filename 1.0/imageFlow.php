<?php 
/*
Plugin name: ImageFlow
Plugin URI: http://www.mauriciocastillo.com
Description: Widget based in the ImageFlow javascript code.
Author: Mauricio Castillo.
Version:1.0
Author URI: http://www.mauriciocastillo.com
*/


/**********************************************
Script header opciones
***********************************************/

function script_header($option)
{
   $options = get_option($option);	
   
   ?>
   
   <script>
   	domReady(function()
{
      var basic_1 = new ImageFlow();
    basic_1.init({ 
    	ImageFlowID: <?php echo '"'.$options['iflowid'].'"' ?> ,
    	slider: <?php echo $options['slider']; ?>,
    	animationSpeed: <?php echo $options['anima_speed']; ?>,
	   	aspectRatio:  <?php echo $options['aspect_ratio']; ?>,
		  buttons: <?php echo $options['buttons']; ?>,
		  captions: <?php echo $options['caption']; ?>,
		  circular: <?php echo $options['circular']; ?>,
		  reflections: false,
		  imagesHeight:<?php echo $options['imageh']; ?>,
		  slideshowAutoplay: <?php echo $options['autoplay']; ?>,
		  slideshowSpeed: <?php echo $options['slideshowspeed']; ?>,
		  slideshow: <?php echo $options['slideshow']; ?>,		  
		  xStep:<?php echo $options['xsteps']; ?>,
		  imageFocusMax:<?php echo $options['maximages']; ?>,
		  opacity:<?php echo $options['opacity']; ?>,
		  glideToStartID:<?php echo $options['animastart']; ?>,
		  imageScaling:<?php echo $options['scale']; ?>,
		  startID: <?php echo $options['startid']; ?>
    	});
    });	 	
   </script>
   <?php 
}

/**********************************************
default options
***********************************************/

function iflow_default()
{
   $default = array(
   'iflowid' => 'iflows',
   'slider' => 'false',
   'anima_speed' => 40,
   'aspect_ratio' => 1.946,
   'buttons' => 'false',
   'caption' => 'false',
   'circular' => 'false',
   'autoplay' => 'false',
   'slideshowspeed' => 40,
   'slideshow' => 'false',
   'imagesHeight' => 0.6,
   'xsteps' => 150,
   'maximages' => 2,
   'opacity' => 'false',
   'animastart' => 1,
   'scale' => 'true',
   'links' => 'false',
   'startid' => 1
   );	
   
 return $default;
}

/**********************************************
Insertar default en la instalacion
***********************************************/
function iflow_plugin_install() {
    add_option('iflow_name', iflow_default());   
}
register_activation_hook(__FILE__,'iflow_plugin_install');
/**********************************************
Insertar scripts en cabecera
***********************************************/

function imageflow_scripts()
{
wp_enqueue_script('imageflow', WP_CONTENT_URL.'/plugins/imageflow/js/imageflow.js');	
}
add_action('wp_print_scripts', 'imageflow_scripts');

function imageflow_style()
{
wp_register_style( 'imageflow', WP_CONTENT_URL.'/plugins/imageflow/css/imageflow.css');	
wp_enqueue_style( 'imageflow');
}
add_action('wp_enqueue_scripts', 'imageflow_style');

/**********************************************
Admin css
***********************************************/

function imageflow_admin_style(){
wp_register_style( 'imageflowadmin', WP_CONTENT_URL.'/plugins/imageflow/css/imageflowadmin.css');	
wp_enqueue_style( 'imageflowadmin');
}
add_action('admin_print_styles', 'imageflow_admin_style');

/**********************************************
Admin scripts
***********************************************/

function imageflow_admin_script(){
wp_register_script( 'imageflowascripts', WP_CONTENT_URL.'/plugins/imageflow/js/imageflowascripts.js');	
wp_enqueue_script( 'imageflowascripts');
}
add_action('admin_init', 'imageflow_admin_script');

/**********************************************
Funcion para salvar las opciones
***********************************************/

function imageflow_init()
{
	register_setting('iflow_options','iflow_name','image_flow_validate');
	}
add_action('admin_init', 'imageflow_init' );

/**********************************************
Página de configuración en el administrador
***********************************************/

function image_flow_admin()
{ 

	?>
	<div class="wrap">
		<?php echo get_screen_icon(); ?>
	   <h2><?php _e('ImageFlow 1.0'); ?></h2>
	   <p><?php _e('Welcome, please set the options for your imageFlow widget.') ?></p>	
	   <div id="errors"><?php settings_errors( $setting, $sanitize, $hide_on_update ) ?> </div>
	   <div class="metabox-holder">
	   <div class="postbox-container" style="width:30%;">
	   <form method="post" action="options.php">
	  <div id="main-sortables" class="meta-box-sortables ui-sortable">
	  	
	  	
	   	<?php 
	   	settings_fields('iflow_options'); 
      $options = get_option('iflow_name');
      ?>
      <div id="imgFlowCont" class="postbox ">
      	<div title="Click to toggle" class="handlediv"><br></div>
      	<h3 class="hndle"><span><?php _e('Settings'); ?></span></h3>
      	<div class="inside">
      		<h4><?php _e('General settings');?></h4>
      		<ul class="clear flists">
      		    <li>
      		    	<label class="fleft"><?php _e('Name of slide:');?></label>
	       	      <input class="fleft" name="iflow_name[iflowid]" type="text" readonly=readonly value="<?php echo $options['iflowid'] ?>" />
	       	      <a href="#" class="quest">?</a>
	       	      <span><?php _e('Readonly... for now'); ?></span>
      		    </li>	
      		    <li>
			       	  <label class="fleft"><?php _e('Animation Speed:');?></label>
			       	  <input class="fleft" name="iflow_name[anima_speed]" type="text" value="<?php echo $options['anima_speed'] ?>" />
			       	  <a href="#" class="quest">?</a>
			       	  <span><?php _e('Lower number, Faster fx'); ?></span>
			       	</li>
			       	<li>
			       	  <label class="fleft"><?php _e('Aspect Ratio:');?></label>
			       	  <input class="fleft" name="iflow_name[aspect_ratio]" type="text" value="<?php echo $options['aspect_ratio'] ?>" />
			       	  <a href="#" class="quest">?</a>
			       	  <span><?php _e('width / Height = this number'); ?></span>
			       	</li>
			       	
			       	<li>
			       	 <label class="fleft"><?php _e('Max. image view:');?></label>
			       	 <input class="fleft" name="iflow_name[maximages]" type="text" value="<?php echo $options['maximages'] ?>" />
			       	 <a href="#" class="quest">?</a>
			       	 <span><?php _e('Maximum number of images on each side of the focussed one'); ?></span>
			       	</li>
			       	<li>
			       	 <label class="fleft"><?php _e('Start image:');?></label>
			       	 <input class="fleft" name="iflow_name[startid]" type="text" value="<?php echo $options['startid'] ?>" />
			       	 <a href="#" class="quest">?</a>
			       	 <span><?php _e('Image number to start.'); ?></span>
			       	</li>
			       	<li>
			       	  <label class="fleft"><?php _e('Height container:');?></label>
			       	  <input class="fleft" name="iflow_name[imageh]" type="text" value="<?php echo $options['imageh'] ?>" />
			       	  <a href="#" class="quest">?</a>
			       	  <span><?php _e('Height of the images div container in percent'); ?></span>
			       	</li>
			       	<li>
			       	   <label><?php _e('Link:');?></label>	
			       	   <select name="iflow_name[links]">
			       	      <option value="false" <?php selected( 'false', $options['links']); ?>>No</option>	
			       	      <option value="true" <?php selected( 'true', $options['links']); ?>>Yes</option>
			       	   </select>
			       	   <a href="#" class="quest">?</a>
			       	   <span><?php _e('Link on focus image'); ?></span>
			       	</li>
			       	
			       
	       	<li>
	       	   <label><?php _e('Caption:');?></label>	
	       	   <select name="iflow_name[caption]">
	       	      <option value="false" <?php selected( 'false', $options['caption']); ?>>No</option>	
	       	      <option value="true" <?php selected( 'true', $options['caption']); ?>>Yes</option>
	       	   </select>
	       	   <a href="#" class="quest">?</a>
	       	   <span><?php _e('Image caption'); ?></span>
	       	</li>
	       	<li>
	       	   <label><?php _e('Circular:');?></label>	
	       	   <select name="iflow_name[circular]">
	       	      <option value="false" <?php selected( 'false', $options['circular']); ?>>No</option>	
	       	      <option value="true" <?php selected( 'true', $options['circular']); ?>>Yes</option>
	       	   </select>
	       	   <a href="#" class="quest">?</a>
	       	   <span><?php _e('Endless slide'); ?></span>
	       	</li>
	       	<li>
	       	   <label><?php _e('Opacity:');?></label>	
	       	   <select name="iflow_name[opacity]">
	       	      <option value="false" <?php selected( 'false', $options['opacity']); ?>>No</option>	
	       	      <option value="true" <?php selected( 'true', $options['opacity']); ?>>Yes</option>
	       	   </select>
	       	   <a href="#" class="quest">?</a>
	       	   <span><?php _e('Image Opacity'); ?></span>
	       	</li>
	       	<li><label><?php _e('Select Category');?></label><?php wp_dropdown_categories(array('selected' => $options['imgCat'], 'name' => 'iflow_name[imgCat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("All Categories", 'iflow'), 'hide_empty' => '0' )); ?></li>
      		</ul>
      		
      		
      		<h4><?php _e('Slideshow settings');?></h4>
	   	<ul class="clear flists">
	   		<li>
			       	   <label><?php _e('Image scale:');?></label>	
			       	   <select name="iflow_name[scale]">
			       	   	  <option value="true" <?php selected( 'true', $options['scale']); ?>>Yes</option>
			       	      <option value="false" <?php selected( 'false', $options['scale']); ?>>No</option>	
			       	   </select>
			       	   <a href="#" class="quest">?</a>
			       	   <span><?php _e('Scale images'); ?></span>
			       	</li>
	   		  <li>
			       	 <label class="fleft"><?php _e('X steps:');?></label>
			       	 <input class="fleft" name="iflow_name[xsteps]" type="text" value="<?php echo $options['xsteps'] ?>" />
			       	 <a href="#" class="quest">?</a>
			       	 <span><?php _e('Space between the images'); ?></span>
			    </li>
	       <li>
	       	 <label class="fleft"><?php _e('Slide show speed:');?></label>
	       	 <input class="fleft" name="iflow_name[slideshowspeed]" type="text" value="<?php echo $options['slideshowspeed'] ?>" />
	       	 <a href="#" class="quest">?</a>
	       	 <span><?php _e('Delay time'); ?></span>
	       	</li>
	       	 <li>
			       	   <label><?php _e('Auto play:');?></label>	
			       	   <select name="iflow_name[autoplay]">
			       	      <option value="false" <?php selected( 'false', $options['autoplay']); ?>>No</option>	
			       	      <option value="true" <?php selected( 'true', $options['autoplay']); ?>>Yes</option>
			       	   </select>
			       	   <a href="#" class="quest">?</a>
			       	   <span><?php _e('Auto?, select yes and Slideshow option too'); ?></span>
			       	</li>
	       	<li>
	       	   <label><?php _e('Slideshow:');?></label>	
	       	   <select name="iflow_name[slideshow]">
	       	      <option value="false" <?php selected( 'false', $options['slideshow']); ?>>No</option>	
	       	      <option value="true" <?php selected( 'true', $options['slideshow']); ?>>Yes</option>
	       	   </select>
	       	   <a href="#" class="quest">?</a>
	       	   <span><?php _e('Add play and stop button'); ?></span>
	       	</li>
	       	
	       	<li>
	       	   <label><?php _e('Start animation:');?></label>	
	       	   <select name="iflow_name[animastart]">
	       	      <option value="false" <?php selected( 'false', $options['animastart']); ?>>No</option>	
	       	      <option value="true" <?php selected( 'true', $options['animastart']); ?>>Yes</option>
	       	   </select>
	       	   <a href="#" class="quest">?</a>
	       	   <span><?php _e('Animate the startup'); ?></span>
	       	</li>
	       		
	      </ul>
	      <h4><?php _e('Navigation settings');?></h4>
	      <ul class="clear flists">
	      <li>
	       	   <label><?php _e('buttons:');?></label>	
	       	   <select name="iflow_name[buttons]">
	       	      <option value="false" <?php selected( 'false', $options['buttons']); ?>>No</option>	
	       	      <option value="true" <?php selected( 'true', $options['buttons']); ?>>Yes</option>
	       	   </select>
	       	   <a href="#" class="quest">?</a>
	       	   <span><?php _e('Next and previous buttons'); ?></span>
	       	  </li>
	       	<li>
	       	   <label><?php _e('Slider:');?></label>	
	       	   <select name="iflow_name[slider]">
	       	      <option value="false" <?php selected( 'false', $options['slider']); ?>>No</option>	
	       	      <option value="true" <?php selected( 'true', $options['slider']); ?>>Yes</option>
	       	   </select>
	       	   <a href="#" class="quest">?</a>
	       	   <span><?php _e('Slider bar'); ?></span>
	       	</li>
	      
	      </ul>
	      <input id="enviar-btn" type="submit" value="guardar"/>
	    </div>
	    </div>
	      </div>
	   
	   </form>
	   
	 </div><!--fin postbox-container-->
	 
		 <div class="alignright" style="width:24%;">
		    	<div id="sidebar-sortables" class="meta-box-sortables ui-sortable">
		    		    <div class="postbox " id="twitter-widget-pro-like-this">
										<div title="Click to toggle" class="handlediv"><br></div>
										<h3 class="hndle"><span>Show me the love!!!</span></h3>
										<div class="inside">
										  <p>If this plugin made your life easier, you can make my life easier too.</p>
										  <p> <strong>Also I want to marry  =P</strong></p>
										  <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
<img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
</form>

										</div>
							  </div>
		    	</div>
		 </div><!--fin alignright-->
		 
	 </div>
	</div>
<?php	}

/*
mostrar errores
*/


/**********************************************
Sanitize and validate input. Accepts an array, return a sanitized array.

  $newoptions['iflowid'] = ( $input['iflowid'] == '' ? 'iflows' : $input['iflowid'] );
	$newoptions['iflowid'] = preg_replace('/[^a-z0-9\s]/i', '', $input['iflowid']);
	$newoptions['iflowid'] = str_replace(" ", "_", $input['iflowid']);
***********************************************/
function image_flow_validate($input) {
	
  

	$input['iflowid'] = ( $input['iflowid'] == '' ? 'iflows' : $input['iflowid'] );
	
	$input['aspect_ratio'] =  ( $input['aspect_ratio'] == '' ? 1.964 : $input['aspect_ratio'] );
	$input['aspect_ratio'] =  ( !is_numeric($input['aspect_ratio']) ? 1.964 : $input['aspect_ratio'] );
	
	$input['maximages'] =  ( $input['maximages'] == '' ? 2 : $input['maximages'] );
	$input['maximages'] =  ( !is_numeric($input['maximages']) ? 2 : $input['maximages'] );
	
	$input['startid'] =  ( $input['startid'] == '' ? 1 : $input['startid'] );
	$input['startid'] =  ( !is_numeric($input['startid']) ? 1 : $input['startid'] );
	
	$input['imageh'] =  ( $input['imageh'] == '' ? 0.6 : $input['imageh'] );
	$input['imageh'] =  ( !is_numeric($input['imageh']) ? 0.6 : $input['imageh'] );
	
	$input['xsteps'] =  ( $input['xsteps'] == '' ? 150 : $input['xsteps'] );
	$input['xsteps'] =  ( !is_numeric($input['xsteps']) ? 150 : $input['xsteps'] );
	
	$input['slideshowspeed'] =  ( $input['slideshowspeed'] == '' ? 5000 : $input['slideshowspeed'] );
	$input['slideshowspeed'] =  ( !is_numeric($input['slideshowspeed']) ? 5000 : $input['slideshowspeed'] );
	
	$input['anima_speed'] = ( $input['anima_speed'] == '' ? 40 : $input['anima_speed'] );
	$input['startid'] =  ( $input['startid'] == '' ? 1 : $input['startid'] );
	
		
		return $input;

}



/**********************************************
Borrar
***********************************************/


function iflow_uninstall(){
	$options = get_option('iflow_name');
	delete_option($options);
	}
register_uninstall_hook(__FILE__,'iflow_uninstall');


/**********************************************
funcion para hacer visible el formulario de 
opciones en el area de administacion.
***********************************************/
function image_flow_menu()
{

	add_menu_page('settings ImageFlow','imageFlow', 'manage_options', 'iFlow', 'image_flow_admin', plugins_url('imageflow/img/icon.png'));
	}

add_action('admin_menu', 'image_flow_menu');


/**********************************************
imageFlow.
***********************************************/

function image_flow ($option = 'iflow_name')
{
global $post;
$options = get_option($option);
script_header($option);
$catt = $options['imgCat'];
$links = $options['links'];
$args = array('category' => $catt);
$reflejo = $options['reflex'];
;?>



<div id="<?php echo $options['iflowid'];?>" class="imageflow">
			
			<?php 
			
			
			$footer_thumbs = get_posts($args);

			if( $footer_thumbs ) {
			
			  foreach( $footer_thumbs as $footer_thumb ) {
			  	setup_postdata($footer_thumb);
			  	$u = get_permalink($footer_thumb->ID);
			  	
			  if($links == 'false'){
			    echo 	get_the_post_thumbnail($footer_thumb->ID, 'large', array('longdesc' => ''));
			  }else{
			  	echo get_the_post_thumbnail($footer_thumb->ID, 'large', array('longdesc' => $u));
			  	}
			  }
			} ?>
</div>

<?php 



	
}



//Widget CLASS

class imageFlow extends WP_Widget
{

function imageFlow()
{
	$options = get_option('iflow_name');
	$widget_options = array('classname' => 'imageFlow', 'description' => 'imageFlow Slide');
	$control_options = array('width' => 500, 'height' => 500);
	parent::WP_Widget('image_Flow', 'Image Flow', $widget_options);
	}
	
function widget($args, $instance)
{
	extract($args, EXTR_SKIP);
	$title = ($instance['title']) ? $instance['title'] : 'Image Flow';

			echo $before_widget; 
			echo $before_title . $title . $after_title ;
			
			$instance['image_flow'] = 'iflow_name';
			image_flow($instance['image_flow']);
	
	     echo $after_widget; 
	}
function update($new_instance, $old_instance) {
         $instance=$old_instance;
        /* Strip tags (if needed) and update the widget settings. */
		     $instance['title'] = strip_tags( $new_instance['title'] );
		     $instance['image_flow'] = $new_instance['image_flow'];
        return $new_instance;
	}
function form($instance)
{
	?>
	   <label for="<?php echo $this->get_field_id('title');?>"><?php _e( 'Title' ); ?>:</label>
	   <input style="width:95%;" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" value="<?php echo esc_attr($instance['title']);?>" />
	
	<?php
	
	
	}
	
}
function imageFlow_widget_init(){
	register_widget('imageFlow');
	}
add_action('widgets_init', 'imageFlow_widget_init');