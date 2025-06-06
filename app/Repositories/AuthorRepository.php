<?php


namespace App\Repositories;

use App\Models\Author;

class AuthorRepository
{
    public function get()
    {
        return Author::all();
    }

    public function store(array $data)
    {
        return Author::create($data);
    }

    public function details(int $id)
    {
        return Author::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $author = Author::find($id);
        $author->update($data);

        return $author;
    }

    public function delete(int $id)
    {
        $author = $this->details($id);
        $author->delete();

        return $author;
    }

    public function getWithBooks()
    {
        return Author::with('books')->get();
    }

    public function findBooks(int $id)
    {
        $author = $this->details($id);
        return $author->books;
    }
}
