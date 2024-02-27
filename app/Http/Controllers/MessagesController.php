<?php

namespace App\Http\Controllers;

use App\DTO\MessageDTO;
use App\Http\Requests\AddMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Services\GroupOfMessagesService;
use App\Services\MessagesService;
use Illuminate\Http\JsonResponse;

class MessagesController extends Controller
{
    public function __construct(
        protected readonly MessagesService $service
    ) {
    }

    public function index(int $groupId, GroupOfMessagesService $groupOfMessagesService): JsonResponse
    {
        $group = $groupOfMessagesService->getWithMessages($groupId);

        return response()->json([
            'success' => true,
            'messages' => $group->messages->toArray()
        ]);
    }

    public function add(AddMessageRequest $request): JsonResponse
    {
        /** @var Message $message */
        $message = $this->service->create(
            new MessageDTO(
                user: $request->input('user'),
                group_id: (int) $request->input('group_id'),
                text: $request->input('text'),
            )
        );

        return response()->json([
            'success' => true,
            'message_id' => $message->id
        ]);
    }

    public function update(int $id, UpdateMessageRequest $request): JsonResponse
    {
        $message = $this->service->update($id, $request->input('text'));

        return response()->json([
            'success' => true,
            'message_id' => $message->id
        ]);
    }

    public function delete(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json([
            'success' => true,
        ]);
    }
}
