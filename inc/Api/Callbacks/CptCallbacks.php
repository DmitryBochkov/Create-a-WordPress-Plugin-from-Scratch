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
    $output = get_option( 'mu_plugin_cpt' );

    if ( isset( $_POST['remove'] ) ) {
      unset( $output[$_POST['remove']] );
      return $output;
    }


    if ( count( $output ) == 0 ) {
      $output[$input['post_type']] = $input;
      return $output;
    }

    foreach ( $output as $key => $value ) {
      if ( $input['post_type'] === $key) {
        $output[$key] = $input;
      } else {
        $output[$input['post_type']] = $input;
      }
    }

    return $output;
  }

  public function textField( $args )
  {
    $name = $args['label_for'];
    $placeholder = $args['placeholder'];
    $option_name = $args['option_name'];
    $value = '';

    if ( isset( $_POST['edit_post'] ) ) {
      $input = get_option( $option_name );
      $value = $input[ $_POST['edit_post'] ][$name];
    }

    echo '<input type="text" id="' . $name . '" name="' . $option_name .'[' . $name . '] " value="' . $value . '" class="regular-text" placeholder="' . $placeholder . '" required >';
  }

  public function checkboxField( $args )
  {
    $name = $args['label_for'];
    $class = $args['class'];
    $option_name = $args['option_name'];
    $checked = false;

    if ( isset( $_POST['edit_post'] ) ) {
      $checkbox = get_option( $option_name );
      $checked = isset( $checkbox[ $_POST['edit_post'] ][$name] ) ?: false;
    }


    $input_str = '';
    $input_str .= '<div class="' . $class . '">';
    $input_str .= '<input type="checkbox" id="' . $name . '" name="' . $option_name .'[' . $name . '] " value="1" class=""' . ( $checked ? 'checked' : '') . ' >';
    $input_str .= '<label for="' . $name . '">';
    $input_str .= '<div></div>';
    $input_str .= '</label>';
    $input_str .= '</div>';
    echo $input_str;
  }

}
