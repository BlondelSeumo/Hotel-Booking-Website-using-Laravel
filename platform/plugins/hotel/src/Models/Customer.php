<?php

namespace Botble\Hotel\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\Avatar;
use Botble\Hotel\Enums\ReviewStatusEnum;
use Botble\Hotel\Notifications\ConfirmEmailNotification;
use Botble\Media\Facades\RvMedia;
use Botble\Media\Models\MediaFile;
use Exception;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Customer extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use MustVerifyEmail;
    use HasApiTokens;
    use Notifiable;

    protected $table = 'ht_customers';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'avatar',
        'phone',
        'dob',
        'address',
        'zip',
        'city',
        'state',
        'country',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'first_name' => SafeContent::class,
        'last_name' => SafeContent::class,
        'email' => SafeContent::class,
        'phone' => SafeContent::class,
        'dob' => SafeContent::class,
        'address' => SafeContent::class,
        'zip' => SafeContent::class,
        'city' => SafeContent::class,
        'state' => SafeContent::class,
        'country' => SafeContent::class,
        'password' => 'hashed',
    ];

    protected function firstName(): Attribute
    {
        return Attribute::get(fn ($value) => ucfirst($value));
    }

    protected function lastName(): Attribute
    {
        return Attribute::get(fn ($value) => ucfirst($value));
    }

    protected function name(): Attribute
    {
        return Attribute::get(fn () => trim($this->first_name . ' ' . $this->last_name));
    }

    public function avatar(): BelongsTo
    {
        return $this->belongsTo(MediaFile::class)->withDefault();
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->avatar) {
                    return RvMedia::getImageUrl($this->avatar, 'thumb');
                }

                try {
                    return (new Avatar())->create(Str::ucfirst($this->name))->toBase64();
                } catch (Exception) {
                    return RvMedia::getDefaultImage();
                }
            }
        );
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new ConfirmEmailNotification());
    }

    public function hasBooked(Room $model): bool
    {
        $bookings = $this->bookings;
        $roomsBooked = [];

        foreach ($bookings as $booking) {
            $roomsBooked[] = $booking->room->room_id;
        }

        return in_array($model->getKey(), $roomsBooked);
    }

    public function hasReviewed(Room $model): bool
    {
        return $model
            ->reviews()
            ->whereNot('status', ReviewStatusEnum::REJECTED)
            ->where('customer_id', auth('customer')->id())
            ->exists();
    }

    public function canReview(Room $model): bool
    {
        if (! auth('customer')->check()) {
            return false;
        }

        if (! $this->hasBooked($model)) {
            return false;
        }

        if ($this->hasReviewed($model)) {
            return false;
        }

        return true;
    }

    protected function uploadFolder(): Attribute
    {
        return Attribute::make(
            get: function () {
                $folder = $this->getKey() ? 'customers/' . $this->getKey() : 'customers';

                return apply_filters('hotel_account_upload_folder', $folder, $this);
            }
        )->shouldCache();
    }

    protected static function booted(): void
    {
        static::deleting(function (Customer $account) {
            $folder = Storage::path($account->upload_folder);
            if (File::isDirectory($folder) && Str::endsWith($account->upload_folder, '/' . $account->getKey())) {
                File::deleteDirectory($folder);
            }
        });
    }
}
