<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\User\Services\UserService;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);

        } catch (ValidationException $e) {
            return $this->getResponseJson(self::ERROR, ['errors' => $e->errors()]);
        }

        $query = $this->userService->register($request);
        if ($query) {
            return $this->getResponseJson(self::SUCCESS, $query);
        } else {
            return $this->getResponseJson(self::ERROR, $this->setMessage('something went wrong!'));
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $query = $this->userService->login($request);
        if ($query) {
            return $this->getResponseJson(self::SUCCESS, $query);
        } else {
            return $this->getResponseJson(self::ERROR, $this->setMessage('something went wrong!'));
        }
    }




}
