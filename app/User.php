<?php

namespace App;

use Carbon\CarbonInterval;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPassword as ResetPasswordNotification;


class User extends Authenticatable
{
	use HasApiTokens, HasRoles, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $guard_name = "web";
	protected $append = [
		'name',
	];

	protected $fillable = [
		'username',
		'first_name',
		'last_name',
		'created_by',
		'restaurant_id',
		'dob',
		'device_token',
		'status',
		'email',
		'password',
		'api_token',
		'address',
		'phone_number',
		'profile_picture',
		'latitude',
		'longitude',
		'device_type',
		'device_id',
		'device_name',
		'app_version',
		'language_code',
		'cnic',
		'cnic_expire_date',
		'city_id',
		'state_id',
		'country_id',
		'user_type',
		'is_verified',
		'type'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function getNameAttribute()
	{
		return $this->first_name;
	}

	public function getPoints()
	{
		return 1500;
	}

	public function getRestaurant()
	{
		return $this->hasOne(Restaurant::class, 'id', 'restaurant_id');
	}
	public function getorderAddressAttribute()
	{
		$data = Order::where('user_id', $this->id)->select('customer_address')->first();
		if($data)
			return $data->customer_address;
		else 
			return " ";
	}
	public function getRatingAttribute()
	{
		return Review::where('user_id', $this->id)->avg('rating', 2);
	}
	public function createdBY()
	{
		return $this->hasOne(Auth::class, 'id', 'created_by');
	}

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function state()
	{
		return $this->belongsTo(State::class);
	}

	public function city()
	{
		return $this->belongsTo(City::class);
	}

	public function vehicle()
	{
		return $this->hasOne(RiderDetail::class, 'rider_id', 'id');
	}

	public function getRiderStatus()
	{
		return $this->hasOne(RiderStatus::class, 'rider_id', 'id')
			->where('status', '=', 1);
	}

	public function getOrderCountAttribute()
	{
		return Order::where('user_id', $this->id)->where('status', 6)->count();
	}

	public function getRiderOrderCountAttribute()
	{
		return OrderAssigned::where('rider_id', $this->id)
			->where('trip_status_id', 5)->count();
	}

	public function getRiderAverageAttribute()
	{
		$odr_ids = OrderAssigned::where('rider_id', $this->id)
			->where('trip_status_id', 5)->pluck('order_id');

		$averageCompletionTime = DB::table('orders')
			->select(DB::raw("AVG(TIME_TO_SEC(TIMEDIFF(updated_at, created_at))) AS timediff"))
			->where('status', 6)
			->whereIn('id', $odr_ids)
			->get();
		return CarbonInterval::seconds((int)$averageCompletionTime[0]->timediff)
			->cascade()
			->forHumans();
	}

	public function getRiderAverageTimeAttribute()
	{
		$odr_ids = OrderAssigned::where('rider_id', $this->id)
			->where('trip_status_id', 5)->pluck('order_id');

		$averageCompletionTime = DB::table('orders')
			->select(DB::raw("AVG(TIME_TO_SEC(TIMEDIFF(updated_at, created_at))) AS timediff"))
			->where('status', 6)
			->whereIn('id', $odr_ids)
			->get();
		return CarbonInterval::seconds((int)$averageCompletionTime[0]->timediff)
			->cascade()
			->forHumans();
	}

	public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token));
    }
}
