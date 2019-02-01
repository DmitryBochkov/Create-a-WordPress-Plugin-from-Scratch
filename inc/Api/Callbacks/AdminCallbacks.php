<?php
/**
* @package MyUniversalPlugin
*/

namespace Inc\Api\Callbacks;
use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
  public function adminDashboard()
  {
    return require_once "$this->plugin_path/templates/admin.php";
  }

  public function adminCPT()
  {
    return require_once "$this->plugin_path/templates/adminCPT.php";
  }

  public function adminWidgets()
  {
    return require_once "$this->plugin_path/templates/adminWidgets.php";
  }

  public function mupOptionsGroup( $input )
  {
    return $input;
  }

  public function mupAdminSection()
  {
    echo "Test section for custom fields";
  }

  public function mupTextExample()
  {
    $value = esc_attr( get_option( 'text_example' ) );
    echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Text Example">';
  }

  public function mupFirstName()
  {
    $value = esc_attr( get_option( 'first_name' ) );
    echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="First Name">';
  }
}
