<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmailVerificationRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthenticationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{

    public function __construct(private readonly AuthenticationService $service)
    {

    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->service->register(data: $request->validated());

        event(new Registered($user));

        return response()->json([
            'message' => 'User registration successfully.',
            ...$this->service->freshTokenInfoOf($user)
        ], Response::HTTP_CREATED);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->service->login(credentials: $request->validated());
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $this->service->logout(auth()->user(), $request->bearerToken());
        return response()->json([
            'message' => 'User logged out successfully.'
        ], Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user(), Response::HTTP_OK);
    }

    /**
     * @param EmailVerificationRequest $request
     * @return JsonResponse
     */
    public function verifyEmail(EmailVerificationRequest $request): JsonResponse
    {
        $request->fulfill();
        return response()->json(['message' => 'Email verified successfully.'], Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function resendVerificationEmail(): JsonResponse
    {
        auth()->user()?->sendEmailVerificationNotification();
        return response()->json(['message' => 'Email verification link sent successfully.'], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function forgotPassword(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));
        return response()->json(['message' => __($status)], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            static fn($user) => $user->forceFill(['password' => $request->password])->save()
        );

        return response()->json(['message' => __($status)], Response::HTTP_OK);
    }
}
