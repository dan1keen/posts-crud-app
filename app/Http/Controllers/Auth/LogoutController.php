<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Auth\AuthenticationServiceContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LogoutController extends Controller
{
    public function __construct(private readonly AuthenticationServiceContract $authService){}

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        return redirect('login');
    }
}
