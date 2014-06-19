<?php namespace src\Models;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends AbstractBaseModel implements UserInterface, RemindableInterface {

    /**
     * Attributes protected from mass assignment
     *
     * @link http://laravel.com/docs/eloquent#mass-assignment
     */
    protected $guarded = array('id', 'created_at', 'updated_at');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

    public static $rules = array(
		'username' => 'required|min:5|unique:users',
		'email' => 'required|email|unique:users',
		'password' => 'required|confirmed|min:5'
    );

    public static $update_rules = array(
        'username'   => 'sometimes|required',
        'email'        => 'sometimes|required|email',
    );

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
    }



	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier() {
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword() {
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail() {
		return $this->email;
	}

	public function product() {
		return $this->hasMany('Product');
	}

	public function bitcoin() {
		return $this->hasMany('Bitcoin');
	}

	public function purchase_user_buyer() {
		return $this->hasMany('Purchase', 'buyer_id');
	}

	public function purchase_user_owner() {
		return $this->hasMany('Purchase', 'seller_id');
	}

	public function successfulpurchases() {
		return $this->hasMany('SuccessfulPurchase');
	}

    public function getRules() {
        return static::$rules;
    }

    public function getUpdateRules() {
        $update_rules = static::$update_rules;

        if (isset($this->id)) {
            $update_rules['email'] = 'sometimes|required|email|unique:users,email,'.$this->id;
        }

        return $update_rules;
    }


}
