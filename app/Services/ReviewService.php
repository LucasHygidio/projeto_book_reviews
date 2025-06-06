<?php

namespace App\Services;

use App\Repositories\ReviewRepository;

class ReviewService
{
    private ReviewRepository $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function get()
    {
        $reviews = $this->reviewRepository->get();
        return $reviews;
    }

    public function store(array $data)
    {
        $review = $this->reviewRepository->store($data);
        return $review;
    }

    public function details(int $id)
    {
        $review = $this->reviewRepository->details($id);
        return $review;
    }

    public function update(int $id, array $data)
    {
        $review = $this->reviewRepository->update($id, $data);
        return $review;
    }

    public function delete(int $id)
    {
        $review = $this->reviewRepository->delete($id);
        return $review;
    }
}

