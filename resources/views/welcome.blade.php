@extends('layouts.app')

@section('title', 'To-do or not to-do')

@section('content')
<div class="min-h-screen">
    @guest
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
                        <a href="#features" class="text-gray-700 hover:text-purple-600 transition-colors">Features</a>
                        <a href="#about" class="text-gray-700 hover:text-purple-600 transition-colors">About</a>
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
    @endguest

    <!-- Hero Section -->
    <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 {{ auth()->check() ? 'pt-24' : 'pt-32' }}">
        <div class="max-w-4xl w-full text-center">
            <img src="/images/logo.jpg" alt="Logo" class="mx-auto h-32 w-32 rounded-full shadow-2xl mb-6">
            <h1 class="text-5xl font-bold text-purple-800 mb-4" style="font-family: 'Georgia', serif;">
                To-do or not to-do
            </h1>
            <p class="text-xl text-gray-600 mb-8">
                Organize your life, achieve your goals, boost your productivity
            </p>
            
            @guest
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/register" class="btn-primary px-8 py-4 text-white rounded-lg font-medium text-lg">
                        <i class="fas fa-rocket mr-2"></i>Get Started Free
                    </a>
                    <a href="/login" class="px-8 py-4 border-2 border-purple-600 text-purple-600 rounded-lg font-medium text-lg hover:bg-purple-50 transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                    </a>
                </div>
            @endguest
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="glass-effect rounded-xl p-6 text-center task-card">
                <div class="text-4xl mb-4">🎯</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Stay Focused</h3>
                <p class="text-gray-600">Prioritize tasks and focus on what matters most</p>
            </div>
            <div class="glass-effect rounded-xl p-6 text-center task-card">
                <div class="text-4xl mb-4">📊</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Track Progress</h3>
                <p class="text-gray-600">Monitor your productivity and celebrate achievements</p>
            </div>
            <div class="glass-effect rounded-xl p-6 text-center task-card">
                <div class="text-4xl mb-4">🚀</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Achieve More</h3>
                <p class="text-gray-600">Complete tasks efficiently and reach your goals faster</p>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="glass-effect rounded-2xl shadow-2xl p-8 text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Ready to Get Started?</h2>
            <p class="text-gray-600 mb-8">Join thousands of users who have transformed their productivity</p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register" class="btn-primary px-8 py-4 text-white rounded-lg font-medium text-lg">
                    <i class="fas fa-rocket mr-2"></i>Get Started Free
                </a>
                <a href="/login" class="px-8 py-4 border-2 border-purple-600 text-purple-600 rounded-lg font-medium text-lg hover:bg-purple-50 transition-colors">
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                </a>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div id="about" class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Section -->
            <div class="text-center">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <div class="text-3xl font-bold text-purple-600">10K+</div>
                        <div class="text-sm text-gray-600">Active Users</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-pink-600">1M+</div>
                        <div class="text-sm text-gray-600">Tasks Completed</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-indigo-600">99.9%</div>
                        <div class="text-sm text-gray-600">Uptime</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-green-600">4.9★</div>
                        <div class="text-sm text-gray-600">User Rating</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
