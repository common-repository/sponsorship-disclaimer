<?php
/**
 * Plugin Name: Sponsorship Disclaimer
 * Plugin URI: http://geekwithstyle.ca
 * Description: This plugin creates shortcode [sponsor] to apply a default sponsored article disclaimer where needed in a blog post. Also includes a quick action button in WP's Text Editor. Simply type out the sponsor's name, select/highlight the text, then press the [$!] button in your Visual Editor.
 * Version: 1.0.0
 * Author: Aeryn Lynne
 * Author URI: http://geekwithstyle.ca
 * License: GPL2
 */
 
// Blogger Sponsor Disclaimer Shortcode
function blgr_disclm_sc( $atts, $blgrsponname = null ) {
	return '<i>Disclaimer: This post was sponsored by ' . $blgrsponname . ' in a partnership with '. get_bloginfo('name') .' to provide you the most up to date information. All opinions are my own.</i>';
}
add_shortcode( 'sponsor', 'blgr_disclm_sc' );


// Create Editor Button for Sponsor Shortcode

function enqueue_plugin_scripts($sponplg_array)
{
    //enqueue TinyMCE plugin script with its ID.
    $sponplg_array["disc_spon_plugin"] =  plugin_dir_url(__FILE__) . "js/sponbutton.js";
    return $sponplg_array;
}

add_filter("mce_external_plugins", "enqueue_plugin_scripts");

function register_buttons_editor($spnsrbutton)
{
    //register buttons with their id.
    array_push($spnsrbutton, "disclaimer");
    return $spnsrbutton;
}

add_filter("mce_buttons", "register_buttons_editor");

// Add Blog Name to Disclaim
wp_register_script('sponbutton-js',WP_PLUGIN_URL.'/js/sponbutton.js',array(),NULL,true);
wp_enqueue_script('sponbutton-js');

$blg_name = array( 'name' => get_bloginfo('name') );
wp_localize_script( 'sponbutton-js', 'blg_name', $blg_name );

// Text Editor Sponsor Button

// add more buttons to the html editor
function spon_quicktags() {
    if (wp_script_is('quicktags')){
?>
    <script type="text/javascript">
    QTags.addButton( 'sponsor', 'Sponsor', '[sponsor]', '[/sponsor]' );
    </script>
<?php
    }
}
add_action( 'admin_print_footer_scripts', 'spon_quicktags' );