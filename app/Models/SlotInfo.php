<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $slot_info_id
 * @property int $slot_id
 * @property string $name
 * @property string $description
 * @property int $capacity
 * @property int $price
 *
 * @property-read Slot $slot
 */
class SlotInfo extends Model
{
    protected $table = 'slot_info';

    protected $fillable = [
        'slot_id',
        'name',
        'description',
        'capacity',
        'price',
    ];

    public function slot(): BelongsTo
    {
        return $this->belongsTo(Slot::class);
    }
}
