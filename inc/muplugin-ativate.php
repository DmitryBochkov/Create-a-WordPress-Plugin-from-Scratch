<?php
/**
* @package MyUniversalPlugin
*/

class MUPluginActivate
{

  public static function activate() {
    flush_rewrite_rules();
  }
}
