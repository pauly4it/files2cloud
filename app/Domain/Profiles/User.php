<?php namespace App\Domain\Profiles;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract {

    use Authenticatable;

    protected $table = 'users';
    protected $fillable = ['username', 'password', 'remember_token'];
    protected $hidden = ['password'];

    /**
     * Relationships
     */
    public function files()
    {
        return $this->hasMany('App\Domain\Files\File');
    }

}
