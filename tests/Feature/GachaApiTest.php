<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\GachaItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GachaApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    /**
     * Gacha draw API endpoint の呼び出しテンプレート
     */
    public function test_gacha_draw_endpoint_can_be_called(): void
    {
        $user = User::factory()->create();

        GachaItem::create([
            'name' => 'Common Ticket',
            'rarity' => 1,
            'weight' => 80,
        ]);

        GachaItem::create([
            'name' => 'Rare Sword',
            'rarity' => 5,
            'weight' => 20,
        ]);

        GachaItem::create([
            'name' => 'Epic Staff',
            'rarity' => 10,
            'weight' => 5,
        ]);

        GachaItem::create([
            'name' => 'Legendary Bow',
            'rarity' => 20,
            'weight' => 1,
        ]);

        $this->actingAs($user, 'sanctum');
        $response = $this->postJson('api/gacha/draw');

        $response->assertStatus(200)
            ->assertJsonPath('status', 'success')
            ->assertJsonCount(10, 'results');

        $this->assertDatabaseCount('gacha_histories', 10);
        $this->assertDatabaseHas('gacha_histories', [
            'user_id' => $user->id,
        ]);
    }
}
