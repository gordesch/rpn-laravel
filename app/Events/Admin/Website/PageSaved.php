<?php

namespace App\Events\Admin\Website;

use App\Models\Page;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PageSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Page $page;

    /**
     * Create a new event instance.
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }
}
