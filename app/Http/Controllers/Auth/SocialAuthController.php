<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserSocialToken;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hybridauth\Hybridauth;

class SocialAuthController extends Controller
{
    public function githubLogin()
    {
        $config = $this->getConfig('github');
        $hybridauth = new Hybridauth($config);
        $github = $hybridauth->authenticate('GitHub');

        $dades = $this->getDadesGithub($github);

        //comprovar si existe el token en social_tokens o el social_id
        $socialToken = UserSocialToken::where('token', $dades['gitToken'])
            ->orWhere('social_id', $dades['gitId'])
            ->first();

        if ($socialToken) {
            $user = $socialToken->user;

            // Canviar-lo si no esta updatejat
            if ($socialToken->token !== $dades['gitToken']) {
                $socialToken->update(['token' => $dades['gitToken']]);
            }

            Auth::login($user);
            $github->disconnect(); // Close session
            return redirect()->route('home')->with('success', config('messages.success_l1'));
        }

        // crear si no existia
        $username = 'user' . uniqid();
        $user = User::create([
            'user' => $username,
            'name' => $dades['gitName'],
            'email' => $dades['gitEmail'],
            'isSocial' => true,
            'isAdmin' => false,
        ]);

        $user->socialTokens()->create([
            'social_id' => $dades['gitId'],
            'token' => $dades['gitToken'],
            'provider' => 'github',
        ]);

        Auth::login($user);
        $apiResponse = $github->apiRequest('gists');
        $github->disconnect();
        return redirect()->route('home')->with('success', config('messages.success_l1'));
    }

    private function getDadesGithub($github)
    {
        return [
            'gitId' => $github->getUserProfile()->identifier,
            'gitEmail' => $github->getUserProfile()->email,
            'gitToken' => $github->getAccessToken()['access_token']
        ];
    }

    private function getConfig($social)
    {
        if ($social === 'github') {
            return [
                'callback' => config('services.github.redirect'),
                'providers' => [
                    'GitHub' => [
                        'enabled' => true,
                        'keys' => [
                            'id' => config('services.github.client_id'),
                            'secret' => config('services.github.client_secret'),
                        ],
                        'scope' => 'user:email',
                    ]
                ],
            ];
        }
    }

}