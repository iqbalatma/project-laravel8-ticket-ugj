<?php

namespace App\Services;

use App\Repository\HomeRepository;

class HomeService
{

  public function getAllDataSummary():array
  {
    return (new HomeRepository())->getAllDataSummary();
  }
}
