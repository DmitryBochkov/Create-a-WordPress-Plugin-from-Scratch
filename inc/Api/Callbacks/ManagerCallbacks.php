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
    $output = array();
    foreach ($this->managers as $key => $value) {
      $output[$key] = isset( $input[$key] ) ? true : false;
    }
    return $output;
  }

  public function AdminSectionManager()
  {
    echo "Manage the Sections and Features of the Plugin by activating the checkboxes from the following list";
  }

  public function checkboxField( $args )
  {
    $name = $args['label_for'];
    $class = $args['class'];
    $option_name = $args['option_name'];
    $checkbox = get_option( $option_name );
    $input_str = '';
    $input_str .= '<div class="' . $class . '">';
    $input_str .= '<input type="checkbox" id="' . $name . '" name="' . $option_name .'[' . $name . '] " value="1" class="" ' . ($checkbox[$name] ? 'checked' : '') . '>';
    $input_str .= '<label for="' . $name . '">';
    $input_str .= '<div></div>';
    $input_str .= '</label>';
    $input_str .= '</div>';
    echo $input_str;
  }

}
