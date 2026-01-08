@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Skill Offer</h2>
            <p class="text-gray-600 mb-6">Update the details of your skill offer below.</p>

            <form method="POST" action="{{ route('skill-offers.update', $skillOffer) }}">
                @csrf
                @method('PATCH')

                @include('skill_offers.partials.form', [
                    'skillOffer' => $skillOffer,
                    'buttonText' => 'Update Skill Offer',
                ])
            </form>
        </div>
    </div>
</div>
@endsection