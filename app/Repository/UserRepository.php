<?php 

namespace App\Repository;

use App\Models\User;
use App\Statics\GlobalStatic;

class UserRepository{
  public function getAllDataUserTicketing():?object
  {
    return User::where('role_id', GlobalStatic::ROLE_TICKETING)->get();
  }

  public function addNewDataUser(array $requestedData):object
  {
    return User::create($requestedData);
  }

  public function updateDataUserById(int $id, array $requestedData):bool
  {
    return User::where('id', $id)->update($requestedData);
  }

  public function deleteDataUserById(int $id)
  {
    return User::destroy($id);
  }

  
}
?>