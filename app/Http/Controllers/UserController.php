<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\ReviewResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function get()
    {
        $users = $this->userService->get();

        return UserResource::collection($users);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = $this->userService->store($data);

        return new UserResource($user);
    }

    public function details(int $id)
    {
        try{
            $user = $this->userService->details($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Usuario não encontrado'],404);
        }

        return new UserResource($user);
    }


    public function update(int $id, UserUpdateRequest $request)
    {
        $data = $request->validated();
        try{
            $user = $this->userService->update($id, $data);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Usuario não encontrado'],404);
        }

        return new UserResource($user);
    }

    public function delete($id)
    {
        try{
            $user= $this->userService->delete($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Usuario não encontrado'],404);
        }
        return new UserResource($user);
    }

    public function findReview(int $id)
    {
        try{
            $reviews = $this->userService->findReview($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Review não encontrada'],404);
        }
        if ($reviews->isEmpty()) {
            return response()->json(['message' => 'Nenhuma review encontrada'], 204);
        }

        return ReviewResource::collection($reviews);
    }


}
