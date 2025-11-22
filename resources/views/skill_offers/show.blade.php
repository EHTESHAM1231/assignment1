@extends('layouts.app')

@section('content')
    <h2>Skill Offer Details</h2>

    <p><strong>Name:</strong> {{ $skillOffer->name }}</p>
    <p><strong>Skill:</strong> {{ $skillOffer->skill_name }}</p>
    <p><strong>Level:</strong> {{ $skillOffer->skill_level }}</p>
    <p><strong>Session Type:</strong> {{ $skillOffer->session_type }}</p>
    <p><strong>Contact:</strong> {{ $skillOffer->contact_method }}</p>

    <h3>Availability Notes</h3>
    <p>{{ $skillOffer->availability_notes ?: 'No additional notes provided.' }}</p>

    <p>
        <a href="{{ route('skill-offers.edit', $skillOffer) }}">Edit</a>
        <a href="{{ route('skill-offers.index') }}">Back to list</a>
    </p>
@endsection
