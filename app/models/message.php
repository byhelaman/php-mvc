<?php

namespace App\Models;

class Message
{
  const SUCCESS = 'SUCCESS';
  const ERROR = 'ERROR';
  const SUCCESS_INSERTION = 'SUCCESS INSERTION';
  const SUCCESS_UPDATED = 'SUCCESS UPDATED';
  const SUCCESS_DELETED = 'SUCCESS DELETED';

  public static function getMessage($code)
  {
    $data = [
      Message::SUCCESS => new Response('Ok', 'The operation was successful'),
      Message::SUCCESS_INSERTION => new Response('Ok', 'The operation was successful'),
      Message::SUCCESS_UPDATED => new Response('Ok', 'The operation was successful'),
      Message::SUCCESS_DELETED => new Response('Ok', 'The operation was successful')
    ];

    return $data[$code];
  }
}
