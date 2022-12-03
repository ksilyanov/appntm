<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $slot_type_id
 * @property string $name
 *
 * @property-read Collection $slots
 */
class SlotType extends Model
{
    protected $table = 'slot_type';

    protected $fillable = [
        'name',
    ];

    public function slots(): BelongsToMany
    {
        return $this->belongsToMany(Slot::class, $this->table, $this->getKeyName(), $this->getKeyName(), null, 'type_id');
    }
}
