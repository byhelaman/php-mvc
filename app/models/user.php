<?php

namespace App\Models;

class User extends Model
{
  protected $id;
  protected $name;
  protected $surname;
  protected $age;
  protected $email;
  protected $address;
  protected $added;

  public function __construct($properties = null)
  {
    parent::__construct('users', User::class, $properties);
  }

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getSurname()
  {
    return $this->surname;
  }

  public function getAge()
  {
    return $this->age;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getAddress()
  {
    return $this->address;
  }

  public function getAdded()
  {
    return $this->added;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function setSurname($surname)
  {
    $this->surname = $surname;
  }

  public function setAge($age)
  {
    $this->age = $age;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setAddress($address)
  {
    $this->address = $address;
  }

  public function setAdded($added)
  {
    $this->added = $added;
  }
}
