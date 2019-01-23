<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Base;

class Enqueue
{
  public function register() {
    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
  }

  function enqueue() {
    wp_enqueue_style( 'myplugin-style', PLUGIN_URL . 'assets/mystyle.css' );
    wp_enqueue_script( 'myplugin-script', PLUGIN_URL . 'assets/myscript.js' );
  }
}
