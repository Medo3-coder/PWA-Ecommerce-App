<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Passport\HasApiTokens as PassportHasApiTokens;

class User extends Authenticatable {
    // use HasApiTokens;
    use PassportHasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'role',
        'status',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function setPasswordAttribute($value) {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function notifications() {
        return $this->morphMany(Notification::class, 'Notifiable');
    }

    public function resetPassword(string $password): void {
        $this->update([
            'password'       => $password,
            'remember_token' => Str::random(60),
        ]);
    }

    public static function isValidEmail(string $email): bool {
        return DB::table('password_reset_tokens')
            ->where('email', $email)
            ->exists();
    }

    public static function isValidToken(string $email, string $token): bool {
        $tokenRecord = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (! $tokenRecord) {
            return false;
        }
        if (! hash_equals($tokenRecord->token, hash_hmac('sha256', $token, config('app.key')))) {
            return false;
        }

                                                                      // Check if the token is expired
        $tokenExpiration = config('auth.passwords.users.expire', 60); // Default: 60 minutes
        return now()->lessThanOrEqualTo(Carbon::parse($tokenRecord->created_at)->addMinutes($tokenExpiration));
    }

    public static function deleteToken(string $email): void {
        DB::table('password_reset_tokens')
            ->where('email', $email)
            ->delete();
    }

}
