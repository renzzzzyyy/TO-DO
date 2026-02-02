@extends('layouts.app')

@section('title', 'Login - To-do or not to-do')

@section('content')
<div class="min-h-screen">
    <!-- Header for non-authenticated users -->
    <header class="glass-effect shadow-lg fixed top-0 left-0 right-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-tasks text-2xl text-purple-600 mr-3"></i>
                        <span class="text-xl font-bold text-purple-800" style="font-family: 'Georgia', serif;">To-do or not to-do</span>
                    </div>
                </div>
                <nav class="hidden sm:flex space-x-8">
                    <a href="/" class="text-gray-700 hover:text-purple-600 transition-colors">Home</a>
                    <a href="/register" class="text-gray-700 hover:text-purple-600 transition-colors">Sign Up</a>
                    <a href="/login" class="btn-primary px-4 py-2 text-white rounded-lg text-sm">Sign In</a>
                </nav>
                <!-- Mobile menu button -->
                <div class="sm:hidden">
                    <button class="text-gray-700 hover:text-purple-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 pt-32">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <img src="/images/logo.jpg" alt="Logo" class="mx-auto h-20 w-20 rounded-full shadow-xl mb-4">
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                Welcome Back
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Sign in to continue managing your tasks
            </p>
        </div>

        <div class="glass-effect rounded-2xl shadow-2xl p-8">
            <form class="space-y-6" action="/login" method="POST">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-purple-600"></i>Email Address
                        </label>
                        <input id="email" name="email" type="email" required 
                               class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all duration-200"
                               placeholder="john@example.com" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-purple-600"></i>Password
                        </label>
                        <div class="relative">
                            <input id="password" name="password" type="password" required 
                                   class="appearance-none relative block w-full px-4 py-3 pr-12 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all duration-200"
                                   placeholder="••••••••">
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i id="passwordToggle" class="fas fa-eye text-gray-400 hover:text-purple-600 transition-colors"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-purple-600 hover:text-purple-500 transition-colors">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white btn-primary">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-unlock group-hover:animate-pulse"></i>
                        </span>
                        Sign In
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="/register" class="font-medium text-purple-600 hover:text-purple-500 transition-colors">
                            Sign up now
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <div class="text-center space-y-4">
            <div class="flex items-center justify-center space-x-6">
                <div class="text-center">
                    <div class="text-2xl font-bold text-purple-600">10K+</div>
                    <div class="text-xs text-gray-500">Active Users</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-pink-600">1M+</div>
                    <div class="text-xs text-gray-500">Tasks Completed</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-indigo-600">99.9%</div>
                    <div class="text-xs text-gray-500">Uptime</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.classList.remove('fa-eye');
        passwordToggle.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordToggle.classList.remove('fa-eye-slash');
        passwordToggle.classList.add('fa-eye');
    }
}
</script>
@endsection
