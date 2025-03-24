<?php

namespace App\Modules\User\Services;


use App\Http\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use App\Modules\User\Repositories\UserRepositoryInterface;


class UserService extends BaseService
{
    const PATH_IMAGE = '/images/users';
    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
    ) {
        $this->userRepository = $userRepository;
    }

    public function login($request)
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password,])) {
            $user = auth()->user();
            $token = $user->createToken('PersonalAccessToken')?->plainTextToken;
            return ['token' => $token];
        }

        return false;

    }

    public function register($request)
    {
        $user = $this->userRepository->create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('PersonalAccessToken')->plainTextToken;
        return ['token' => $token];
    }

    public function upload($request)
    {
        $userId = auth()?->user()?->id;
        $this->userRepository->update($userId, [
            'id_path' => $this->uploadFile(self::PATH_IMAGE, $request->file('id')),
            'proof_of_address_path' => $this->uploadFile(self::PATH_IMAGE, $request->file('proof_of_address')),

        ]);
        $user = $this->userRepository->find($userId);
        return $user;
    }

}
