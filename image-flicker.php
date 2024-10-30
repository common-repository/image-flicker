<?php
/*
Plugin Name: Image Flicker
Plugin URI: http://samwilson.id.au/blog/plugins/image-flicker
Description: Display a mini-slideshow anywhere on your site.
Version: 0.4
Author: Sam Wilson
Author URI: http://samwilson.id.au/
*/

add_action('admin_menu', 'image_flicker_add_management_page');
function image_flicker_add_management_page() {
	add_management_page('Image Flicker', 'Image Flicker', 4, 'image-flicker/image-flicker.php', 'image_flicker_manage');
}

function image_flicker_manage() {
	
	$num_images = get_option('image_flicker_num_images');
	
	if ($_POST) {
		foreach ($_POST as $key=>$val) {
			// All of the wanted form fields are prefixed with 'image_flicker'.
			if (strpos($key,'image_flicker') === 0) {
				update_option($key, $val);
			}
		}
        echo '<div id="message" class="updated fade"><p><strong>Changes saved.</strong></p></div>';
	}

	// Get these again, in case they just got changed.  (I'm sure there's a prettier way to do this.)
	$num_images = get_option('image_flicker_num_images');
	
	print '<div class="wrap"><form action="" method="post">
		   <p>Number of images:
		   <input type="text" size="3" name="image_flicker_num_images" value="'.get_option('image_flicker_num_images').'" />
		   </p><p>Delay between frames:
		   <input type="text" size="3" name="image_flicker_delay" value="'.get_option('image_flicker_delay').'" />
		   (in seconds)</p><table class="editform" width="100%" cellspacing="2" cellpadding="5">';

	for ($img=1; $img<=$num_images; $img++) {
		$src_tag = "image_flicker_src_$img";
		$desc_tag = "image_flicker_desc_$img";
		$link_tag = "image_flicker_link_$img";
		print "<tr><th colspan='3' style='text-align:left; background-color:#E5F3FF'>Image $img</th></tr>
			<tr>
			<th scope='row'><label for='$src_tag'>Image URL:</label></th>
			<td><input type='text' name='$src_tag' id='$src_tag' value='".get_option($src_tag)."' style='width: 95%' /></td>
			<td rowspan='3'><img src='".get_option($src_tag)."' /></td>
			</tr>
			<tr>
			<th width='20%' scope='row'><label for='$desc_tag'>Description:</label></th>
			<td width='80%'><input type='text' name='$desc_tag' id='$desc_tag' value='".htmlentities(stripslashes(get_option($desc_tag)),ENT_QUOTES)."' style='width: 95%' /></td>
			</tr>
			<tr>
			<th scope='row'><label for='$link_tag'>Link URL:</label></th>
			<td><input type='text' name='$link_tag' id='$link_tag' value='".get_option($link_tag)."' style='width: 95%' /></td>
			</tr>";

	} // end for ($img=1; $img<=$num_images; $img++) loop
	print "</table><p class='submit'>
		<input type='submit' name='submit' value='Save &raquo;' />
		</p></form></div>";

} // image_flicker_add_management_page()


add_action('widgets_init', 'widget_image_flicker_init');
function widget_image_flicker_init() {
  	if ( !function_exists('register_sidebar_widget') ) {
  		return;
	}
  	function widget_image_flicker($args) {
  		extract($args);
  		echo "$before_widget<div id='image_flicker'></div>$after_widget";
	}
  	register_sidebar_widget('Image Flicker', 'widget_image_flicker');
}


add_action('wp_head', 'image_flicker_wp_head');
function image_flicker_wp_head() {

	$num_images = get_option('image_flicker_num_images');
	$delay = get_option('image_flicker_delay');

	$out = '
	<script language="JavaScript" type="text/javascript">
	<!--
	
	// Courtesy of SimplytheBest.net - http://simplythebest.net/scripts/
	// Modified by Sam Wilson http://samwilson.id.au 2007-10-xx, 2009-03-16.
	
	gSlideshowInterval = '.$delay.';
	gNumberOfImages = '.$num_images.';
	
	gTheRotations = new Array(gNumberOfImages);';
	
	for ($i=1; $i<=$num_images; $i++) {
		$out .= "\n\tgTheRotations[$i] = '<a href=\"".get_option('image_flicker_link_'.$i)."\">'+\n".
		        "\t                    '<img src=\"".get_option('image_flicker_src_'.$i)."\" />'+\n".
				"\t                    '".get_option('image_flicker_desc_'.$i)."</a>';";
	}

	$out .= '
	
	function canManipulateImages() {
		if (document.images)
			return true;
		else
			return false;
	}
	
	function loadSlide(slideHtml) {
		if (gImageCapableBrowser) {
			document.getElementById("image_flicker").innerHTML = slideHtml;
			return true;
		} else {
			return false;
		}
	}
	
	function nextSlide() {
		gCurrentImage = (gCurrentImage % gNumberOfImages) + 1;
		loadSlide(gTheRotations[gCurrentImage]);
	}
	
	// Thanks to Ben Woodhead for the fix for the delayed load and incorrect
	// start image number.
	
	function init() {
		gImageCapableBrowser = canManipulateImages();
		gCurrentImage = 0;
		setInterval("nextSlide()", gSlideshowInterval*1000);
	}
	
	window.onload = init;
	
	// -->
	</script>';
	
	echo $out;

}



?>
