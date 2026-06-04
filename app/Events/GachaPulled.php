<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GachaPulled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * Create a new event instance.
     */
    public function __construct(public int $userId,
                                public string $itemName,
                                public string $rarity){}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('gacha.dashboard')
        ];
    }

    public function broadcastAs(): string
    {
        return 'gacha.pulled';
    }

    public function broadcastWith(): array
    {
        return [
            'user_id' => $this->userId,
            'item_name' => $this->itemName,
            'rarity' => $this->rarity,
            'timestamp' => now()->format('H:i:s')
        ];
    }
}
