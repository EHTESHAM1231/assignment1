@extends('layouts.app')

@section('content')
    <h2>Add New Skill Offer</h2>

    <form method="POST" action="{{ route('skill-offers.store') }}">
        @csrf

        @include('skill_offers.partials.form', [
            'skillOffer' => new \App\Models\SkillOffer(),
            'buttonText' => 'Create Offer',
        ])
    </form>
@endsection
