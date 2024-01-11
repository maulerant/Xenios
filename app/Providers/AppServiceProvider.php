<?php

namespace App\Providers;

use App\Bus\CommandBusContract;
use App\Bus\IlluminateCommandBus;
use App\Bus\IlluminateQueryBus;
use App\Bus\QueryBusContract;
use Illuminate\Support\ServiceProvider;
use Modules\GroupOfMessages\Commands\CreateGroupOfMessageCommandHandler;
use Modules\GroupOfMessages\Commands\CreateGroupOfMessagesCommand;
use Modules\GroupOfMessages\Commands\DeleteGroupOfMessageCommandHandler;
use Modules\GroupOfMessages\Commands\DeleteGroupOfMessagesCommand;
use Modules\GroupOfMessages\Commands\UpdateGroupOfMessageCommandHandler;
use Modules\GroupOfMessages\Commands\UpdateGroupOfMessagesCommand;
use Modules\GroupOfMessages\Queries\FindAllGroupOfMessageQueryHandler;
use Modules\GroupOfMessages\Queries\FindAllGroupOfMessagesQuery;
use Modules\GroupOfMessages\Queries\FindGroupOfMessageQueryHandler;
use Modules\GroupOfMessages\Queries\FindGroupOfMessagesQuery;
use Modules\GroupOfMessages\Repositories\ReadGroupOfMessagesRepository;
use Modules\GroupOfMessages\Repositories\ReadGroupOfMessagesRepositoryContract;
use Modules\GroupOfMessages\Repositories\WriteGroupOfMessagesRepository;
use Modules\GroupOfMessages\Repositories\WriteGroupOfMessagesRepositoryContract;
use Modules\Message\Commands\CreateMessageCommand;
use Modules\Message\Commands\CreateMessageCommandHandler;
use Modules\Message\Commands\DeleteMessageCommand;
use Modules\Message\Commands\DeleteMessageCommandHandler;
use Modules\Message\Commands\UpdateMessageCommand;
use Modules\Message\Commands\UpdateMessageCommandHandler;
use Modules\Message\Queries\FindMessageByGroupQuery;
use Modules\Message\Queries\FindMessageByGroupQueryHandler;
use Modules\Message\Queries\FindMessageQuery;
use Modules\Message\Queries\FindMessageQueryHandler;
use Modules\Message\Repositories\ReadMessageRepository;
use Modules\Message\Repositories\ReadMessageRepositoryContract;
use Modules\Message\Repositories\WriteMessageRepository;
use Modules\Message\Repositories\WriteMessageRepositoryContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CommandBusContract::class, IlluminateCommandBus::class);
        $this->app->singleton(QueryBusContract::class, IlluminateQueryBus::class);
        $this->app->singleton(WriteGroupOfMessagesRepositoryContract::class, WriteGroupOfMessagesRepository::class);
        $this->app->singleton(ReadGroupOfMessagesRepositoryContract::class, ReadGroupOfMessagesRepository::class);
        $this->app->singleton(ReadMessageRepositoryContract::class, ReadMessageRepository::class);
        $this->app->singleton(WriteMessageRepositoryContract::class, WriteMessageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /** @var CommandBusContract $commandBus */
        $commandBus = app(CommandBusContract::class);
        $commandBus->register([
            CreateGroupOfMessagesCommand::class => CreateGroupOfMessageCommandHandler::class,
            UpdateGroupOfMessagesCommand::class => UpdateGroupOfMessageCommandHandler::class,
            DeleteGroupOfMessagesCommand::class => DeleteGroupOfMessageCommandHandler::class,

            CreateMessageCommand::class => CreateMessageCommandHandler::class,
            UpdateMessageCommand::class => UpdateMessageCommandHandler::class,
            DeleteMessageCommand::class => DeleteMessageCommandHandler::class
        ]);

        /** @var QueryBusContract $queryBus */
        $queryBus = app(QueryBusContract::class);
        $queryBus->register([
            FindGroupOfMessagesQuery::class => FindGroupOfMessageQueryHandler::class,
            FindAllGroupOfMessagesQuery::class => FindAllGroupOfMessageQueryHandler::class,
            FindMessageQuery::class => FindMessageQueryHandler::class,
            FindMessageByGroupQuery::class => FindMessageByGroupQueryHandler::class
        ]);
    }
}
