<?php

namespace App\Livewire\Auth;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

#[Layout('layouts.auth')]
class Register extends Component
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $passwordConfirmation = '';

    public function register(): \Illuminate\Http\RedirectResponse|bool|Redirector
    {
        $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
        ]);

        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make($this->password),
            // @note email_verified_at here is only temporary
            // @todo setup verify email logic
            'email_verified_at' => now(),
        ]);

        $user->assignRole(RoleEnum::USER->value);

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->intended(route('dashboard.menu'));
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.auth.register');
    }
}
