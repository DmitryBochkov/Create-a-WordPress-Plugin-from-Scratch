<?php
/**
* @package MyUniversalPlugin
*/

class MUPluginDeactivate
{

  public static function deactivate() {
    flush_rewrite_rules();
  }
}
