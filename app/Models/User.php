<?php

namespace App\Models;

use App\Mail\UserLogin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use Str;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 *
 * @property-read Collection<Slot> $slots
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function slots(): HasManyThrough
    {
        return $this->hasManyThrough(Slot::class, SlotToUser::class, 'user_id', 'id', null, 'user_id');
    }

    public function loginTokens(): HasMany
    {
        return $this->hasMany(LoginToken::class);
    }

    public function sendLoginLink()
    {
        $textToken = Str::random(32);
        $expiresAt = now()->addMinutes(15);

        $this->loginTokens()->create([
            'token' => hash('sha256', $textToken),
            'expires_at' => $expiresAt,
        ]);

        $url = \URL::temporarySignedRoute('verify-login', $expiresAt, [
            'token' => $textToken,
        ]);

        Mail::to($this->email)->queue(new UserLogin($textToken, $expiresAt));
    }
}
