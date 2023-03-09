<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Qirolab\Laravel\Reactions\Traits\Reacts;
use Qirolab\Laravel\Reactions\Contracts\ReactsInterface;

class User extends Authenticatable implements HasMedia, ReactsInterface
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, Reacts;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'fcm_token'
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')
            ->singleFile()
            ->useFallbackUrl('assets/img/avatars/unknown-avatar.jpeg')
            ->useFallbackPath(public_path('assets/img/avatars/unknown-avatar.jpeg'));
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function bio()
    {
        return $this->hasOne(Bio::class, 'user_id', 'id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'user_relationships', 'follower_id', 'following_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_relationships', 'following_id', 'follower_id');
    }

    public function follow(User $user)
    {
        $this->following()->attach($user->id);
    }

    public function unfollow(User $user)
    {
        $this->following()->detach($user->id);
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('id', $user->id)->exists();
    }

    public function postsFromFollowing()
    {

        // Retrieve the IDs of the users that this user follows
        $followedIds = $this->following()->pluck('id');

        // Retrieve the posts created by the followed users
        return Post::whereIn('user_id', $followedIds)->get();
        // return Post::whereIn('user_id', $this->following()->pluck('id'))->get();
    }
}
