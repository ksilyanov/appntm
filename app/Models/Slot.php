<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $slot_id
 * @property Carbon $from
 * @property Carbon $to
 * @property int $type_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read SlotInfo|null $info
 * @property-read SlotType|null $type
 * @property-read Collection<User> $users
 */
class Slot extends Model
{
    protected $table = 'slot';

    protected $fillable = [
        'from',
        'to',
        'type_id'
    ];

    protected $casts = [
        'from' => 'datetime',
        'to' => 'datetime',
    ];

    public function info(): HasOne
    {
        return $this->hasOne(SlotInfo::class);
    }

    public function type(): HasOne
    {
        return $this->hasOne(SlotType::class, 'id');
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, SlotToUser::class, 'slot_id', 'id');
    }
}
