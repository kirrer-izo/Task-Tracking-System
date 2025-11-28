@extends('layouts.app')

@section('content')
<div class="relative isolate px-6 pt-14 lg:px-8">
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">
                Task Tracking <span class="text-purple-500">System</span>
            </h1>
            <p class="mt-6 text-lg leading-8 text-gray-300">
                Track your tasks, conquer your goals, and watch your progress unfold. Let's make every day a step toward success. 🚀
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('register') }}" class="btn text-lg px-6 py-2.5">Get started</a>
                <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-white hover:text-purple-400 transition-colors">
                    Log in <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection