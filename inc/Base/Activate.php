<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Base;

class Activate
{
  public static function activate() {
    flush_rewrite_rules();

    if ( get_option( 'mu_plugin' ) ) {
      return;
    }

    $default = array();

    update_option( 'mu_plugin', $default );
  }
}
