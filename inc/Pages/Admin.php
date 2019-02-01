<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
  public $settings;
  public $callbacks;
  public $pages = array();
  public $subpages = array();

  public function register()
  {
    $this->settings = new SettingsApi();
    $this->callbacks = new AdminCallbacks();
    $this->setPages();
    $this->setSubPages();

    $this->setSettings();
    $this->setSections();
    $this->setFields();

    $this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
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

  public function setSubPages()
  {
    $this->subpages = array(
      array(
        'parent_slug' => 'mu_plugin',
        'page_title' =>  'Custom Post Types',
        'menu_title' => 'CPT',
        'capability' => 'manage_options',
        'menu_slug' => 'mu_plugin_cpt',
        'callback' => array( $this->callbacks, 'adminCPT' )
      ),
      array(
        'parent_slug' => 'mu_plugin',
        'page_title' =>  'Custom Widgets',
        'menu_title' => 'Widgets',
        'capability' => 'manage_options',
        'menu_slug' => 'mu_plugin_widgets',
        'callback' => array( $this->callbacks, 'adminWidgets' )
      ),
    );
  }

  public function setSettings()
  {
    $args = array(
      array(
        'option_group' => 'mup_options_group',
        'option_name' => 'text_example',
        'callback' => array( $this->callbacks, 'mupOptionsGroup' )
      ),
      array(
        'option_group' => 'mup_options_group',
        'option_name' => 'first_name'
      ),
    );

    $this->settings->setSettings( $args );
  }

  public function setSections()
  {
    $args = array(
      array(
        'id' => 'mup_admin_index',
        'title' => 'Settings',
        'callback' => array( $this->callbacks, 'mupAdminSection' ),
        'page' => 'mu_plugin',
      )
    );

    $this->settings->setSections( $args );
  }

  public function setFields()
  {
    $args = array(
      array(
        'id' => 'text_example',
        'title' => 'Text Example',
        'callback' => array( $this->callbacks, 'mupTextExample' ),
        'page' => 'mu_plugin',
        'section' => 'mup_admin_index',
        'args' => array(
          'label_for' => 'text_example',
          'class' => 'example_class',
        )
      ),
      array(
        'id' => 'first_name',
        'title' => 'First Name',
        'callback' => array( $this->callbacks, 'mupFirstName' ),
        'page' => 'mu_plugin',
        'section' => 'mup_admin_index',
        'args' => array(
          'label_for' => 'first_name',
          'class' => 'example_class',
        )
      ),
    );

    $this->settings->setFields( $args );
  }

}
