<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Auth\AuthenticationServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct(private readonly AuthenticationServiceContract $authService){}

    /**
     * @return View
     */
    public function show(): View
    {
        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $result = $this->authService->login($request->validated());

        if (! $result['success']) {
            return redirect()->back()->withErrors(['invalidCredentials' => $result['message']]);
        }

        return redirect('posts')->with('message', $result['message']);
    }
}
