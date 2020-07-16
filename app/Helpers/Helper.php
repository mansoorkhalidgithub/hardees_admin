<?php

namespace app\Helpers;

use App\User;
use App\Rider;
use App\State;
use App\Category;
use App\Restaurant;
use App\PaymentMethod;
use App\CurrencySymbols;
use App\Order;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class Helper
{
    public static function orderReference($value)
    {
        $orderReference = str_pad($value, 8, "0", STR_PAD_LEFT);

        return strtoupper($orderReference);
    }

    public static function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public static function getStates()
    {
        return State::where('country_id', 166)
            ->where('status', Config::get('constants.STATUS_ACTIVE'))->get();
    }

    public static function getCities()
    {
        return DB::table('cities')
            ->whereIn('state_id', [2722, 2723, 2724, 2725, 2726, 2727, 2728, 2729])
            ->get();
    }

    public static function getCategoriesCount()
    {
        return Category::get()->count();
    }

    public static function getCategories()
    {
        return Category::all(['id', 'title']);
    }

    public static function getRidersCount()
    {
        return Rider::get()->count();
    }

    public static function getDeliveryCount()
    {
        return Order::get();
    }

    public static function getPaymentMethods()
    {
        return PaymentMethod::all();
    }

    public static function getRestaurants()
    {
        return Restaurant::all();
    }

    public static function roles()
    {
        return Role::select('id', 'name')->get();
    }

    public static function branch()
    {
        return Restaurant::select('id', 'name')->get();
    }

    public static function getCompleteDeliveries()
    {
        $total = 0;

        $totalOrders = Order::all()->count();
        $complete = Order::where('status', 10)->count();

        if ($totalOrders > 0)
            $total = $complete / $totalOrders * 100;

        return $total;
    }
}
