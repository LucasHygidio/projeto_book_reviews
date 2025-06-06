<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
use Illuminate\Http\JsonResponse;
use App\Services\BookService;
use App\Http\Resources\ReviewResource;

use App\Http\Resources\GenreResource;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    private BookService $BookService;

    public function __construct(BookService $BookService){
         $this->BookService = $BookService;
    }

     public function get(){
        $books = $this->BookService->get();

        return BookResource::collection($books);
    }

    public function details($id){
        try{
            $book = $this->BookService->details($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Livro não encontrado'],404);
        }
        return new BookResource($book);
    }

    public function store(BookStoreRequest $request){
        $data = $request->validated();
        $book = $this->BookService->store($data);

        return new BookResource ($book);
      }

    public function update(int $id, BookUpdateRequest $request){
        $data = $request->validated();
        try{
            $book = $this->BookService->update($id,$data);

        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Livro não encontrado'],404);
        }

        return new BookResource($book);
    }

    public function delete($id){
        try{
            $book = $this->BookService->delete($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Livro não encontrado'],404);
        }
        return new BookResource($book);
    }


    public function findReview(int $id)
    {
        try{
            $reviews = $this->BookService->findReviews($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Review não  encontrada'],404);
        }
        if ($reviews->isEmpty()) {
            return response()->json(['message' => 'Nenhuma review encontrada'], 204);
        }
        return ReviewResource::collection($reviews);
    }


    public function getWithGenreAuthorReviews()
    {
        $books = $this->BookService->getWithGenreAuthorReviews();
        return BookResource::collection($books);
    }



}



