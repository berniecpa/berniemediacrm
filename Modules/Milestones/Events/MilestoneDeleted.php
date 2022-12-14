<?php

namespace Modules\Milestones\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Milestones\Entities\Milestone;

class MilestoneDeleted
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $milestone;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Milestone $milestone)
    {
        $this->milestone = $milestone;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
