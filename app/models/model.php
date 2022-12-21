<?php

namespace App\Models;

use PDOException;

class Model extends Crud
{
  private $className;
  private $exclude = [
    'className', 'exclude', 'tableName', 'connection', 'condition', 'query'
  ];

  public function __construct($tableName, $className, $properties = null)
  {
    parent::__construct($tableName);
    $this->className = $className;

    if (empty($properties)) {
      return;
    }

    foreach ($properties as $key => $value) {
      $this->{$key} = $value;
    }
  }

  protected function getAttributes()
  {
    $vars = get_class_vars($this->className);
    $attr = [];

    $count = count($vars);

    foreach ($vars as $key => $value) {
      if (!in_array($key, $this->exclude)) {
        $attr[] = $key;
      }
    }

    return $attr;
  }

  protected function parseData($obj = null)
  {
    try {
      $attr = $this->getAttributes();
      $objFinal = [];

      if ($obj == null) {
        foreach ($attr as $index => $key) {
          if (isset($this->{$key})) {
            $objFinal[$key] = $this->{$key};
          }
        }

        return $objFinal;
      }

      foreach ($attr as $index => $key) {
        if (isset($obj[$key])) {
          $objFinal[$key] = $obj[$key];
        }
      }

      return $objFinal;
    } catch (PDOException $e) {
      die("Error connection: {$e->getMessage()}");
    }
  }

  protected function fillData($obj)
  {
    try {
      $attr = $this->getAttributes();

      foreach ($attr as $index => $key) {
        if (isset($obj[$key])) {
          $this->{$key} = $obj[$key];
        }
      }
    } catch (PDOException $e) {
      die("Error connection: {$e->getMessage()}");
    }
  }

  public function insertData($obj = null)
  {
    $obj = $this->parseData($obj);
    return parent::insertData($obj);
  }

  public function updateData($obj)
  {
    $obj = $this->parseData($obj);
    return parent::updateData($obj);
  }

  public function __get($nameAttr)
  {
    return $this->{$nameAttr};
  }

  public function __set($nameAttr, $value)
  {
    $this->{$nameAttr} = $value;
  }
}
