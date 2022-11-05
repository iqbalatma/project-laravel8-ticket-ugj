<?php 

namespace App\Repository;

use App\Models\Phase;

class PhaseRepository {

  public function getAllDataPhase():object
  {
    return Phase::all();
  }

  public function getLimitById(int $phaseId)
  {
    $phases = Phase::select('limit')->where('id', $phaseId)->first();
    if($phases){
      return $phases->limit;
    }

    return 0;
  }

  public function setLimitById(int $phaseId, int $currentLimit)
  {
    return Phase::where('id', $phaseId)->update(['limit'=> $currentLimit]);
  }
}

?>