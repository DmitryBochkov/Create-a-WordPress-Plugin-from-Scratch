<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Api\Callbacks;
use \Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
  public function checkboxSanitize( $input )
  {
    // return filter_var( $input, FILTER_SANITIZE_NUMBER_INT );
    return isset( $input ) ? true : false;
  }

  public function AdminSectionManager()
  {
    echo "Manage the Sections and Features of the Plugin by activating the checkboxes from the following list";
  }

  public function checkboxField( $args )
  {
    $name = $args['label_for'];
    $class = $args['class'];
    $checkbox = get_option( $name );
    echo '<input type="checkbox" name="' . $name . '" value="1" class="' . $class . '" ' . ($checkbox ? 'checked' : '') . '>';
  }

}
