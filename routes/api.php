<?php

use App\Http\Controllers\GroupOfMessagesController;
use App\Http\Controllers\MessagesController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => 'groups'
], function (Router $router) {
    $router->get('{id}', [GroupOfMessagesController::class, 'index'])
        ->name('groups.get');
    $router->get('', [GroupOfMessagesController::class, 'all'])
        ->name('groups.all');
    $router->post('', [GroupOfMessagesController::class, 'add'])
        ->name('groups.add');
    $router->patch('{id}', [GroupOfMessagesController::class, 'update'])
        ->name('groups.update');
    $router->delete('{id}', [GroupOfMessagesController::class, 'delete'])
        ->name('groups.delete');
});

Route::group([
    'prefix' => 'messages'
], function (Router $router) {
    $router->get('{groupId}', [MessagesController::class, 'index'])
        ->name('messages.ofGroup');
    $router->post('', [MessagesController::class, 'add'])
        ->name('messages.add');
    $router->patch('{id}', [MessagesController::class, 'update'])
        ->name('messages.update');
    $router->delete('{id}', [MessagesController::class, 'delete'])
        ->name('messages.delete');
});
