<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Http\Resources\ReviewResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewController extends Controller
{
    //Injeção de Dependencia
    private ReviewService $reviewService;

    public function __construct(ReviewService $reviewService){
         $this->reviewService = $reviewService;
    }

     public function get(){
        $reviews = $this->reviewService->get();

        return ReviewResource::collection($reviews);
    }

    public function details($id){
        try{
            $review = $this->reviewService->details($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Review não encontrada'],404);
        }

        return new ReviewResource($review);
    }

    public function store(ReviewStoreRequest $request){
        $data = $request->validated();
        $review = $this->reviewService->store($data);

        return new ReviewResource($review);
    }

    public function update(int $id, ReviewUpdateRequest $request){
         $data = $request->validated();
        try{
            $review = $this->reviewService->update($id,$data);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Review não encontrada'],404);
        }
        return new ReviewResource($review);
    }

    public function delete($id){
       try{
            $review = $this->reviewService->delete($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Review não encontrada'],404);
        }
        return new ReviewResource($review);
    }
}