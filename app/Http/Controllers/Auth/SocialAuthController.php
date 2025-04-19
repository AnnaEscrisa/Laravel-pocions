<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class SocialAuthController extends Controller
{

    private function getConfig($social)
    {
        $config = $social == 'github' ? [
            'callback' => env('GITHUB_CALLBACK'),
            'keys' => ['id' => env('GITHUB_ID'), 'secret' => env('GITHUB_SECRET')],
        ] : [
            'clientId' => env('DEVIANTART_ID'),
            'clientSecret' => env('DEVIANT_SECRET'),
            'redirectUri' => env('DEVIANT_CALLBACK')
        ];
        return $config;
    }
}