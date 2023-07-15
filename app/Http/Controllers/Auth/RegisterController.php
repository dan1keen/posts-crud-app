<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Auth\RegistrationServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function __construct(private readonly RegistrationServiceContract $registrationService){}

    /**
     * @return View
     */
    public function show(): View
    {
        return view('auth.registration');
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $this->registrationService->register($request->validated());

        return redirect('login')->with('message', __('Успешная регистрация'));
    }
}
