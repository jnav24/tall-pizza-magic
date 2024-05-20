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

<nav class="bg-white w-full py-4 border-b border-gray-200 flex justify-center">
    <section class="container flex justify-between items-center">
        <x-shared.logo text-class="text-xl" />

        <div>
            <x-shared.profile-menu :profile="$profile"/>
        </div>
    </section>
</nav>
