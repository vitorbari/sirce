<?php namespace Sirce\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'avatar', 'location', 'about', 'newsletter', 'oauth_resource'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function getAvatarAttribute($value)
	{
		return $value ?: asset('img/blank-profile-hi.png');
	}

    /**
     * User __has_many__ references
     *
     * @return mixed
     */
    public function references()
    {
        return $this->hasMany('Sirce\Models\Reference')->whereNotNull('published_at');
    }

    /**
     * User __has_many__ references
     *
     * @return mixed
     */
    public function myReferences()
    {
        return $this->hasMany('Sirce\Models\Reference');
    }

    /**
     * User __belongs_to_many__ Favorites References
     *
     * @return mixed
     */
    public function favorites()
    {
        return $this->belongsToMany('Sirce\Models\Reference', 'user_favorites')
			->whereNotNull('published_at')
			->withTimestamps();
    }

}
