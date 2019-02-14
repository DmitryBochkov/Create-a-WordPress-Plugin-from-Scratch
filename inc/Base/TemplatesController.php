<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class TemplatesController extends BaseController
{
  public $callbacks;
  public $subpages = array();

  public function register()
  {
    if ( !$this->activated( 'templates_manager' ) ) {
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
        'page_title' =>  'Templates Manager',
        'menu_title' => 'Templates Manager',
        'capability' => 'manage_options',
        'menu_slug' => 'mu_plugin_templates',
        'callback' => array( $this->callbacks, 'adminTemplates' )
      ),
    );
  }

}
