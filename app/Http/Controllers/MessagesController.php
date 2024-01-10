<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\GroupOfMessages;
use App\Models\Message;
use Illuminate\Http\JsonResponse;

class MessagesController extends Controller
{
    public function index(int $groupId): JsonResponse
    {
        /** @var GroupOfMessages $group */
        $group = GroupOfMessages::query()
            ->with('messages')
            ->findOrFail($groupId);

        return response()->json([
            'success' => true,
            'messages' => $group->messages->toArray()
        ]);
    }

    public function add(AddMessageRequest $request): JsonResponse
    {
        /** @var Message $message */
        $message = Message::create($request->all());

        return response()->json([
            'success' => true,
            'message_id' => $message->id
        ]);
    }

    public function update(int $id, UpdateMessageRequest $request): JsonResponse
    {
        /** @var Message $message */
        $message = Message::findOrFail($id);
        $message->fill($request->all());
        $message->save();

        return response()->json([
            'success' => true,
            'message_id' => $message->id
        ]);
    }

    public function delete(int $id): JsonResponse
    {
         Message::findOrFail($id)
            ->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
