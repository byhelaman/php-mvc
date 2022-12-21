<?php

require_once './app/autoload.php';

use App\Template\{Head, Footer};
use App\Controllers\CtrlUser;

// echo new Head();

$user = new CtrlUser();
// $user->insertUser([
//   'name' => 'Oscar',
//   'surname' => 'Patel',
//   'age' => '24',
//   'email' => 'oscar@gmail.com',
//   'added' => date('Y-m-d H:i:s')
// ]);

// $user->updateUser([
//   'idUser' => 5,
//   'name' => 'Oscar',
//   'surname' => 'Patel',
//   'age' => '24',
//   'email' => 'oscar@gmail.com',
//   'added' => date('Y-m-d H:i:s')
// ]);

// echo "
//   <div class='container mt-5'>
//     <pre>";

// print_r($user->getUserById(5));
echo ($user->showUsers()->parseJson());

// echo "
//     </pre>
//   </div>
// ";

// echo new Footer();
