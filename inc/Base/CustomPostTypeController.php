<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class CustomPostTypeController extends BaseController
{
  public $callbacks;
  public $subpages = array();

  public function register() {
    $option = get_option( 'mu_plugin' );
    $activated = isset( $option['cpt_manager'] ) ? $option['cpt_manager'] : false;

    if ( !$activated ) {
      return;
    }

    $this->settings = new SettingsApi();
    $this->callbacks = new AdminCallbacks();
    $this->setSubPages();
    $this->settings->addSubPages( $this->subpages )->register();

    add_action( 'init', array( $this, 'activate') );
  }

  public function setSubPages()
  {
    $this->subpages = array(
      array(
        'parent_slug' => 'mu_plugin',
        'page_title' =>  'Custom Post Types',
        'menu_title' => 'CPT Manager',
        'capability' => 'manage_options',
        'menu_slug' => 'mu_plugin_cpt',
        'callback' => array( $this->callbacks, 'adminCPT' )
      ),
    );
  }

  public function activate() {
    $args = array(
      'labels' => array(
        'name' => 'Procucts',
        'singular_name' => 'Procuct',
      ),
      'public' => true,
      'has_archive' => true,
    );
    register_post_type( 'mup_product', $args );
  }

}
