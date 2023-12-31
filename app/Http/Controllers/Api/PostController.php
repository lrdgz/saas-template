<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\{
    StorePostRequest,
    UpdatePostRequest
};
use App\Models\Post;
use App\Services\Contracts\PostContract;

class PostController extends Controller
{
    public function __construct(private readonly PostContract $service)
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        return $this->service->index(filters: []);
    }

    public function store(StorePostRequest $request)
    {
        return $this->service->store(data: $request->toArray());
    }

    public function show(Post $post)
    {
        return $this->service->show(post:$post);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        return $this->service->update(post:$post, data: $request->validated());
    }

    public function destroy(Post $post)
    {
        $this->service->destroy(post:$post);
        return response()->json();
    }
}
