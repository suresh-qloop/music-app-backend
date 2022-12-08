<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Users extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'pwd',
        'reg_date',
        'latest_pts',
        'total_pts',
        'lat_pts_date'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}