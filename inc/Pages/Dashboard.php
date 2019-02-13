<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController
{
  public $settings;
  public $callbacks;
  public $callbacks_mngr;
  public $pages = array();
  // public $subpages = array();

  public function register()
  {
    $this->settings = new SettingsApi();
    $this->callbacks = new AdminCallbacks();
    $this->callbacks_mngr = new ManagerCallbacks();
    $this->setPages();
    // $this->setSubPages();

    $this->setSettings();
    $this->setSections();
    $this->setFields();

    $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();
  }

  public function setPages()
  {
    $this->pages = array(
      array(
        'page_title' => 'My Universal Plugin',
        'menu_title' => 'MU Plugin',
        'capability' => 'manage_options',
        'menu_slug' => 'mu_plugin',
        'callback' => array( $this->callbacks, 'adminDashboard' ),
        'icon_url' => 'dashicons-store',
        'position' => 110
      )
    );
  }

  // public function setSubPages()
  // {
  //   $this->subpages = array(
  //     array(
  //       'parent_slug' => 'mu_plugin',
  //       'page_title' =>  'Custom Post Types',
  //       'menu_title' => 'CPT',
  //       'capability' => 'manage_options',
  //       'menu_slug' => 'mu_plugin_cpt',
  //       'callback' => array( $this->callbacks, 'adminCPT' )
  //     ),
  //     array(
  //       'parent_slug' => 'mu_plugin',
  //       'page_title' =>  'Custom Widgets',
  //       'menu_title' => 'Widgets',
  //       'capability' => 'manage_options',
  //       'menu_slug' => 'mu_plugin_widgets',
  //       'callback' => array( $this->callbacks, 'adminWidgets' )
  //     ),
  //   );
  // }

  public function setSettings()
  {
    $args = array(
      array(
        'option_group' => 'mu_plugin_settings',
        'option_name' => 'mu_plugin',
        'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
      )
    );

    $this->settings->setSettings( $args );
  }

  public function setSections()
  {
    $args = array(
      array(
        'id' => 'mup_admin_index',
        'title' => 'Settings Manager',
        'callback' => array( $this->callbacks_mngr, 'AdminSectionManager' ),
        'page' => 'mu_plugin',
      )
    );

    $this->settings->setSections( $args );
  }

  public function setFields()
  {
    $args = array();

    foreach ($this->managers as $key => $value) {
      $args[] = array(
        'id' => $key,
        'title' => $value,
        'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
        'page' => 'mu_plugin',
        'section' => 'mup_admin_index',
        'args' => array(
          'option_name' => 'mu_plugin',
          'label_for' => $key,
          'class' => 'ui-toggle',
        )
      );
    }

    $this->settings->setFields( $args );
  }

}
