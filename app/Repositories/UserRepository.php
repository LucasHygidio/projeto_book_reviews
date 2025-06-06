<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function get()
    {
        return User::all();
        // Ou para selecionar campos específicos:
        // return User::select('id', 'name', 'email', 'created_at', 'updated_at')->get();
    }

    public function details(int $id)
    {
        return User::findOrFail($id);
        // Ou para buscar campos específicos:
        // return User::find($id, ['id', 'name', 'email', 'created_at', 'updated_at']);
    }

    public function store(array $data)
    {
        return User::create($data);
    }

    public function update(int $id, array $data)
    {
        $user = User::find($id);
        $user->update($data);

        return $user;
    }

    public function delete(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $user;
    }

    public function findReviews(int $id)
    {
        $user = $this->details($id);
        return $user->reviews;
    }
}
