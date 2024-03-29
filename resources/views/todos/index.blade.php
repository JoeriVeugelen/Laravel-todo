<x-app-layout>
    <div class="w-full px-4 mx-auto mt-6 sm:px-0 sm:w-6/12">
        <div>
            <form method="GET" action="{{ route('search') }}">
                <div class="flex">
                    <x-text-input class="flex-grow" type="text" name="query" placeholder="Search tasks..."></x-text-input>
                    <x-primary-button class="ml-2" type="submit" value="Search">Search</x-primary-button>
                </div>
            </form>
        </div>
        <div class="pt-6 pb-6">
            <x-primary-button><a href="{{ route('todos.create') }}">NEW TODO</a></x-primary-button>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            @foreach ($tasks as $task)
            <div class="p-4 bg-gray-800 divide-y rounded-lg shadow-sm {{ $task->done ? 'border-green-500' : 'border-red-500' }} border-2">
                <div class="flex p-4 space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 font-bold text-white -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <div class="inline-block">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="font-bold text-white">{{ $task->user->name }}</span>
                                    <small class="text-sm text-gray-200">- {{ $task->created_at->format('j M Y, g:i a') }}</small>
                                </div>
                            </div>
                            <a href="{{ route('todos.show', $task->id) }}">
                                <p class="inline-block mt-4 text-lg font-bold text-white">{{ $task->title }}</p>
                            </a>
                            <div class="flex">
                                <p class="mt-4 text-sm text-gray-200">{{ $task->description }}</p>
                            </div>
                            <div class="mt-4 text-sm text-gray-200 {{ $task->done ? 'text-green-500' : 'text-red-500' }} font-bold">
                                <form method="POST" action="/tasks/{{ $task->id }}/toggle-done">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit">{{ $task->done ? 'DONE' : 'NOT DONE' }}</button>
                                </form>
                            </div>
                            <div class="flex mt-4">
                                <x-primary-button>
                                    <a href="{{ route('todos.show', $task->id) }}">EDIT</a>
                                </x-primary-button>
                                <form method="POST" action="/todos/{{ $task->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button class="ml-2" style="background-color: rgb(239 68 68);" type="submit">Delete</x-primary-button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>