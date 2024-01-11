<?php

namespace App\Http\Controllers;

use App\Bus\CommandBusContract;
use App\Bus\QueryBusContract;
use App\Http\Requests\AddGroupRequest;
use Illuminate\Http\JsonResponse;
use Modules\GroupOfMessages\Commands\CreateGroupOfMessagesCommand;
use Modules\GroupOfMessages\Commands\DeleteGroupOfMessagesCommand;
use Modules\GroupOfMessages\Commands\UpdateGroupOfMessagesCommand;
use Modules\GroupOfMessages\Queries\FindAllGroupOfMessagesQuery;
use Modules\GroupOfMessages\Queries\FindGroupOfMessagesQuery;
use Modules\GroupOfMessages\ValueObjects\GroupName;

class GroupOfMessagesController extends Controller
{
    public function __construct(
        protected readonly CommandBusContract $commandBus,
        protected readonly QueryBusContract $queryBus
    ) {
    }

    public function index(int $id): JsonResponse
    {
        $group = $this->queryBus->ask(
            new FindGroupOfMessagesQuery($id)
        );

        return response()->json([
            'success' => true,
            'group' => $group->toArray()
        ])->setStatusCode(200);
    }


    public function all(): JsonResponse
    {
        $groups = $this->queryBus->ask(
            new FindAllGroupOfMessagesQuery()
        );

        return response()->json([
            'success' => true,
            'groups' => $groups
        ])->setStatusCode(200);
    }

    public function add(AddGroupRequest $request): JsonResponse
    {
        $groupId = $this->commandBus
            ->dispatch(
                new CreateGroupOfMessagesCommand(
                    GroupName::from($request->input('name'))
                )
            );

        return response()->json([
            'success' => true,
            'id' => $groupId
        ])->setStatusCode(200);
    }

    public function update(int $id, AddGroupRequest $request): JsonResponse
    {
        $groupId = $this->commandBus
            ->dispatch(
                new UpdateGroupOfMessagesCommand(
                    $id,
                    GroupName::from($request->input('name'))
                )
            );

        return response()->json([
            'success' => true,
            'id' => $groupId
        ])->setStatusCode(200);
    }

    public function delete(int $id): JsonResponse
    {
        $this->commandBus
            ->dispatch(
                new DeleteGroupOfMessagesCommand(
                    $id,
                )
            );

        return response()->json([
            'success' => true,
        ])->setStatusCode(200);
    }
}
