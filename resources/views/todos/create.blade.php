<x-app-layout>
    <div class="w-6/12 max-w-2xl mx-auto sm:p-6 lg:p-8">

        <div class="p-4 mt-4 mb-5 text-white bg-gray-800 border-l-4 rounded border-white-500" role="alert">
            <p class="font-bold">Todo creation page</p>
            <p>This page allows you to create a new todo item. Fill in the title and description fields and then click the 'Create' button. A description is not required.</p>
        </div>
        
        <form method="POST" action="{{ route('todos.store') }}" class="w-full mx-auto">
            @csrf

            <p></p>

            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block w-full mt-1" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-text-input id="description" class="block w-full mt-1" type="text" name="description" :value="old('description')" autofocus autocomplete="description" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>