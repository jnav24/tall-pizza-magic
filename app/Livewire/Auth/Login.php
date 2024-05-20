<?php

namespace App\Livewire\Auth;

use App\Enums\RoleEnum;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

#[Layout('layouts.auth')]
class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function authenticate(): \Illuminate\Http\RedirectResponse|bool|Redirector
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));

            return false;
        }

        if (Auth::user()->getRoleNames()->contains(RoleEnum::ADMIN->value)) {
            return redirect()->intended(route('admin.orders'));
        }

        return redirect()->intended(route('dashboard.menu'));
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.auth.login');
    }
}
