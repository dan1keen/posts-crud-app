<?php

namespace App\Http\Controllers;

use App\Contracts\PostServiceContract;
use App\DTO\PostDTO;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        private readonly PostServiceContract $postService
    ){}

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
//        $posts = $this->postService->getPosts($request->all());
        /** Метод создал для того чтобы выводить данные как из DummyJson, так и из локальной БД. */
        $posts = $this->postService->getMergedPosts($request->all());

        return view('posts.index', compact('posts'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * @param CreatePostRequest $request
     * @return RedirectResponse
     */
    public function store(CreatePostRequest $request): RedirectResponse
    {
        $this->postService->createPost(new PostDTO(
            id: null,
            title: $request->input('title'),
            body: $request->input('text'),
            authorName: $request->input('author_name')
        ));
        return redirect('posts')->with('message', __('Успешно создан'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $post = $this->postService->getPost($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * @param int $id
     * @param UpdatePostRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdatePostRequest $request): RedirectResponse
    {
        $this->postService->updatePost($id, new PostDTO(
            id: $id,
            title: $request->input('title'),
            body: $request->input('text'),
            authorName: $request->input('author_name')
        ));

        return redirect('posts')->with('message', __('Успешно обновлен'));
    }

    public function delete(int $id): RedirectResponse
    {
        $this->postService->deletePost($id);

        return redirect('posts')->with('message', __('Успешно удален'));
    }
}
