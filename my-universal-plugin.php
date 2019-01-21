<?php
/**
* @package MyUniversalPlugin
*/
/*
Plugin Name: My Universal Plugin
Description: My custom universal plugin
Version: 1.0.0
Author: Dmytro
License: GPLv2 or later
Text Domain: muplugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

if ( ! defined( 'ABSPATH' ) ) {
  die;
}

if (! class_exists( 'MUPlugin ') ) {
  class MUPlugin
  {
    function register() {
      add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    protected function create_post_type() {
      add_action( 'init', array( $this, 'custom_post_type' ) );
    }

    function custom_post_type() {
      register_post_type( 'book', array(
        'label' => 'Books',
        'public' => true
      ) );
    }

    function enqueue() {
      // enqueue all scripts
      wp_enqueue_style( 'myplugin-style', plugins_url( '/assets/mystyle.css', __FILE__ ) );
      wp_enqueue_script( 'myplugin-script', plugins_url( '/assets/myscript.js', __FILE__ ) );
    }

  }
}



if ( class_exists( 'MUPlugin' ) ) {
  $muplugin = new MUPlugin();
  $muplugin->register();
}

// activation
require_once plugin_dir_path( __FILE__ ) . 'inc/muplugin-ativate.php';
register_activation_hook( __FILE__, array( 'MUPluginActivate', 'activate' ) );

// deactivation
require_once plugin_dir_path( __FILE__ ) . 'inc/muplugin-deativate.php';
register_deactivation_hook( __FILE__, array( 'MUPluginDeactivate', 'deactivate' ) );
