<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckinRequest;
use App\Services\CheckinService;
use App\Statics\GlobalStatic;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class CheckinController extends Controller
{
  public function checkin(CheckinRequest $request, CheckinService $service)
  {
    $checkinData = $service->checkin($request->validated());
    $status = $checkinData['status'];
    $currentTime = Carbon::now()->toDateTimeString();

    if($status == GlobalStatic::CHECKIN_SUCCESS){
      return response()->json([
        "message" => "Checkin successfuly !",
        "status" => JsonResponse::HTTP_OK,
        "timestamp" => $currentTime
      ])->setStatusCode(JsonResponse::HTTP_OK);;
    }

    if($status == GlobalStatic::CHECKIN_ALREADY_CHECKIN){
      return response()->json([
        "message" => "Ticket is already checkin !",
        "status" => JsonResponse::HTTP_FORBIDDEN,
        "timestamp" => $currentTime,
        "checkin_date" => $checkinData["checkin_date"]  
      ])->setStatusCode(JsonResponse::HTTP_FORBIDDEN);;
    }

    if($status == GlobalStatic::CHECKIN_CODE_INVALID){
      return response()->json([
        "message" => "Code is invalid !",
        "status" => JsonResponse::HTTP_NOT_FOUND,
        "timestamp" => $currentTime
      ])->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
    }
  }
}
