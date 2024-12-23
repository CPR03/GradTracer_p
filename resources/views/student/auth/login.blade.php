{{-- student/login.blade.php --}}
@extends('layouts.auth-layout')

@section('title', 'Student Login')
@section('form-title', 'Welcome Back!')
@section('form-subtitle', 'Please sign in to continue')

@section('form-content')
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <!-- Email Input -->
        <div class="form-control">
            <label class="label">
                <span class="label-text flex items-center gap-2">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                    Email
                </span>
            </label>
            <input type="email" name="email" id="email" class="input input-bordered w-full"
                placeholder="your.email@example.com" required autofocus />
        </div>

        <!-- Password Input -->
        <div class="form-control">
            <label class="label">
                <span class="label-text flex items-center gap-2">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                    Password
                </span>
            </label>
            <input type="password" name="password" id="password" class="input input-bordered w-full"
                placeholder="Enter your password" required />
        </div>

        <!-- Remember Me -->
        <!-- <div class="flex items-center gap-2">
            <input type="checkbox" name="remember" id="remember_me" class="checkbox checkbox-sm checkbox-primary" />
            <label for="remember_me" class="label-text">Remember me</label>
        </div> -->

        <!-- Submit Button -->
        <button type="submit" class="btn signInButton w-full gap-2 hover:shadow-lg transition-all duration-300 text-white">
            <i data-lucide="log-in" class="w-4 h-4"></i>
            Sign In
        </button>

        <!-- Additional Links -->
        <div class="text-center text-sm">
            <!-- <a href="/forgot-password" class="link link-primary">Forgot Password?</a> -->
            <!-- <span class="text-base-content/60 mx-2">|</span> -->
            Don't have an account yet?
            <a href="/register" class="link link-primary">Create Account</a>
        </div>
    </form>
@endsection
