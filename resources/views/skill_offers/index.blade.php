@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 sm:mb-0">Browse Skill Offers</h2>
            @auth
                <a href="{{ route('skill-offers.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    + Share Your Skill
                </a>
            @endauth
        </div>

        <!-- Search and Filter Form -->
        <form method="GET" action="{{ route('skill-offers.index') }}" class="mb-6 bg-gray-50 p-4 rounded-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Search Input -->
                <div class="lg:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search skills, names..."
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                    >
                </div>

                <!-- Category Filter -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" id="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Level Filter -->
                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                    <select name="level" id="level" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="">All Levels</option>
                        @foreach(['Beginner', 'Intermediate', 'Advanced', 'Expert'] as $level)
                            <option value="{{ $level }}" {{ request('level') == $level ? 'selected' : '' }}>
                                {{ $level }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Session Type Filter -->
                <div>
                    <label for="session_type" class="block text-sm font-medium text-gray-700 mb-1">Mode</label>
                    <select name="session_type" id="session_type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="">All Modes</option>
                        @foreach(['Online', 'In Person', 'Both'] as $type)
                            <option value="{{ $type }}" {{ request('session_type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex gap-2 mt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Apply Filters
                </button>
                @if(request()->hasAny(['search', 'category', 'level', 'session_type']))
                    <a href="{{ route('skill-offers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Clear All
                    </a>
                @endif
            </div>
        </form>

        <!-- Results -->
        @if ($skillOffers->count() === 0)
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No skill offers found</h3>
                <p class="mt-1 text-sm text-gray-500">
                    @if(request()->hasAny(['search', 'category', 'level', 'session_type']))
                        Try adjusting your filters.
                    @else
                        Be the first to share a skill!
                    @endif
                </p>
                @auth
                    <div class="mt-6">
                        <a href="{{ route('skill-offers.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            + Share Your Skill
                        </a>
                    </div>
                @endauth
            </div>
        @else
            <!-- Skill Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($skillOffers as $offer)
                    <div class="bg-gray-50 rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-200">
                        <div class="p-5">
                            <!-- Category & Level Badges -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-2">
                                    @if($offer->category)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium" style="background-color: {{ $offer->category->color }}20; color: {{ $offer->category->color }}">
                                            {{ $offer->category->name }}
                                        </span>
                                    @endif
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($offer->skill_level === 'Expert') bg-purple-100 text-purple-800
                                        @elseif($offer->skill_level === 'Advanced') bg-blue-100 text-blue-800
                                        @elseif($offer->skill_level === 'Intermediate') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $offer->skill_level }}
                                    </span>
                                </div>
                                <span class="text-xs text-gray-500">
                                    {{ $offer->session_type }}
                                </span>
                            </div>

                            <!-- Skill Name -->
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $offer->skill_name }}</h3>
                            
                            <!-- Provider Info -->
                            <p class="text-sm text-gray-600 mb-3">
                                <span class="font-medium">By:</span> {{ $offer->name }}
                                @if($offer->user)
                                    <span class="text-indigo-600">(verified)</span>
                                @endif
                            </p>

                            <!-- Contact -->
                            <p class="text-sm text-gray-500 mb-4 truncate">
                                <span class="font-medium">Contact:</span> {{ $offer->contact_method }}
                            </p>

                            <!-- Actions -->
                            <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                                <a href="{{ route('skill-offers.show', $offer) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    View Details →
                                </a>
                                
                                @auth
                                    @if(auth()->id() === $offer->user_id)
                                        <div class="flex space-x-2">
                                            <a href="{{ route('skill-offers.edit', $offer) }}" class="text-gray-600 hover:text-gray-800 text-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('skill-offers.destroy', $offer) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this skill offer?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-700">
                    Showing {{ $skillOffers->firstItem() ?? 0 }} to {{ $skillOffers->lastItem() ?? 0 }} of {{ $skillOffers->total() }} results
                </div>
                <div class="flex space-x-2">
                    @if ($skillOffers->onFirstPage())
                        <span class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $skillOffers->previousPageUrl() }}" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Previous</a>
                    @endif

                    @if ($skillOffers->hasMorePages())
                        <a href="{{ $skillOffers->nextPageUrl() }}" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Next</a>
                    @else
                        <span class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection