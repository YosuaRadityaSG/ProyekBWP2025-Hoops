<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key dari tabel
    public $timestamps = false; // Tidak menggunakan kolom created_at dan updated_at

    protected $fillable = [
        'role_id',
        'email',
        'nickname',
        'birth_date',
        'gender',
        'country',
        'friend_preference_gender',
        'friend_preference_location',
        'profile_picture_url',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'interest_user');
    }
}