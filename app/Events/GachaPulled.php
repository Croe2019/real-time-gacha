<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GachaPulled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $results;
    public int $userId;

    /**
     * Create a new event instance.
     */
    public function __construct(array $results, int $userId)
    {
        $this->results = $results;
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('gacha.' . $this->userId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'result';
    }

    public function broadcastWith(): array
    {
        return [
            'results' => $this->results,
        ];
    }
}
