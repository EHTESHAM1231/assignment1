@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Share Your Skill</h2>
            <p class="text-gray-600 mb-6">Fill out the form below to share a skill you can teach others.</p>

            <form method="POST" action="{{ route('skill-offers.store') }}">
                @csrf

                @include('skill_offers.partials.form', [
                    'skillOffer' => new \App\Models\SkillOffer(),
                    'buttonText' => 'Create Skill Offer',
                ])
            </form>
        </div>
    </div>
</div>
@endsection