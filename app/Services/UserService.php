<?php 
namespace App\Services;

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

  public function updateDataUser(array $requestedData)
  {
    $requestedData['password'] = bcrypt($requestedData['password']);

    return (new UserRepository())->updateDataUserById($requestedData['id'], $requestedData);
  }

  public function deleteDataUser(int $id)
  {
    return (new UserRepository())->deleteDataUserById($id);
  }
}
