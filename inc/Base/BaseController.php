<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Base;

class BaseController
{
  public $plugin_path;
  public $plugin_url;
  public $plugin_basename;
  public $managers = array();

  public function __construct() {
    $this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
    $this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
    $this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/my-universal-plugin.php';

    $this->managers = array(
      'cpt_manager',
      'taxonomy_manager',
      'media_widget',
      'gallery_manager',
      'testimonial_manager',
      'templates_manager',
      'login_manager',
      'membership_manager',
      'chat_manager',
    );
  }
}
