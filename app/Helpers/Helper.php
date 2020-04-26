<?php

namespace app\Helpers;

use App\Category;
use App\CurrencySymbols;
use App\Rider;
use App\User;
use App\PaymentMethod;
use App\Restaurant;

class Helper
{
	public static function orderReference($value)
    {
		$orderReference = str_pad($value, 8, "0", STR_PAD_LEFT );
        
		return strtoupper($orderReference);
    }
	
    public static function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public static function getUserCount()
    {
        return User::get()->count();
    }

    public static function getRiderCount()
    {
        return Rider::get()->count();
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

    public static function getPaymentMethods()
    {
        return PaymentMethod::all();
    }

    public static function getRestaurants()
    {
        return Restaurant::all();
    }
}
