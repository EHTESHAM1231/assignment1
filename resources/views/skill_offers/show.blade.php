@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="max-w-3xl mx-auto">
            <!-- Back Link -->
            <a href="{{ route('skill-offers.index') }}" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800 mb-6">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to all skills
            </a>

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $skillOffer->skill_name }}</h1>
                    <div class="flex items-center space-x-3">
                        @if($skillOffer->category)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium" style="background-color: {{ $skillOffer->category->color }}20; color: {{ $skillOffer->category->color }}">
                                {{ $skillOffer->category->name }}
                            </span>
                        @endif
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($skillOffer->skill_level === 'Expert') bg-purple-100 text-purple-800
                            @elseif($skillOffer->skill_level === 'Advanced') bg-blue-100 text-blue-800
                            @elseif($skillOffer->skill_level === 'Intermediate') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $skillOffer->skill_level }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            {{ $skillOffer->session_type }}
                        </span>
                    </div>
                </div>

                @auth
                    @if(auth()->id() === $skillOffer->user_id)
                        <div class="flex space-x-3 mt-4 sm:mt-0">
                            <a href="{{ route('skill-offers.edit', $skillOffer) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Edit
                            </a>
                            <form action="{{ route('skill-offers.destroy', $skillOffer) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this skill offer?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Details Card -->
            <div class="bg-gray-50 rounded-lg border border-gray-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Skill Provider Details</h2>
                
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Provider Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $skillOffer->name }}
                            @if($skillOffer->user)
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                    Verified User
                                </span>
                            @endif
                        </dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Contact Method</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $skillOffer->contact_method }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Teaching Mode</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $skillOffer->session_type }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Posted</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $skillOffer->created_at->diffForHumans() }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Availability Notes -->
            <div class="bg-gray-50 rounded-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Availability Notes</h2>
                <p class="text-gray-700">
                    {{ $skillOffer->availability_notes ?: 'No additional availability notes provided.' }}
                </p>
            </div>

            <!-- Call to Action for Guests -->
            @guest
                <div class="mt-6 bg-indigo-50 rounded-lg border border-indigo-200 p-6 text-center">
                    <h3 class="text-lg font-semibold text-indigo-900 mb-2">Want to share your skills too?</h3>
                    <p class="text-indigo-700 mb-4">Join Skill Swap Hub and start teaching others what you know!</p>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        Sign Up Now
                    </a>
                </div>
            @endguest
        </div>
    </div>
</div>
@endsection