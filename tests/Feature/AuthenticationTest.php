<?php


use App\Services\Contracts\AuthenticationContract;
use Symfony\Component\HttpFoundation\Response;

test('fail on validation', function () {
    $response = $this->postJson(route('auth.register'));

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['name', 'email', 'password']);

    $response = $this->postJson(route('auth.register'), [
        'email' => 'a',
        'name' => 'a',
        'password' => 'a',
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['name', 'email', 'password']);
});

test('can register user', function () {
    $response = $this->postJson(route('auth.register'), [
        'email' => fake()->email(),
        'name' => fake()->name(),
        'password' => 'password',
    ]);

    $response->assertStatus(Response::HTTP_CREATED);
});

test('fail login validation', function () {
    $response = $this->postJson(route('auth.login'));
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['email', 'password']);

    $response = $this->postJson(route('auth.login'), [
        'email' => 'a',
        'password' => 'a',
    ]);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['email', 'password']);
});

test('login with valid credentials', function () {
    $email = fake()->email();
    $password = fake()->password(minLength: 10);
    $response = $this->postJson(route('auth.register'), [
        'email' => $email,
        'name' => fake()->name(),
        'password' => $password,
    ]);

    $response->assertStatus(Response::HTTP_CREATED);

    $response = $this->postJson(route('auth.login'), [
        'email' => $email,
        'password' => $password,
    ]);
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['user', 'token']);
});

test('fail logout', function () {
    $response = $this->postJson(route('auth.logout'),
        headers: ['Authorization' => 'Bearer invalid-token']
    );
    $response->assertStatus(Response::HTTP_UNAUTHORIZED);
});

test('logout successfully', function () {
    $email = fake()->email();
    $password = fake()->password(minLength: 10);
    $response = $this->postJson(route('auth.register'), [
        'email' => $email,
        'name' => fake()->name(),
        'password' => $password,
    ]);

    $response->assertStatus(Response::HTTP_CREATED);

    $response = $this->postJson(route('auth.login'), [
        'email' => $email,
        'password' => $password,
    ]);

    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['user', 'token']);

    $response = $this->postJson(route('auth.logout'),
        headers: ['Authorization' => "Bearer {$response->json('token')}"]
    );
    $response->assertStatus(Response::HTTP_OK);
});

test('current user', function () {
    $email = fake()->email();
    $password = fake()->password(minLength: 10);
    $response = $this->postJson(route('auth.register'), [
        'email' => $email,
        'name' => fake()->name(),
        'password' => $password,
    ]);

    $response->assertStatus(Response::HTTP_CREATED);

    $response = $this->postJson(route('auth.login'), [
        'email' => $email,
        'password' => $password,
    ]);

    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['user', 'token']);

    $response = $this->postJson(route('auth.me'),
        headers: ['Authorization' => "Bearer {$response->json('token')}"]
    );
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['name', 'email']);
});

test('verify user email', function () {
    $password = fake()->password(minLength: 10);

    $user = app(AuthenticationContract::class)->register([
        'email' => fake()->email(),
        'name' => fake()->name(),
        'password' => $password
    ]);

    $response = $this->postJson(route('auth.login'), [
        'email' => $user->email,
        'password' => $password,
    ]);
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['user', 'token']);

    $response = $this->postJson(
        route('verification.send'),
        headers: ['Authorization' => "Bearer {$response->json('token')}"],
    );

    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['message']);
});

test('request password change', function () {
    $password = fake()->password(minLength: 10);

    $user = app(AuthenticationContract::class)->register([
        'email' => fake()->email(),
        'name' => fake()->name(),
        'password' => $password
    ]);

    $response = $this->postJson(route('password.email'), ['email' => $user->email]);
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['message']);
});

test('change password', function () {
    $user  = fake()->email();
    $password = fake()->password(minLength: 10);

    $token = "token";
    $response = $this->postJson(route('password.update'),[
        'token' => $token,
        'email' => $user,
        'password' => $password,
        'password_confirmation' => $password
    ]);

    $response->dump();

    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['message']);

})->skip("Find a way mock the password broker");
