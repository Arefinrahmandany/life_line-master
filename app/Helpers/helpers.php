<?php

use App\Helpers\ImageHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

if (!function_exists('format_date')) {
    function format_date($dateString, $format) {
        if (!$dateString) return null;
        return Carbon::parse($dateString)->format($format);
    }
}

if (!function_exists('format_datetime')) {
    function format_datetime($dateTime) {
        if (!$dateTime) return null;
        return date('h:i A - d M, Y', strtotime($dateTime));
    }
}

if (!function_exists('getTodayName')) {
    function getTodayName(): string
    {
       return strtolower( Carbon::now()->format('l'));
    }
}

if(!function_exists('percentage_calculation')){
    function percentage_calculation($percentage,$amount){
        return ($percentage / 100) * $amount;
    }
}

if (!function_exists('current_user')) {
    function current_user(): ?User
    {
//       return Cache::remember('user_'.auth()->user()->id, cache_remember_time(), function (){
//            return User::current();
//        });
        return User::current();
    }
}

if (!function_exists('storage_url')) {
    function storage_url($path): string
    {
        return Storage::disk()->url($path);
    }
}

if (!function_exists('user_profile_photo')) {
    function user_profile_photo($user): string
    {
        return ImageHelper::getUserProfileImage($user);
    }
}

if (!function_exists('bdt_format')) {
    function bdt_format($value): string
    {
        return number_format($value,2).' ৳';
    }
}

if (!function_exists('money_format')) {
    function money_format($value): string
    {
        return number_format($value,2);
    }
}

if (!function_exists('cache_remember_time')) {
    function cache_remember_time($value=60*60*8760): string
    {
        return $value;
    }
}

function encryptDecryptMS($string, $action = 'encrypt')
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
    $secret_iv = '5fgf5HJ5g27'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

if (!function_exists('order_number_generate')) {
    function order_number_generate(): string
    {
        $length = 8;
        $characters = current_user()->id.current_user()->phone.'-'.current_user()->first_name.current_user()->last_name;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

