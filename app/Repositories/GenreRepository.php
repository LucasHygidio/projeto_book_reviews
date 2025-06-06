<?php

namespace App\Repositories;

use App\Models\Genre;

class GenreRepository
{
    public function get()
    {
        return Genre::all();
    }

    public function store(array $data)
    {
        return Genre::create($data);
    }

    public function details(int $id)
    {
        return Genre::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $genre = Genre::find($id);
        $genre->update($data);

        return $genre;
    }

    public function delete(int $id)
    {
        $genre = $this->details($id);
        $genre->delete();

        return $genre;
    }

    public function getWithBooks()
    {
        return Genre::with('books')->get();
    }

    public function findBooks(int $id)
    {
        $genre = $this->details($id);
        return $genre->books;
    }
}
