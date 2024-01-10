<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddGroupRequest;
use App\Models\GroupOfMessages;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class GroupOfMessagesController extends Controller
{
    public function index(int $id): JsonResponse
    {
        $group = GroupOfMessages::findOrFail($id);

        return response()->json([
            'success' => true,
            'group' => $group->toArray()
        ])->setStatusCode(200);
    }


    public function all(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'groups' => GroupOfMessages::query()
                ->select('group_of_messages.*', DB::raw('max(messages.created_at) as last_message_created_at'))
                ->leftJoin('messages', 'messages.group_id', 'group_of_messages.id')
                ->groupBy('group_of_messages.id')
                ->orderByDesc('last_message_created_at')
                ->get()
        ])->setStatusCode(200);
    }

    public function add(AddGroupRequest $request): JsonResponse
    {
        if (GroupOfMessages::query()
            ->where('name', $request->input('name'))
            ->exists()
        ) {
            return response()->json([
                'error' => true,
                'message' => 'group with this name already exists'
            ])->setStatusCode(409);
        }
        $group = GroupOfMessages::create($request->all());

        return response()->json([
            'success' => true,
            'id' => $group->id
        ])->setStatusCode(200);
    }

    public function update(int $id, AddGroupRequest $request): JsonResponse
    {
        $group = GroupOfMessages::findOrFail($id);
        $group->fill($request->all());
        $group->save();

        return response()->json([
            'success' => true,
            'id' => $id
        ])->setStatusCode(200);
    }

    public function delete(int $id): JsonResponse
    {
        GroupOfMessages::findOrFail($id)
            ->delete();

        return response()->json([
            'success' => true,
        ])->setStatusCode(200);
    }
}
