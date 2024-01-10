<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\GroupOfMessages;
use App\Models\Message;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class MessagesControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_all_messages_of_groups()
    {
        $group = GroupOfMessages::factory()->create();

        Message::factory(10)->create([
            'group_id' => $group->id
        ]);

        $response = $this->getJson(route('messages.ofGroup', $group->id));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'messages'
        ]);
        $this->assertEquals(10, count($response->json('messages')));
    }

    public function test_add_message_if_group_not_exists(): void
    {
        $groupId = mt_rand(1, 1000);
        $this->assertEquals(0, GroupOfMessages::query()->find($groupId));

        $countMessages = Message::query()
            ->count();
        $response = $this->postJson(route('messages.add'), [
            'user' => Str::random('10'),
            'group_id' => $groupId,
            'text' => Str::random(100)
        ]);

        $response->assertStatus(422);
        $this->assertEquals($countMessages, Message::query()->count());
    }

    public function test_add_message(): void
    {
        $group = GroupOfMessages::factory()->create();
        $countMessages = Message::query()
            ->where('group_id', $group->id)
            ->count();

        $response = $this->postJson(route('messages.add'), [
            'user' => Str::random('10'),
            'group_id' => $group->id,
            'text' => Str::random(100)
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message_id'
        ]);
        $this->assertEquals(
            $countMessages + 1,
            Message::query()
                ->where('group_id', $group->id)
                ->count()
        );
    }

    public function test_delete_message_if_not_exists()
    {
        $messageId = mt_rand(1, 1000);
        $this->assertEquals(0, Message::query()->where('id', $messageId)->count());

        $response = $this->deleteJson(route('messages.delete', $messageId), [
        ]);

        $response->assertStatus(404);
    }

    public function test_delete_message()
    {
        $message = Message::factory()->create();

        $response = $this->deleteJson(route('messages.delete', $message->id), [
        ]);

        $response->assertStatus(200);
        $this->assertEquals(0, Message::query()->where('id', $message->id)->count());
    }


    public function test_update_message()
    {
        $message = Message::factory()->create();
        $newText = Str::random(10);
        $this->assertEquals(0, Message::query()->where('text', $newText)->count());


        $response = $this->patchJson(route('messages.update', $message->id), [
            'text' => $newText
        ]);

        $response->assertStatus(200);
        $this->assertEquals(
            1,
            Message::query()->where([
                'id' => $message->id,
                'text' => $newText
            ])->count()
        );
    }
}
