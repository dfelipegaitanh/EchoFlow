<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('components.layouts.app')] #[Title('Connect to Deezer')] class extends Component {
    //
};

?>

<div
    class="flex h-full w-full flex-1 flex-col items-center justify-center gap-4 rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800"
>
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Connect to Deezer') }}</h1>
    <p class="text-center text-gray-600 dark:text-gray-400">
        {{ __('Connect your Deezer account to start exploring your music.') }}
    </p>
    <a
{{--        href="{{ route('auth.deezer.redirect') }}"--}}
        class="mt-4 inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
    >
        {{ __('Connect with Deezer') }}
    </a>
</div>
