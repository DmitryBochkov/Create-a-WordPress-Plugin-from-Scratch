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

    if ( ! get_option( 'mu_plugin' ) ) {
			update_option( 'mu_plugin', $default );
		}

		if ( ! get_option( 'mu_plugin_cpt' ) ) {
			update_option( 'mu_plugin_cpt', $default );
		}
  }
}
