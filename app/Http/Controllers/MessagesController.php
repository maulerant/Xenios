<?php

namespace App\Http\Controllers;

use App\Bus\CommandBusContract;
use App\Bus\QueryBusContract;
use App\Http\Requests\AddMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\GroupOfMessages;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Modules\Message\Commands\CreateMessageCommand;
use Modules\Message\Commands\DeleteMessageCommand;
use Modules\Message\Commands\UpdateMessageCommand;
use Modules\Message\Queries\FindMessageByGroupQuery;
use Modules\Message\ValueObjects\GroupId;

class MessagesController extends Controller
{
    public function __construct(
        protected readonly CommandBusContract $commandBus,
        protected readonly QueryBusContract $queryBus
    ) {
    }
    public function index(int $groupId): JsonResponse
    {
        /** @var Collection $messages */
        $messages = $this->queryBus
            ->ask(
                new FindMessageByGroupQuery(
                    GroupId::from($groupId)
                )
            );

        return response()->json([
            'success' => true,
            'messages' => $messages->toArray()
        ]);
    }

    public function add(AddMessageRequest $request): JsonResponse
    {
        $id = $this->commandBus
            ->dispatch(
                new CreateMessageCommand(
                    groupId: GroupId::from($request->input('group_id')),
                    user: $request->input('user'),
                    text: $request->input('text')

                )
            );

        return response()->json([
            'success' => true,
            'message_id' => $id
        ]);
    }

    public function update(int $id, UpdateMessageRequest $request): JsonResponse
    {
        $id = $this->commandBus
            ->dispatch(
                new UpdateMessageCommand(
                    id: $id,
                    text: $request->input('text')

                )
            );
        return response()->json([
            'success' => true,
            'message_id' => $id
        ]);
    }

    public function delete(int $id): JsonResponse
    {
        $this->commandBus
            ->dispatch(
                new DeleteMessageCommand(
                    id: $id,
                )
            );

        return response()->json([
            'success' => true,
        ]);
    }
}
