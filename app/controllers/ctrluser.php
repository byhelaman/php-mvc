<?php

namespace App\Controllers;

use App\Models\{User, Response, Message};

class CtrlUser
{
  public function __construct()
  {
  }

  public function showUsers()
  {
    $user = new User();
    $data = $user->getData();

    $response = new Response(count($data) ? Message::SUCCESS : Message::ERROR);
    $response->setData($data);

    return $response;

    // return [
    //   'code' => ((count($data) > 0) ? 'Ok' : 'Error'),
    //   'message' => ((count($data) > 0) ? 'Data successfully displayed' : 'Data not found'),
    //   'data' => $data
    // ];
  }

  public function getUserById($idUser)
  {
    $user = new User();
    $data = $user->where('id', '=', $idUser)->getDataById();

    return new Response(($data !== null) ? Message::SUCCESS : Message::ERROR);

    // return [
    //   'code' => (($data !== null) ? 'Ok' : 'Error'),
    //   'message' => (($data !== null) ? 'User found' : 'User not found'),
    //   'data' => $data
    // ];
  }

  public function insertUser($data)
  {
    $user = new User();
    $insert = $user->insertData($data);

    $response = new Response(($insert > 0) ? Message::SUCCESS : Message::ERROR);
    $response->setData($insert);

    return $response;

    // return [
    //   'code' => (($code > 0) ? 'Ok' : 'Error'),
    //   'message' => (($code > 0) ? 'User successfully inserted' : 'Error inserting user'),
    //   'data' => $code
    // ];
  }

  public function updateUser($data)
  {
    $user = new User();
    $update = $user->where('id', '=', $data['idUser'])->updateData($data);

    return new Response(($update > 0) ? Message::SUCCESS : Message::ERROR);

    // return [
    //   'code' => (($update > 0) ? 'Ok' : 'Error'),
    //   'message' => (($update > 0) ? 'User successfully updated' : 'Error updating user'),
    //   'data' => $update
    // ];
  }

  public function deleteUser($idUser)
  {
    $user = new User();
    $delete = $user->where('id', '=', $idUser)->deleteData();

    return new Response(($delete > 0) ? Message::SUCCESS : Message::ERROR);

    // return [
    //   'code' => (($delete > 0) ? 'Ok' : 'Error'),
    //   'message' => (($delete > 0) ? 'User successfully deleted' : 'Error deleting user'),
    //   'data' => $delete
    // ];
  }
}
