<?php

namespace App\Observers;

use App\Models\Slot;
use Exception;

class SlotObserver
{
    /**
     * Handle the Slot "deleting" event
     * @throws Exception
     */
    public function deleting(Slot $slot): void
    {
        $res = $slot->info->delete();

        if (!$res) {
            throw new Exception('Deleting slot info failed');
        }
    }
}
