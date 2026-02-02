@extends('layouts.app')

@section('title', 'Register - To-do or not to-do')

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
                    <a href="/login" class="text-gray-700 hover:text-purple-600 transition-colors">Sign In</a>
                    <a href="/register" class="btn-primary px-4 py-2 text-white rounded-lg text-sm">Signup</a>
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
                Create Your Account
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Join thousands organizing their lives with To-do or not to-do
            </p>
        </div>

        <div class="glass-effect rounded-2xl shadow-2xl p-8">
            <form class="space-y-6" action="/register" method="POST">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-purple-600"></i>Full Name
                        </label>
                        <input id="name" name="name" type="text" required 
                               class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all duration-200"
                               placeholder="John Doe" value="{{ old('name') }}">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

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
                        <input id="password" name="password" type="password" required 
                               class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all duration-200"
                               placeholder="••••••••">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-purple-600"></i>Confirm Password
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                               class="appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all duration-200"
                               placeholder="••••••••">
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white btn-primary">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-rocket group-hover:animate-pulse"></i>
                        </span>
                        Create Account
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="/login" class="font-medium text-purple-600 hover:text-purple-500 transition-colors">
                            Sign in here
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <div class="text-center space-y-4">
            <div class="flex items-center justify-center space-x-4 text-gray-400">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-shield-alt text-green-500"></i>
                    <span class="text-sm">Secure</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-bolt text-yellow-500"></i>
                    <span class="text-sm">Fast</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-heart text-red-500"></i>
                    <span class="text-sm">Free Forever</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
