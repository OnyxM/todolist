<?php

namespace App\Http\Controllers;

use App;
use App\Constant;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Token;
use App\User;
use App\Utils\Api;
use Illuminate\Http\Request;
use JWTAuth;

class AuthController extends Controller
{
	public function __construct(){
		$this->middleware('auth:api', ['except' => ['login','register']]);
	}

	/**
	 * Login a user an return the token
	 */
	public function login(LoginRequest $request){
		$credentials = request(['email', 'password']);

        if (! ($token = auth()->attempt($credentials))) {
        	return response()->json(['error' => 'Unauthorized'], 401);
        }

        Api::createLog("The user logged in.");

        return Api::respondWithToken($token);
	}

	public function register(RegisterRequest $request){
		$name = $request->name;
		$email = $request->email;
		$password = $request->password;

		// Gérer l'unicité de l'email avant de créer le user ...

		$user = User::create([
			'name' => $name,
			'email' => $email,
			'password' => bcrypt($password),
		]);
		// echo $user->id; die;

		Api::createLog("User successfully created.", [], $user->id);

        return Api::respondSuccess([], "User successfully created. Go to Login now ..");
	}

	/**
	 * Les infos de l'authentifié
	 */
	public function me(){
		return response()->json(auth()->user());
	}
}
