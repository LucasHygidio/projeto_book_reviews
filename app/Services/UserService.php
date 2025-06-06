<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function get()
    {
        $user = $this->userRepository->get();
        return $user;
    }

    public function store(array $data)
    {
        $user = $this->userRepository->store($data);
        return $user;
    }

    public function details(int $id)
    {
        $user = $this->userRepository->details($id);
        return $user;
    }

    public function update(int $id, array $data)
    {
        $user = $this->userRepository->update($id, $data);
        return $user;
    }

    public function delete(int $id)
    {
        $user = $this->userRepository->delete($id);
        return $user;
    }

    public function findReview(int $id)
    {
        $reviews = $this->userRepository->findReviews($id);
        return $reviews;
    }
}
