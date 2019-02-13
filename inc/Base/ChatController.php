<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class ChatController extends BaseController
{
  public $callbacks;
  public $subpages = array();

  public function register() {
    $option = get_option( 'mu_plugin' );
    $activated = isset( $option['chat_manager'] ) ? $option['chat_manager'] : false;

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
        'page_title' =>  'Chat Manager',
        'menu_title' => 'Chat Manager',
        'capability' => 'manage_options',
        'menu_slug' => 'mu_plugin_chat',
        'callback' => array( $this->callbacks, 'adminChat' )
      ),
    );
  }

}
