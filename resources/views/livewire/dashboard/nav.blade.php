<?php

use Illuminate\Support\Facades\Auth;
use function Livewire\Volt\{on,state};

$profile = [
    ['action' => "dispatch('handleLogout')", 'label' => 'Logout', 'icon' => 'icons.logout'],
];

state(['profile' => $profile]);

on(['handleLogout' => function () {
    Auth::logout();
    redirect()->route('login');
}]);

?>

<nav class="w-full py-4 flex justify-center">
    <section class="flex justify-between items-center w-full">
        <x-shared.logo text-class="text-xl" />

        <div>
            <x-shared.profile-menu hide-name :profile="$profile" />
        </div>
    </section>
</nav>
