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
    $input_str = '';
    $input_str .= '<div class="' . $class . '">';
    $input_str .= '<input type="checkbox" id="' . $name . '" name="' . $name . '" value="1" class="" ' . ($checkbox ? 'checked' : '') . '>';
    $input_str .= '<label for="' . $name . '">';
    $input_str .= '<div></div>';
    $input_str .= '</label>';
    $input_str .= '</div>';
    echo $input_str;
  }

}
