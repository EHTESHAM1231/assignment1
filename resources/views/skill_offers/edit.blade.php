@extends('layouts.app')

@section('content')
    <h2>Edit Skill Offer</h2>

    <form method="POST" action="{{ route('skill-offers.update', $skillOffer) }}">
        @csrf
        @method('PUT')

        @include('skill_offers.partials.form', [
            'skillOffer' => $skillOffer,
            'buttonText' => 'Update Offer',
        ])
    </form>
@endsection
