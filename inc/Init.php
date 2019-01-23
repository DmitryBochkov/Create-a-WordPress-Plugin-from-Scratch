<?php
/**
* @package MyUniversalPlugin
*/
namespace Inc;

final class Init
{
  /**
  * Store all classes inside an array
  * @return array Full list of classes
  */
  public static function get_servies() {
    return [
      Pages\Admin::class,
      Base\Enqueue::class
    ];
  }

  /**
  * Loop through the classes, initialize them
  * and call the register() method of it exists
  * @return
  */
  public static function register_services() {
    foreach ( self::get_servies() as $class ) {
      $service = self::instantiate( $class );

      if ( method_exists( $service, 'register' )) {
        $service->register();
      }
    }
  }

    /**
    * Initialize the class
    * @param class $class   class from the services array
    * @return class instance  new instance of the class
    */
  private static function instantiate( $class ) {
    $service = new $class();
    return $service;
  }
}
