routes/web




resources\views\components\layout.blade.php
<header class="bg-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
    </div>
</header>
<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $slot }}
    </div>
</main>


resources\views\home.blade.php
<x-layout>
    <x-slot:heading>
        Home
    </x-slot:heading>
    <h1>This is Home Page!</h1>
</x-layout>