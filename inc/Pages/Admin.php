<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Pages;
use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController
{
  public $settings;
  public $pages = array();
  public function __construct()
  {
    $this->settings = new SettingsApi();
    $this->pages = array(
      array(
        'page_title' => 'My Universal Plugin',
        'menu_title' => 'MU Plugin',
        'capability' => 'manage_options',
        'menu_slug' => 'mu_plugin',
        'callback' => function () { echo "<h1>My Universal Plugin</h1>"; },
        'icon_url' => 'dashicons-store',
        'position' => 110
      )
    );
  }

  public function register()
  {
    $this->settings->addPages( $this->pages )->register();
  }

}
