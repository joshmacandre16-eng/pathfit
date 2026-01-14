<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sport Requirement Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Sport Requirement Details</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('coach.sport-requirements.edit', $requirement) }}"
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <a href="{{ route('coach.sport-requirements.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to List
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-md font-semibold mb-4">Basic Information</h4>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="font-medium text-gray-700">Sport:</dt>
                                    <dd class="text-gray-900">{{ $requirement->sport_name }}</dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Required Gender:</dt>
                                    <dd class="text-gray-900">{{ ucfirst($requirement->required_gender) }}</dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Status:</dt>
                                    <dd>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $requirement->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $requirement->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Created At:</dt>
                                    <dd class="text-gray-900">{{ $requirement->created_at->format('Y-m-d H:i:s') }}</dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Updated At:</dt>
                                    <dd class="text-gray-900">{{ $requirement->updated_at->format('Y-m-d H:i:s') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h4 class="text-md font-semibold mb-4">Requirements</h4>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="font-medium text-gray-700">Age Range:</dt>
                                    <dd class="text-gray-900">
                                        @if($requirement->min_age && $requirement->max_age)
                                            {{ $requirement->min_age }}-{{ $requirement->max_age }} years
                                        @elseif($requirement->min_age)
                                            {{ $requirement->min_age }}+
                                        @elseif($requirement->max_age)
                                            Up to {{ $requirement->max_age }}
                                        @else
                                            Any
                                        @endif
                                    </dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Height Range:</dt>
                                    <dd class="text-gray-900">
                                        @if($requirement->min_height && $requirement->max_height)
                                            {{ $requirement->min_height }}-{{ $requirement->max_height }} cm
                                        @elseif($requirement->min_height)
                                            {{ $requirement->min_height }} cm+
                                        @elseif($requirement->max_height)
                                            Up to {{ $requirement->max_height }} cm
                                        @else
                                            Any
                                        @endif
                                    </dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Weight Range:</dt>
                                    <dd class="text-gray-900">
                                        @if($requirement->min_weight && $requirement->max_weight)
                                            {{ $requirement->min_weight }}-{{ $requirement->max_weight }} kg
                                        @elseif($requirement->min_weight)
                                            {{ $requirement->min_weight }} kg+
                                        @elseif($requirement->max_weight)
                                            Up to {{ $requirement->max_weight }} kg
                                        @else
                                            Any
                                        @endif
                                    </dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Minimum Experience:</dt>
                                    <dd class="text-gray-900">{{ $requirement->min_experience_years ? $requirement->min_experience_years . ' years' : 'None' }}</dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Required Level:</dt>
                                    <dd class="text-gray-900">{{ $requirement->required_level ? ucfirst($requirement->required_level) : 'Any' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-md font-semibold mb-4">Additional Details</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <dt class="font-medium text-gray-700">Required Positions:</dt>
                                <dd class="text-gray-900 mt-1">
                                    @if($requirement->required_positions)
                                        @foreach(json_decode($requirement->required_positions) as $position)
                                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $position }}</span>
                                        @endforeach
                                    @else
                                        None specified
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-700">Preferred Attributes:</dt>
                                <dd class="text-gray-900 mt-1">
                                    @if($requirement->preferred_attributes)
                                        @foreach(json_decode($requirement->preferred_attributes) as $attribute)
                                            <span class="inline-block bg-blue-200 rounded-full px-3 py-1 text-sm font-semibold text-blue-700 mr-2 mb-2">{{ $attribute }}</span>
                                        @endforeach
                                    @else
                                        None specified
                                    @endif
                                </dd>
                            </div>
                        </div>

                        <div class="mt-4">
                            <dt class="font-medium text-gray-700">Medical Restrictions:</dt>
                            <dd class="text-gray-900 mt-1">
                                @if($requirement->medical_restrictions)
                                    @foreach(json_decode($requirement->medical_restrictions) as $restriction)
                                        <span class="inline-block bg-red-200 rounded-full px-3 py-1 text-sm font-semibold text-red-700 mr-2 mb-2">{{ $restriction }}</span>
                                    @endforeach
                                @else
                                    None specified
                                @endif
                            </dd>
                        </div>

                        <div class="mt-4">
                            <dt class="font-medium text-gray-700">Additional Notes:</dt>
                            <dd class="text-gray-900 mt-1">{{ $requirement->additional_notes ?: 'None' }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
