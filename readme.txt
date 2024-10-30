=== Plugin Name ===
Contributors: samwilson
Donate link: https://www.bushheritage.org.au/getting_involved/getting_involved_donate
Tags: images, image, slideshows, slideshow, slides, banner, ad, advert, advertisment, rotate, rotator, loop, flick, light, table
Requires at least: 2.3
Tested up to: 2.7.1
Stable tag: 0.4

Display a mini-slideshow anywhere on your site.  Good for banner advertisments
or a looping display of your favorite photographs in the sidebar, etc.

== Description ==

The Image Flicker plugin allows you to embed a changing image anywhere in your site.  Rotate through a different banner advertisment every ten seconds, for example, or maybe have a little box in your sidebar that flicks through a selection of your best photographs.  The speed at which the images flick is adjustable, as is the number of images.  Each image can be linked to anywhere, and/or given a description which will appear with each image as it is flicked through.

Image display is determined by you: just change the style properties for the element `#image_flicker` in your stylesheet.

== Installation ==

1. Upload the `image-flicker` directory (or just the `image-flicker.php` file) to your `/wp-content/plugins/` directory;
2. Activate the plugin through the 'Plugins' menu in WordPress;
3. Place `<div id="image_flicker"></div>` (or other element with the ID of `image_flicker`) in your templates (e.g. `sidebar.php` or `header.php`) where you want the image flicker to be.
4. Set the images' details and flicking frequency in 'Tools > Image Flicker'.

== Screenshots ==

Have a look at this plugin in action at the author's site: http://samwilson.id.au/

== Frequently Asked Questions ==

= This doesn't work! =

Please file any bug reports on the latest release post at
http://samwilson.id.au/blog/plugins/image-flicker

= Can this plugin handle mulitple, different, slideshows? =

No, not at the moment, sorry.  You could always ask for this feature if it's really important to you!

= How can I make the description display below the image in the sidebar, and get rid of the underline from the link? =

Try the following CSS in your theme's `style.css` file:

`
#image_flicker {text-align:center}
#image_flicker img {display:block; margin:auto}
#image_flicker a {text-decoration:none}
`