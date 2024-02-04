<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Requests\Chat\CreateRequest;
use App\Repositories\Interfaces\ChatRepositoryInterface;



class CreateController extends Controller
{
    /**
     * @var repository
     */
    private $repository;

    /**
     * UserController constructor.
     *
     * @param ChatRepositoryInterface $repository
     */
    public function __construct(ChatRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateRequest $request)
    {
        try {
            $chat = $this->repository->create($request->validated());
            return new ChatResource($chat);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
