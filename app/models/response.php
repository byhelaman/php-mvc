<?php

namespace App\Models;

class Response
{
  public $code;
  public $message;
  public $data;

  public function __construct($code = null, $message = null, $data = null)
  {
    if (isset($code) && empty($message)) {
      $response = Message::getMessage($code);

      $this->code = $response->code;
      $this->message = $response->message;
      $this->data = $response->data;
      return;
    }

    // if (is_string($code)) {
    //   $response = Message::getMessage($code);
    //   $code = $response->code;
    // }

    $this->code = $code;
    $this->message = $message;
    $this->data = $data;
  }

  public function parseJson($obj = null)
  {
    header('Content-Type: application/json');
    if (is_array($obj) || is_object($obj)) {
      return json_encode($obj);
    }

    return json_encode($this);
  }

  public function getCode()
  {
    return $this->code;
  }

  public function getMessage()
  {
    return $this->message;
  }

  public function getData()
  {
    return $this->data;
  }

  public function setCode($code)
  {
    $this->code = $code;
  }

  public function setMessage($message)
  {
    $this->message = $message;
  }

  public function setData($data)
  {
    $this->data = $data;
  }
}
