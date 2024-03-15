<x-app-layout>
    <div class="w-full px-4 mx-auto mt-6 sm:px-0 sm:w-6/12">
        <div class="p-4 mt-4 mb-5 text-white bg-gray-800 border-l-4 rounded border-white-500" role="alert">
            <p class="font-bold">Todo information page</p>
            <p>On this page you can edit any information regarding the todo item.</p>
        </div>
        <div class="p-6 pt-6 pb-6 bg-gray-800 rounded-lg shadow-sm {{ $task->done ? 'border-green-500' : 'border-red-500' }} border-2">
            <div class="flex items-center">
                <a href="{{ url('/todos') }}" class="px-2 py-1 mr-4 font-bold text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="mr-2 text-2xl font-bold text-white">{{ $task->user->name }}</h1>
                <small class="pl-4 ml-auto text-gray-200">{{ $task->created_at->format('j M Y, g:i a') }}</small>
            </div>
            <div class="pl-10 ml-3">
                <form method="POST" action="/todos/{{ $task->id }}">
                    @csrf
                    @method('PATCH')
                    <div class="mt-4">
                        <x-text-input id="title" name="title" type="text" value="{{ $task->title }}" class="text-lg font-bold text-white"></x-text-input>
                    </div>
                    <div class="mt-4">
                        <x-text-input id="description" name="description" type="text" value="{{ $task->description }}" class="text-lg font-bold text-white"></x-text-input>
                    </div>
                    <div class="mt-4">
                        <x-primary-button type="submit">Save</x-primary-button>
                    </div>
                </form>
                <form method="POST" action="/todos/{{ $task->id }}">
                    @csrf
                    @method('DELETE')
                    <x-primary-button class="mt-2" style="background-color: rgb(239 68 68);" type="submit">Delete</x-primary-button>
                </form>
                <div class="mt-4 text-sm text-gray-200 {{ $task->done ? 'text-green-500' : 'text-red-500' }} font-bold">
                    <form method="POST" action="/tasks/{{ $task->id }}/toggle-done">
                        @csrf
                        @method('PATCH')
                        <button type="submit">{{ $task->done ? 'DONE' : 'NOT DONE' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>