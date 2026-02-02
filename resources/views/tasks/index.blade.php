@extends('layouts.app')

@section('title', 'My Tasks - To-do or not to-do')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Top Navigation Bar -->
    <div class="glass-effect rounded-xl shadow-lg p-4 mb-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold text-purple-800" style="font-family: 'Georgia', serif;">
                    <i class="fas fa-tasks mr-2 text-purple-600"></i>My Tasks
                </h1>
                <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">LOGGED IN</span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/profile" class="px-4 py-2 text-purple-600 hover:bg-purple-50 rounded-lg transition-colors">
                    <i class="fas fa-user mr-2"></i>Profile
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

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="glass-effect rounded-xl p-6 text-center task-card">
            <div class="text-3xl mb-2">📋</div>
            <div class="text-2xl font-bold text-gray-800">{{ $tasks->count() }}</div>
            <div class="text-sm text-gray-600">Total Tasks</div>
        </div>
        <div class="glass-effect rounded-xl p-6 text-center task-card">
            <div class="text-3xl mb-2">✅</div>
            <div class="text-2xl font-bold text-green-600">{{ $tasks->where('completed', true)->count() }}</div>
            <div class="text-sm text-gray-600">Completed</div>
        </div>
        <div class="glass-effect rounded-xl p-6 text-center task-card">
            <div class="text-3xl mb-2">⏳</div>
            <div class="text-2xl font-bold text-yellow-600">{{ $tasks->where('completed', false)->count() }}</div>
            <div class="text-sm text-gray-600">Pending</div>
        </div>
        <div class="glass-effect rounded-xl p-6 text-center task-card">
            <div class="text-3xl mb-2">🎯</div>
            <div class="text-2xl font-bold text-purple-600">{{ $tasks->where('completed', true)->count() > 0 ? round(($tasks->where('completed', true)->count() / $tasks->count()) * 100) : 0 }}%</div>
            <div class="text-sm text-gray-600">Completion Rate</div>
        </div>
    </div>

    <!-- Add Task Section -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-plus-circle mr-2 text-purple-600"></i>
            Add New Task
        </h2>
        <form action="/tasks" method="POST" class="space-y-4">
            @csrf
            <div class="flex flex-col sm:flex-row gap-4">
                <input type="text" name="title" required 
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                       placeholder="What needs to be done?">
                <select name="priority" class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                    <option value="low">Low Priority</option>
                    <option value="medium" selected>Medium Priority</option>
                    <option value="high">High Priority</option>
                </select>
                <button type="submit" class="px-6 py-3 btn-primary text-white rounded-lg font-medium">
                    <i class="fas fa-plus mr-2"></i>Add Task
                </button>
            </div>
        </form>
    </div>

    <!-- Filter and Search -->
    <div class="glass-effect rounded-2xl shadow-xl p-6 mb-8">
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="flex gap-2">
                <button onclick="filterTasks('all')" class="filter-btn px-4 py-2 rounded-lg font-medium transition-all duration-200 bg-purple-600 text-white">
                    All Tasks
                </button>
                <button onclick="filterTasks('pending')" class="filter-btn px-4 py-2 rounded-lg font-medium transition-all duration-200 bg-gray-200 text-gray-700 hover:bg-gray-300">
                    Pending
                </button>
                <button onclick="filterTasks('completed')" class="filter-btn px-4 py-2 rounded-lg font-medium transition-all duration-200 bg-gray-200 text-gray-700 hover:bg-gray-300">
                    Completed
                </button>
            </div>
            <div class="relative">
                <input type="text" id="searchInput" placeholder="Search tasks..." 
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
    </div>

    <!-- Tasks List -->
    <div class="space-y-4">
        @if($tasks->count() > 0)
            @foreach($tasks as $task)
                <div class="task-card glass-effect rounded-xl p-6 {{ $task->completed ? 'opacity-75' : '' }}" data-status="{{ $task->completed ? 'completed' : 'pending' }}" data-title="{{ strtolower($task->title) }}" data-task-id="{{ $task->id }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4 flex-1">
                            <form action="/tasks/{{ $task->id }}/toggle" method="POST" class="flex-shrink-0">
                                @csrf
                                <button type="submit">
                                    <div class="w-6 h-6 rounded-full border-2 {{ $task->completed ? 'bg-green-500 border-green-500' : 'border-gray-300 hover:border-purple-600' }} transition-all duration-200 flex items-center justify-center">
                                        @if($task->completed)
                                            <i class="fas fa-check text-white text-xs"></i>
                                        @endif
                                    </div>
                                </button>
                            </form>
                            <div class="flex-1">
                                <h3 class="task-title text-lg font-medium {{ $task->completed ? 'line-through text-gray-500' : 'text-gray-800' }}">
                                    {{ $task->title }}
                                </h3>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="task-priority inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" data-priority="{{ $task->priority }}"
                                        {{ $task->priority == 'high' ? 'bg-red-100 text-red-800' : ($task->priority == 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                        <i class="fas fa-flag mr-1"></i>{{ ucfirst($task->priority) }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-clock mr-1"></i>{{ $task->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="editTask({{ $task->id }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="/tasks/{{ $task->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">📝</div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No tasks yet</h3>
                <p class="text-gray-500">Start adding tasks to organize your day!</p>
            </div>
        @endif
    </div>
</div>

<script>
function filterTasks(status) {
    const tasks = document.querySelectorAll('.task-card');
    const buttons = document.querySelectorAll('.filter-btn');
    
    buttons.forEach(btn => {
        btn.classList.remove('bg-purple-600', 'text-white');
        btn.classList.add('bg-gray-200', 'text-gray-700');
    });
    
    event.target.classList.remove('bg-gray-200', 'text-gray-700');
    event.target.classList.add('bg-purple-600', 'text-white');
    
    tasks.forEach(task => {
        if (status === 'all') {
            task.style.display = 'block';
        } else if (status === 'completed' && task.dataset.status === 'completed') {
            task.style.display = 'block';
        } else if (status === 'pending' && task.dataset.status === 'pending') {
            task.style.display = 'block';
        } else {
            task.style.display = 'none';
        }
    });
}

function editTask(id) {
    const taskElement = document.querySelector(`[data-task-id="${id}"]`);
    const title = taskElement.querySelector('.task-title').textContent;
    const priority = taskElement.querySelector('.task-priority').dataset.priority;
    
    document.getElementById('editTaskId').value = id;
    document.getElementById('editTaskTitle').value = title;
    document.getElementById('editTaskPriority').value = priority;
    
    // Set the form action dynamically
    const form = document.querySelector('#editModal form');
    form.action = `/tasks/${id}`;
    
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const tasks = document.querySelectorAll('.task-card');
    
    tasks.forEach(task => {
        const title = task.dataset.title;
        if (title.includes(searchTerm)) {
            task.style.display = 'block';
        } else {
            task.style.display = 'none';
        }
    });
});
</script>

<!-- Edit Task Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Edit Task</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form action="" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="editTaskId" name="id">
            
            <div class="mb-4">
                <label for="editTaskTitle" class="block text-sm font-medium text-gray-700 mb-2">
                    Task Title
                </label>
                <input type="text" id="editTaskTitle" name="title" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
            </div>
            
            <div class="mb-4">
                <label for="editTaskPriority" class="block text-sm font-medium text-gray-700 mb-2">
                    Priority
                </label>
                <select id="editTaskPriority" name="priority" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeEditModal()" 
                        class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                    Cancel
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
