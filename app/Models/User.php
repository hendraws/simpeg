<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Wildside\Userstamps\Userstamps;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, LogsActivity, HasRoles , Userstamps,  SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    	'name',
    	'email',
    	'password',
    	'is_active',
    ];

    protected static $logAttributes = [
    	'name',
    	'email',
    	'password',
    	'is_active',
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

    public function getProfile(){
    	return $this->belongsTo(Lamaran::class, 'id','user_id');
    }
}
