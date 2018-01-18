<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id', 'id');
    }

    /**
     * Check user in group administrator
     *
     * @var array
     */
    public function is_admin()
    {
        if ($this->group->group == "administrator") {
            return true;
        }

        return false;
    }
}
