<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Base;

class Activate
{
  public static function activate() {
    flush_rewrite_rules();

    $default = array();

    if ( ! get_option( 'alecaddd_plugin' ) ) {
			update_option( 'alecaddd_plugin', $default );
		}

		if ( ! get_option( 'alecaddd_plugin_cpt' ) ) {
			update_option( 'alecaddd_plugin_cpt', $default );
		}
  }
}
