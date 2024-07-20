<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in User!") }}
                </div>
                
                <!-- Display assigned tasks -->
                <div class="p-6">
                    <h3 class="text-lg font-semibold">Assigned Tasks</h3>

                    @if ($tasks->count())
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Title</th>
                                    <th class="px-4 py-2">Description</th>
                                    <th class="px-4 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $task->title }}</td>
                                        <td class="border px-4 py-2">{{ $task->description }}</td>
                                        <td class="border px-4 py-2">{{ $task->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Display pagination links -->
                        {!! $tasks->links() !!}
                    @else
                        <p>No tasks assigned.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
