<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

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

    public function setPasswordAttribute($value){
        if($value){
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function notifications() {
        return $this->morphMany(Notification::class, 'Notifiable');
    }

    /**
     * Reset the user's password.
     *
     * @param string $password
     * @return void
     */

    public function resetPassword(string $password): void {
        //forceFill :This method allows you to mass-assign attributes to the model, even if they are not in the $fillable array.
        $this->forceFill([
            'password' => Hash::make($password),
        ])->setRememberToken(Str::random(60));

        $this->save();

        // Trigger the PasswordReset event
        event(new PasswordReset($this));
    }

    /**
     * Check if the password reset token is valid.
     *
     * @param string $token
     * @return bool
     */
    public function isValidPasswordResetToken(string $token): bool {
        //getRepository(): this retrieves the repository responsible for managing password reset tokens.
        return Password::getRepository()->exists($this, $token);
    }

}
