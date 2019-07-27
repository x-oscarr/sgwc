<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Invisnik\LaravelSteamAuth\SteamAuth;
use Syntax\SteamApi\Facades\SteamApi;
use App\User;
use Auth;

class AuthController extends Controller
{
    /**
     * The SteamAuth instance.
     *
     * @var SteamAuth
     */
    protected $steam;

    /**
     * The redirect URL.
     *
     * @var string
     */
    protected $redirectURL = '/profile';

    /**
     * AuthController constructor.
     *
     * @param SteamAuth $steam
     */
    public function __construct(SteamAuth $steam)
    {
        $this->steam = $steam;
    }

    /**
     * Redirect the user to the authentication page
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectToSteam()
    {
        return $this->steam->redirect();
    }

    /**
     * Get user info and log in
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle()
    {
        if ($this->steam->validate()) {
            $info = $this->steam->getUserInfo();

            if (!is_null($info)) {
                $user = $this->findOrNewUser($info);
                Auth::login($user, true);

                return redirect($this->redirectURL); // redirect to site
            }
        }
        return $this->redirectToSteam();
    }

    /**
     * Getting user by info or created if not exists
     *
     * @param $info
     * @return User
     */
    protected function findOrNewUser($info)
    {
        $user = User::where('steamid', $info->steamID64)->first();

        if (!is_null($user)) {
            $user->username = $info->personaname;
            $user->steamid = $info->steamID64;
            $user->avatar = $info->avatarfull;
            $user->avatar_md = $info->avatarmedium;
            $user->avatar_sm = $info->avatar;
            $user->url = $info->profileurl;
            $user->realname = $info->realname;
            $user->location = $info->loccountrycode;
            $user->save();
            return $user;
        }

        return User::create([
            'username' => $info->personaname,
            'steamid' => $info->steamID64,
            'avatar' => $info->avatarfull,
            'avatar_md' => $info->avatarmedium,
            'avatar_sm' => $info->avatar,
            'url' => $info->profileurl,
            'realname' => $info->realname,
            'location' => $info->loccountrycode,
            'steam32' => SteamApi::convertId($info->steamID64, 'ID32'),
            'steam3' => SteamApi::convertId($info->steamID64, 'ID3'),
        ]);
    }
}


