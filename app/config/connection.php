<?php

namespace App\Config;

use PDO, PDOException;

class Connection
{
  private $driver;
  private $host;
  private $port;
  private $database;
  private $user;
  private $pass;
  private $charset;

  public function __construct()
  {
    $this->driver = 'mysql';
    $this->port = '3306';
    $this->host = 'localhost';
    $this->database = 'data_test';
    $this->user = 'root';
    $this->pass = '';
    $this->charset = 'utf8mb4';
  }

  public function connect()
  {
    try {
      $url = "{$this->driver}:port={$this->port}:host={$this->host};dbname={$this->database};charset={$this->charset}";
      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
      ];

      return (new PDO($url, $this->user, $this->pass, $options));
    } catch (PDOException $e) {
      die("Error connection: {$e->getMessage()}");
    }
  }
}
