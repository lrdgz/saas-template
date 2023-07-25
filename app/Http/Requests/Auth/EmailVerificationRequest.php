<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest as EmailVerification;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmailVerificationRequest extends EmailVerification
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        Auth::login(User::findOr(
            request()?->route('id'),
            static fn() => abort(Response::HTTP_UNAUTHORIZED)
            )
        );
    }
}
