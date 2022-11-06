<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\PersonalAccessToken;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(UserService $service): Response
    {
        return response()->view('users.index', $service->getAllDataUser());
    }

    public function store(UserStoreRequest $request, UserService $service)
    {
        $service->addNewDataUserTicketing($request->validated());

        return redirect()
            ->route('user.index')
            ->with('success', 'Add new user successfuly');
    }

    public function update(UserUpdateRequest $request, UserService $service)
    {
        $updated = $service->updateDataUser($request->validated());

        if($updated){
            return redirect()
                ->route('user.index')
                ->with('success', 'Update ' . $request->validated()['name'] . ' successfuly !');
        }else{
            return redirect()
                ->route('user.index')
                ->with('failed', 'Update ' . $request->validated()['name'] . ' failed !');
        }
        
    }

    public function delete(Request $request)
    {
        $userId = $request->all()['id'];
        User::destroy($userId);
        PersonalAccessToken::where('tokenable_id', $userId)->delete();
        return redirect()->route('user.index')->with('success', 'Delete user successfuly');
    }
}
