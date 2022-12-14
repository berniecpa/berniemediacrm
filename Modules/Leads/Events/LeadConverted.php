<?php

namespace Modules\Leads\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Leads\Entities\Lead;

class LeadConverted
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $lead;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Lead $lead, $user)
    {
        $this->lead = $lead;
        $this->user = $user;
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
