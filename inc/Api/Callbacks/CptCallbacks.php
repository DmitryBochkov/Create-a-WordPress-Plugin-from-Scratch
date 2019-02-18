<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Api\Callbacks;

class CptCallbacks
{

  public function cptSectionManager()
  {
    echo "Manage your Custom Post Types";
  }

  public function cptSanitize( $input )
  {
    return $input;
  }

  public function textField( $args )
  {
    $name = $args['label_for'];
    $placeholder = $args['placeholder'];
    $option_name = $args['option_name'];
    $input = get_option( $option_name );
    $value = $input[$name];

    echo '<input type="text" id="' . $name . '" name="' . $option_name .'[' . $name . '] " value="' . $value . '" class="regular-text" placeholder="' . $placeholder . '">';
  }

  public function checkboxField( $args )
  {
    $name = $args['label_for'];
    $class = $args['class'];
    $option_name = $args['option_name'];
    $checkbox = get_option( $option_name );
    $checked = isset( $checkbox[$name] ) ? ( $checkbox[$name] ? true : false ) : false;

    $input_str = '';
    $input_str .= '<div class="' . $class . '">';
    $input_str .= '<input type="checkbox" id="' . $name . '" name="' . $option_name .'[' . $name . '] " value="1" class="" ' . ( $checked ? 'checked' : '') . '>';
    $input_str .= '<label for="' . $name . '">';
    $input_str .= '<div></div>';
    $input_str .= '</label>';
    $input_str .= '</div>';
    echo $input_str;
  }

}
