<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\AuthenticationContract;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthenticationService implements AuthenticationContract
{

    /**
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    /**
     * @param array $credentials
     * @return array
     * @throws Exception
     */
    public function login(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->firstOrFail();

        if (is_null($user) || !Hash::check($credentials['password'], $user->password)) {
            throw new Exception('Invalid credentials.');
        }

        return $this->freshTokenInfoOf($user);
    }

    /**
     * @param User $user
     * @param string $token
     * @return bool
     */
    public function logout(User $user, string $token): bool
    {
        return $user->tokens()->where('token', $token)->delete();
    }

    /**
     * @param User $user
     * @return array
     */
    public function freshTokenInfoOf(User $user): array
    {
        $token = $user->createToken('auth::token')->plainTextToken;
        return ['token' => $token, 'user' => $user];
    }
}
