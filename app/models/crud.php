<?php

namespace App\Models;

use PDO, PDOException;
use App\Config\Connection;

class Crud
{
  protected $tableName;
  protected $connection;
  protected $condition;
  protected $query;

  public function __construct($tableName)
  {
    $this->connection = (new Connection())->connect();
    $this->tableName = $tableName;
  }

  public function getData()
  {
    try {
      $this->query = "SELECT * FROM {$this->tableName} {$this->condition}";
      $sql = $this->connection->prepare($this->query);
      $sql->execute();

      return $sql->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      echo "Error: {$e->getMessage()}";
    }
  }

  public function getDataById()
  {
    $data = $this->getData();

    if (count($data) > 0) {
      return $data[0];
    }

    return null;
  }


  public function insertData($obj)
  {
    try {
      $fields = implode("`, `", array_keys($obj));
      $values = ":" . implode(", :", array_keys($obj));

      $this->query = "INSERT INTO {$this->tableName} (`{$fields}`) VALUES ({$values})";
      $this->runQuery($obj);

      return $this->connection->lastInsertId();
    } catch (PDOException $e) {
      echo "Error: {$e->getMessage()}";
    }
  }

  public function updateData($obj)
  {
    try {
      $fields = "";
      foreach ($obj as $key => $value) {
        $fields .= "`{$key}`=:{$key},";
      }

      $fields = rtrim($fields, ",");
      $this->query = "UPDATE {$this->tableName} SET {$fields} {$this->condition}";
      return $this->runQuery($obj);
    } catch (PDOException $e) {
      echo "Error: {$e->getMessage()}";
    }
  }

  public function deleteData()
  {
    try {
      $this->query = "DELETE FROM {$this->tableName} {$this->condition}";
      return $this->runQuery();
    } catch (PDOException $e) {
      echo "Error: {$e->getMessage()}";
    }
  }

  public function where($key, $operator, $value)
  {
    $this->condition .= (strpos($this->condition, "WHERE")) ? " AND " : " WHERE ";
    $this->condition .= "`{$key}` {$operator}" . ((is_string($value)) ? "\"{$value}\"" : $value) . " ";
    return $this;
  }

  public function orWhere($key, $operator, $value)
  {
    $this->condition .= (strpos($this->condition, "WHERE")) ? " OR " : " WHERE ";
    $this->condition .= "`{$key}` {$operator}" . ((is_string($value)) ? "\"{$value}\"" : $value) . " ";
    return $this;
  }

  private function runQuery($obj = null)
  {
    $sql = $this->connection->prepare($this->query);
    if ($obj !== null) {
      foreach ($obj as $key => $value) {
        if (empty($value)) {
          $value = null;
        }

        $sql->bindValue(":{$key}", $value);
      }
    }

    $sql->execute();
    $this->reset();

    return $sql->rowCount();
  }

  private function reset()
  {
    $this->query = null;
    $this->condition = "";
  }
}
