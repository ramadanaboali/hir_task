<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject, CanResetPassword
{
    use SoftDeletes;
    use Notifiable;
    use HasRoles;
    public $appends=['logo'];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $guarded = [];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getLogoAttribute()
    {
        return array_key_exists("photo",$this->attributes)  && $this->attributes['photo'] ? asset('user/images/'.$this->attributes['photo']): null;
    }


    public function scopeAvailable($builder)
    {
        $builder->where(function ($query) {
            $query->where('parent_id', primaryID());
            $query->orWhere('id', auth()->id());
        });

        return $builder;
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'parent_id');
    }



    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }
    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region', 'region_id', 'id');
    }


}
