<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\GroupOfMessages;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class GroupOfMessagesTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_all_groups()
    {
        $response = $this->getJson(route('groups.all'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'groups'
        ]);
    }

    public function test_add_group_with_empty_name(): void
    {
        $response = $this->postJson(route('groups.add'), [
        ]);

        $response->assertStatus(422);
    }

    public function test_add_group(): void
    {
        $name = Str::random(100);
        $this->assertEquals(0, GroupOfMessages::query()-> where('name', $name)->count());
        $response = $this->postJson(route('groups.add'), [
           'name' => $name
        ]);

        $response->assertStatus(200);
        $this->assertEquals(1, GroupOfMessages::query()-> where('name', $name)->count());
    }

    public function test_add_group_if_name_exists(): void
    {
        $group = GroupOfMessages::factory()->create();
        $this->assertEquals(1, GroupOfMessages::query()-> where('name', $group->name)->count());

        $response = $this->postJson(route('groups.add'), [
            'name' => $group->name
        ]);

        $response->assertStatus(409);
        $this->assertEquals(1, GroupOfMessages::query()-> where('name', $group->name)->count());
    }

    public function test_delete_group()
    {
        $group = GroupOfMessages::factory()->create();
        $this->assertEquals(1, GroupOfMessages::query()-> where('name', $group->name)->count());

        $response = $this->deleteJson(route('groups.delete', $group->id), [
        ]);

        $response->assertStatus(200);
        $this->assertEquals(0, GroupOfMessages::query()-> where('name', $group->name)->count());
    }

    public function test_delete_group_if_not_exists()
    {
        $id = mt_rand(1, 100);
        $this->assertEquals(0, GroupOfMessages::query()-> where('id', $id)->count());

        $response = $this->deleteJson(route('groups.delete', $id), [
        ]);

        $response->assertStatus(404);
    }

    public function test_update_group()
    {
        $group = GroupOfMessages::factory()->create();
        $this->assertEquals(1, GroupOfMessages::query()-> where('name', $group->name)->count());
        $newName = Str::random(10);
        $this->assertEquals(0, GroupOfMessages::query()-> where('name', $newName)->count());


        $response = $this->patchJson(route('groups.update', $group->id), [
            'name' => $newName
        ]);

        $response->assertStatus(200);
        $this->assertEquals(1, GroupOfMessages::query()-> where('name', $newName)->count());

    }
}
