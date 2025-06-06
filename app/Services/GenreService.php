<?php

namespace App\Services;

use App\Models\Genre;
use App\Repositories\GenreRepository;

class GenreService
{
    private GenreRepository $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function get()
    {
        $genres = $this->genreRepository->get();
        return $genres;
    }

    public function store(array $data)
    {
        $genres = $this->genreRepository->store($data);
        return $genres;
    }

    public function details($id)
    {
        $genre = $this->genreRepository->details($id);
        return $genre;
    }

    public function update(int $id, array $data)
    {
        $genre = $this->genreRepository->update($id, $data);
        return $genre;
    }

    public function delete(int $id)
    {
        $genre = Genre::findOrFail($id);
        foreach ($genre->books as $book) {
            $book->genre_id = null;
            $book->save();
        }

        $genre->delete();

        return $genre;
    }

    public function getWithBooks()
    {
        return $this->genreRepository->getWithBooks();
    }

    public function findBooks(int $id)
    {
        return $this->genreRepository->findBooks($id);
    }
}

