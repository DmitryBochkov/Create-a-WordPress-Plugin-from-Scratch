<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class LoginController extends BaseController
{
  public $callbacks;
  public $subpages = array();

  public function register()
  {
    if ( !$this->activated( 'login_manager' ) ) {
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
        'page_title' =>  'Login Manager',
        'menu_title' => 'Login Manager',
        'capability' => 'manage_options',
        'menu_slug' => 'mu_plugin_login',
        'callback' => array( $this->callbacks, 'adminLogin' )
      ),
    );
  }

}
