<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Base;
use Inc\Base\BaseController;

class Enqueue extends BaseController
{
  public function register() {
    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
  }

  function enqueue() {
    wp_enqueue_style( 'myplugin-style', $this->plugin_url . 'assets/mystyle.css' );
    wp_enqueue_script( 'myplugin-script', $this->plugin_url . 'assets/myscript.js' );
  }
}
