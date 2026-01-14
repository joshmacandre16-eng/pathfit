<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Sport Requirements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Sport Requirements Management</h3>
                        <a href="{{ route('coach.sport-requirements.create') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New Requirement
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sport</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age Range</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Height Range</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight Range</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($requirements as $requirement)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $requirement->sport_name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                @if($requirement->min_age && $requirement->max_age)
                                                    {{ $requirement->min_age }}-{{ $requirement->max_age }} years
                                                @elseif($requirement->min_age)
                                                    {{ $requirement->min_age }}+
                                                @elseif($requirement->max_age)
                                                    Up to {{ $requirement->max_age }}
                                                @else
                                                    Any
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                @if($requirement->min_height && $requirement->max_height)
                                                    {{ $requirement->min_height }}-{{ $requirement->max_height }} cm
                                                @elseif($requirement->min_height)
                                                    {{ $requirement->min_height }} cm+
                                                @elseif($requirement->max_height)
                                                    Up to {{ $requirement->max_height }} cm
                                                @else
                                                    Any
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                @if($requirement->min_weight && $requirement->max_weight)
                                                    {{ $requirement->min_weight }}-{{ $requirement->max_weight }} kg
                                                @elseif($requirement->min_weight)
                                                    {{ $requirement->min_weight }} kg+
                                                @elseif($requirement->max_weight)
                                                    Up to {{ $requirement->max_weight }} kg
                                                @else
                                                    Any
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ ucfirst($requirement->required_gender) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $requirement->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $requirement->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('coach.sport-requirements.show', $requirement) }}"
                                                   class="text-indigo-600 hover:text-indigo-900">View</a>
                                                <a href="{{ route('coach.sport-requirements.edit', $requirement) }}"
                                                   class="text-blue-600 hover:text-blue-900">Edit</a>
                                                <form action="{{ route('coach.sport-requirements.toggle', $requirement) }}"
                                                      method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="text-{{ $requirement->is_active ? 'red' : 'green' }}-600 hover:text-{{ $requirement->is_active ? 'red' : 'green' }}-900">
                                                        {{ $requirement->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('coach.sport-requirements.destroy', $requirement) }}"
                                                      method="POST" class="inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this requirement?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                            No sport requirements found. <a href="{{ route('coach.sport-requirements.create') }}" class="text-blue-600 hover:text-blue-900">Create your first requirement</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
