<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function get()
    {
        return Book::all();
    }

    public function details(int $id)
    {
        return Book::findOrFail($id);
    }

    public function store(array $data)
    {
        return Book::create($data);
    }

    public function update(int $id, array $data)
    {
        $book = Book::find($id);
        $book->update($data);

        return $book;
    }

    public function delete(int $id)
    {
        $book = $this->details($id);
        $book->delete();

        return $book;
    }

    public function getWithAuthor()
    {
        return Book::with('author')->get();
    }

    public function findAuthor(int $id)
    {
        $book = $this->details($id);
        return $book->author;
    }

    public function getWithGenre()
    {
        return Book::with('genre')->get();
    }

    public function findGenre(int $id)
    {
        $book = $this->details($id);
        return $book->genre;
    }

    public function findReviews(int $id)
    {
        $book = $this->details($id);
        return $book->reviews;
    }

    public function getWithGenreAuthorReviews()
    {
        return Book::with(['genre', 'author', 'reviews'])->get();
    }
}
