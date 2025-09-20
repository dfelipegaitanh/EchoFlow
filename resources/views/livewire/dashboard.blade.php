<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new
#[Layout('components.layouts.app')]
#[Title('Dashboard')]
class extends Component
{
    //
}

?>

<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <a href="{{ route('deezer.index') }}" wire:navigate
           class="relative flex aspect-video flex-col items-center justify-center overflow-hidden rounded-xl border border-neutral-200 bg-white p-4 text-center transition-colors hover:bg-neutral-50 dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700/50"
        >
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Connect to Deezer') }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Start your music journey') }}</p>
        </a>
        <div
            class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700"
        >
            <x-placeholder-pattern
                class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20"
            />
        </div>
        <div
            class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700"
        >
            <x-placeholder-pattern
                class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20"
            />
        </div>
    </div>
    <div
        class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700"
    >
        <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
    </div>
</div>
