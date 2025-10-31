<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail,HasMedia
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    use NodeTrait;
    use HasRoles;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
        'location',
        'active',
        'created_by_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'avatar',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    public function schedules(): User|HasMany
    {
        return $this->hasMany(Schedule::class, 'broker_id');
    }

    public function properties(): User|HasMany
    {
        return $this->hasMany(Property::class, 'broker_id');
    }

    public function receivedMessages(): User|HasMany
    {
        return $this->hasMany(Message::class, 'to_id');
    }

    public function sentMessages(): User|HasMany
    {
        return $this->hasMany(Message::class, 'from_id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width('200')->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')->withResponsiveImages()->singleFile();
    }

    public function getAvatarAttribute()
    {
        return $this->getFirstMedia('avatars');
    }

    public static function last()
    {
        return static::all()->last();
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'created_by_id');
    }

    public function createdUsers(): User|HasMany
    {
        return $this->children();
    }
}
