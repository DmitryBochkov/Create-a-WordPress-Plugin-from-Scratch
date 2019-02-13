<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class WidgetController extends BaseController
{
  public $callbacks;
  public $subpages = array();

  public function register() {
    $option = get_option( 'mu_plugin' );
    $activated = isset( $option['media_widget'] ) ? $option['media_widget'] : false;

    if ( !$activated ) {
      return;
    }

    $this->settings = new SettingsApi();
    $this->callbacks = new AdminCallbacks();
    $this->setSubPages();
    $this->settings->addSubPages( $this->subpages )->register();
  }

  public function setSubPages()
  {
    $this->subpages = array(
      array(
        'parent_slug' => 'mu_plugin',
        'page_title' =>  'Media Widget',
        'menu_title' => 'Widget Manager',
        'capability' => 'manage_options',
        'menu_slug' => 'mu_plugin_widgets',
        'callback' => array( $this->callbacks, 'adminWidgets' )
      ),
    );
  }

}
