@extends('layouts.app')

@section('title', 'Profile - To-do or not to-do')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Top Navigation Bar -->
    <div class="glass-effect rounded-xl shadow-lg p-4 mb-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold text-purple-800" style="font-family: 'Georgia', serif;">
                    <i class="fas fa-user mr-2 text-purple-600"></i>My Profile
                </h1>
                <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">LOGGED IN</span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/tasks" class="px-4 py-2 text-purple-600 hover:bg-purple-50 rounded-lg transition-colors">
                    <i class="fas fa-tasks mr-2"></i>Tasks
                </a>
                <form action="/logout" method="POST" class="inline-flex">
                    @csrf
                    <button type="submit" class="px-6 py-2 bg-gray-800 text-white font-bold rounded-lg hover:bg-black transition-all duration-200 shadow-lg">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Profile Header -->
    <div class="text-center mb-8">
        <div class="relative inline-block">
            @if($user->profile_picture)
                <img src="{{ asset('uploads/profile/' . $user->profile_picture) }}" 
                     alt="Profile Picture" 
                     class="w-32 h-32 rounded-full object-cover shadow-xl">
            @else
                <div class="w-32 h-32 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center shadow-xl">
                    <span class="text-white text-4xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>
                </div>
            @endif
            
            <!-- Profile Picture Actions -->
            <div class="absolute bottom-0 right-0 flex space-x-1">
                <label for="profile_picture" class="bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-shadow cursor-pointer">
                    <i class="fas fa-camera text-purple-600"></i>
                </label>
                @if($user->profile_picture)
                    <form action="/profile/remove-picture" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-red cursor-pointer">
                            <i class="fas fa-trash text-red-600"></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>
        
        <!-- Hidden File Input -->
        <form action="/profile/upload-picture" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="hidden" onchange="this.form.submit()">
        </form>
        
        <h1 class="mt-4 text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
        <p class="text-gray-600">{{ $user->email }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Information -->
        <div class="lg:col-span-2">
            <div class="glass-effect rounded-2xl shadow-xl p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-user-edit mr-2 text-purple-600"></i>
                    Profile Information
                </h2>
                
                <form action="/profile" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name
                            </label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <button type="submit" class="btn-primary px-6 py-3 text-white rounded-lg font-medium">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Change Password -->
            <div class="glass-effect rounded-2xl shadow-xl p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-lock mr-2 text-purple-600"></i>
                    Change Password
                </h2>
                
                <form action="/profile/password" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                Current Password
                            </label>
                            <input type="password" id="current_password" name="current_password" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                                New Password
                            </label>
                            <input type="password" id="new_password" name="new_password" required minlength="6"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Confirm New Password
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-lg font-medium hover:from-indigo-700 hover:to-blue-700 transition-all duration-200">
                            <i class="fas fa-key mr-2"></i>Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Account Stats -->
            <div class="glass-effect rounded-2xl shadow-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Account Statistics</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Member Since</span>
                        <span class="font-medium">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total Tasks</span>
                        <span class="font-medium">{{ App\Models\Task::where('user_id', $user->id)->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Completed</span>
                        <span class="font-medium text-green-600">{{ App\Models\Task::where('user_id', $user->id)->where('completed', true)->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Pending</span>
                        <span class="font-medium text-yellow-600">{{ App\Models\Task::where('user_id', $user->id)->where('completed', false)->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="glass-effect rounded-2xl shadow-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="/tasks" class="flex items-center p-3 rounded-lg hover:bg-purple-50 transition-colors">
                        <i class="fas fa-tasks mr-3 text-purple-600"></i>
                        <span>View All Tasks</span>
                    </a>
                    <button class="w-full flex items-center p-3 rounded-lg hover:bg-red-50 transition-colors text-left">
                        <i class="fas fa-download mr-3 text-red-600"></i>
                        <span>Export Data</span>
                    </button>
                    <button class="w-full flex items-center p-3 rounded-lg hover:bg-orange-50 transition-colors text-left">
                        <i class="fas fa-bell mr-3 text-orange-600"></i>
                        <span>Notification Settings</span>
                    </button>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="glass-effect rounded-2xl shadow-xl p-6 border-2 border-red-200">
                <h3 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h3>
                <p class="text-sm text-gray-600 mb-4">Once you delete your account, there is no going back.</p>
                <button class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-trash-alt mr-2"></i>Delete Account
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
