<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserStatus;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, \Illuminate\Auth\Authenticatable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'user_name',
        'status',
        'date_of_birth'
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
            'status' => UserStatus::class,
            'date_of_birth' => 'date',
        ];
    }

    public function userrequest(){  
          return $this->hasOne(UserRequest::class, 'user_id', 'id');
    }

        public function getStatusColorAttribute()
    {
        return match ($this->status) {
            UserStatus::ACTIVE => 'success',
            UserStatus::INACTIVE => 'danger',
            UserStatus::SUSPENDED => 'warning',
            default => 'secondary',
        };
    }

    public function posts(){
          return $this->hasMany(Post::class, 'author_id', 'id');
    }
}
