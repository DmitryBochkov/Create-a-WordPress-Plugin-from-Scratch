<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Base;

use \Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class TestimonialController extends BaseController
{
  public $callbacks;
  public $subpages = array();

  public function register() {
    $option = get_option( 'mu_plugin' );
    $activated = isset( $option['testimonial_manager'] ) ? $option['testimonial_manager'] : false;

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
        'page_title' =>  'Testimonial Manager',
        'menu_title' => 'Testimonial Manager',
        'capability' => 'manage_options',
        'menu_slug' => 'mu_plugin_testimonials',
        'callback' => array( $this->callbacks, 'adminTestimonials' )
      ),
    );
  }

}
