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

    //Retorno dos livros com os autores
    public function getWithAuthor()
    {
        $books = $this->BookService->getWithAuthor();
        return BookResource::collection($books);
    }

    //Retorno de um autor de um livro especifico
    public function findAuthor(int $id)
    {
        try{
            $author = $this->BookService->findAuthor($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Autor não encontrado'],404);
        }
        return new AuthorResource($author);
    }

    //Buscar livros com os generos
    public function getWithGenre()
    {
        $books = $this->BookService->getWithGenre();
        return BookResource::collection($books);
    }

    //Buscar livros de um genero especifico
    public function findGenre(int $id)
    {
        try{
            $genre = $this->BookService->findGenre($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Gênero não encontrado'],404);
        }
        return new GenreResource($genre);
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



