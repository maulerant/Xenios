<?php

namespace App\Http\Controllers;

use App\DTO\GroupOfMessageDTO;
use App\Http\Requests\AddGroupRequest;
use App\Services\GroupOfMessagesService;
use Illuminate\Http\JsonResponse;

class GroupOfMessagesController extends Controller
{
    public function __construct(
        protected readonly GroupOfMessagesService $service
    ) {
    }

    public function index(int $id): JsonResponse
    {
        $group = $this->service->find($id);

        return response()->json([
            'success' => true,
            'group' => $group->toArray()
        ])->setStatusCode(200);
    }

    public function all(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'groups' => $this->service->getOrderedByLastMessageCreateTime(),
        ])->setStatusCode(200);
    }

    public function add(AddGroupRequest $request): JsonResponse
    {
        $group = $this->service->create(new GroupOfMessageDTO(name: $request->input('name')));

        return response()->json([
            'success' => true,
            'id' => $group->id
        ])->setStatusCode(200);
    }

    public function update(int $id, AddGroupRequest $request): JsonResponse
    {
        $this->service->update($id, new GroupOfMessageDTO(name: $request->input('name')));

        return response()->json([
            'success' => true,
            'id' => $id
        ])->setStatusCode(200);
    }

    public function delete(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json([
            'success' => true,
        ])->setStatusCode(200);
    }
}
