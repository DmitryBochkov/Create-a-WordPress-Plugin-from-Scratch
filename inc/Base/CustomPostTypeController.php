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
  public $custom_post_types = array();

  public function register()
  {
    if ( !$this->activated( 'cpt_manager' ) ) {
      return;
    }

    $this->settings = new SettingsApi();
    $this->callbacks = new AdminCallbacks();
    $this->setSubPages();
    $this->settings->addSubPages( $this->subpages )->register();

    $this->storeCustomPostTypes();

    if ( !empty( $this->custom_post_types ) ) {
      add_action( 'init', array( $this, 'registerCustomPostTypes') );
    }

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

  public function storeCustomPostTypes()
  {
    $this->custom_post_types = array(
      array(
        'post_type' => 'mup_product',
        'name' => 'Products',
        'singular_name' => 'Product',
        'public' => true,
        'has_archive' => true,
      ),
    );
  }

  public function registerCustomPostTypes()
  {
    foreach ($this->custom_post_types as $post_type) {
      register_post_type( $post_type['post_type'],
        array(
          'labels' => array(
            'name' => $post_type['name'],
            'singular_name' => $post_type['singular_name'],
          ),
          'public' => $post_type['public'],
          'has_archive' => $post_type['has_archive'],
        )
      );
    }
  }

}
