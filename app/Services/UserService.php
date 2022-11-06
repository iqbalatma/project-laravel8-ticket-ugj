<?php 
namespace App\Services;

use App\Models\User;
use App\Repository\UserRepository;

class UserService{
  public function getAllDataUser():array
  {
    return [
      'title' => 'User',
      'users' => (new UserRepository())->getAllDataUserTicketing()
    ];
  }

  public function addNewDataUserTicketing(array $requestedData)
  {
    $requestedData['password'] = bcrypt($requestedData['password']);
    return (new UserRepository())->addNewDataUser($requestedData);
  }
}
