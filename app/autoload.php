<?php

class Autoload
{
  public function __construct()
  {
    spl_autoload_register(array($this, 'load'));
  }

  private function load($className)
  {
    require_once strtolower(str_replace("\\", "/", $className) . '.php');
  }
}

new Autoload();
