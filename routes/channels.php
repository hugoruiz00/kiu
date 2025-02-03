<?php

use App\Models\Business;
use App\Models\QueueEntry;
use Illuminate\Support\Facades\Broadcast;

// Broadcast::routes([
//     'middleware' => ['web', 'authenticate-guest'],
// ]);

Broadcast::channel('business.{business_id}', function ($business_id) {
    return true;
});