<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Admin extends BaseController
{
  public $settings;
  public $callbacks;
  public $callbacks_mngr;
  public $pages = array();
  public $subpages = array();

  public function register()
  {
    $this->settings = new SettingsApi();
    $this->callbacks = new AdminCallbacks();
    $this->callbacks_mngr = new ManagerCallbacks();
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
        'option_group' => 'mu_plugin_settings',
        'option_name' => 'cpt_manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
      ),
      array(
        'option_group' => 'mu_plugin_settings',
        'option_name' => 'taxonomy_manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
      ),
      array(
        'option_group' => 'mu_plugin_settings',
        'option_name' => 'media_widget',
        'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
      ),
      array(
        'option_group' => 'mu_plugin_settings',
        'option_name' => 'gallery_manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
      ),
      array(
        'option_group' => 'mu_plugin_settings',
        'option_name' => 'testimonial_manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
      ),
      array(
        'option_group' => 'mu_plugin_settings',
        'option_name' => 'templates_manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
      ),
      array(
        'option_group' => 'mu_plugin_settings',
        'option_name' => 'login_manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
      ),
      array(
        'option_group' => 'mu_plugin_settings',
        'option_name' => 'membership_manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
      ),
      array(
        'option_group' => 'mu_plugin_settings',
        'option_name' => 'chat_manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
      ),
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
    $args = array(
      array(
        'id' => 'cpt_manager',
        'title' => 'Activate CPT Manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
        'page' => 'mu_plugin',
        'section' => 'mup_admin_index',
        'args' => array(
          'label_for' => 'cpt_manager',
          'class' => 'ui-toggle',
        )
      ),
      array(
        'id' => 'taxonomy_manager',
        'title' => 'Activate Taxonomy Manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
        'page' => 'mu_plugin',
        'section' => 'mup_admin_index',
        'args' => array(
          'label_for' => 'taxonomy_manager',
          'class' => 'ui-toggle',
        )
      ),
      array(
        'id' => 'media_widget',
        'title' => 'Activate Media Widget',
        'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
        'page' => 'mu_plugin',
        'section' => 'mup_admin_index',
        'args' => array(
          'label_for' => 'media_widget',
          'class' => 'ui-toggle',
        )
      ),
      array(
        'id' => 'gallery_manager',
        'title' => 'Activate Gallery Manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
        'page' => 'mu_plugin',
        'section' => 'mup_admin_index',
        'args' => array(
          'label_for' => 'gallery_manager',
          'class' => 'ui-toggle',
        )
      ),
      array(
        'id' => 'testimonial_manager',
        'title' => 'Activate Testimonial Manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
        'page' => 'mu_plugin',
        'section' => 'mup_admin_index',
        'args' => array(
          'label_for' => 'testimonial_manager',
          'class' => 'ui-toggle',
        )
      ),
      array(
        'id' => 'templates_manager',
        'title' => 'Activate Templates Manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
        'page' => 'mu_plugin',
        'section' => 'mup_admin_index',
        'args' => array(
          'label_for' => 'templates_manager',
          'class' => 'ui-toggle',
        )
      ),
      array(
        'id' => 'login_manager',
        'title' => 'Activate Login Manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
        'page' => 'mu_plugin',
        'section' => 'mup_admin_index',
        'args' => array(
          'label_for' => 'login_manager',
          'class' => 'ui-toggle',
        )
      ),
      array(
        'id' => 'membership_manager',
        'title' => 'Activate Memberships Manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
        'page' => 'mu_plugin',
        'section' => 'mup_admin_index',
        'args' => array(
          'label_for' => 'membership_manager',
          'class' => 'ui-toggle',
        )
      ),
      array(
        'id' => 'chat_manager',
        'title' => 'Activate Chat Manager',
        'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
        'page' => 'mu_plugin',
        'section' => 'mup_admin_index',
        'args' => array(
          'label_for' => 'chat_manager',
          'class' => 'ui-toggle',
        )
      ),
    );

    $this->settings->setFields( $args );
  }

}
