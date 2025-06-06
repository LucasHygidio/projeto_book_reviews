<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GenreService;
use App\Http\Requests\GenreUpdateRequest;
use App\Http\Requests\GenreStoreRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\GenreResource;;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class GenreController extends Controller
{
    private GenreService $genreService;

    public function __construct(GenreService $genreService){
        $this->genreService = $genreService;
    }

    public function get(){
        $genres = $this->genreService->get();

        return GenreResource::collection($genres);
    }

    public function store(GenreStoreRequest $request){
        $data = $request->validated();
        $genre = $this->genreService->store($data);

        return new GenreResource($genre);
    }

    public function details(int $id){
        try{
            $genre = $this->genreService->details($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Genero não existe'],404);
        }

        return new GenreResource($genre);
    }


    public function update(int $id, GenreUpdateRequest $request){
         $data = $request->validated();
        try{
            $genre = $this->genreService->update($id,$data);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Genero não encontrado'],404);
        }
        return new GenreResource($genre);
    }

    public function delete($id){
        try{
            $genre = $this->genreService->delete($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Genero não encontrado'],404);
        }

        return new GenreResource($genre);
    }

    //Lista o livro com seu respectivo genero
    public function getWithBooks()
    {
        $genre = $this->genreService->getWithBooks();
        return GenreResource::collection($genre);
    }

    //Listar todos os livros de um genre especifico
    public function findBooks(int $id){
        try {
            $books = $this->genreService->findBooks($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Livro não existe'], 404);
        }
        return BookResource::collection($books);
    }
}

