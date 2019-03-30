<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Api\Callbacks;

class TaxonomyCallbacks
{
  public function taxSectionManager()
  {
    echo "Create Custom Taxonomies";
  }

  public function taxSanitize( $input )
  {
    $output = get_option( 'mu_plugin_tax' );

    if ( isset( $_POST['remove'] ) ) {
      unset( $output[$_POST['remove']] );
      return $output;
    }


    if ( count( $output ) == 0 ) {
      $output[$input['taxonomy']] = $input;
      return $output;
    }

    foreach ( $output as $key => $value ) {
      if ( $input['taxonomy'] === $key) {
        $output[$key] = $input;
      } else {
        $output[$input['taxonomy']] = $input;
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

    if ( isset( $_POST['edit_taxonomy'] ) ) {
      $input = get_option( $option_name );
      $value = $input[ $_POST['edit_taxonomy'] ][$name];
    }

    echo '<input type="text" id="' . $name . '" name="' . $option_name .'[' . $name . '] " value="' . $value . '" class="regular-text" placeholder="' . $placeholder . '" required >';
  }

  public function checkboxField( $args )
  {
    $name = $args['label_for'];
    $class = $args['class'];
    $option_name = $args['option_name'];
    $checked = false;

    if ( isset( $_POST['edit_taxonomy'] ) ) {
      $checkbox = get_option( $option_name );
      $checked = isset( $checkbox[ $_POST['edit_taxonomy'] ][$name] ) ?: false;
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

  public function checkboxPostTypesField( $args )
  {
    $output = '';
    $name = $args['label_for'];
    $class = $args['class'];
    $option_name = $args['option_name'];
    $checked = false;

    if ( isset( $_POST['edit_taxonomy'] ) ) {
      $checkbox = get_option( $option_name );
    }


    // echo $input_str;

    $post_types = get_post_types( array( 'show_ui' => true ) );
    // $input_str = '';
    foreach ($post_types as $post_type) {
      if ( isset( $_POST['edit_taxonomy'] ) ) {
        $checked = isset( $checkbox[ $_POST['edit_taxonomy'] ][$name][$post_type] ) ?: false;
      }

      $output .= '<div class="' . $class . ' mb-10">';
      $output .= '<input type="checkbox" id="' . $post_type . '" name="' . $option_name .'[' . $name . '][' . $post_type . '] " value="1" class=""' . ( $checked ? 'checked' : '') . ' >';
      $output .= '<label for="' . $post_type . '">';
      $output .= '<div></div>';
      $output .= '</label> ';
      $output .= '<strong>' . $post_type . '</strong>';
      $output .= '</div>';
      // $output .= $input_str;
    }
    echo $output;
  }
}
