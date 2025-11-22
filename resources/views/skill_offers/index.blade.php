@extends('layouts.app')

@section('content')
    <h2>All Skill Offers</h2>

    <form method="GET" action="{{ route('skill-offers.index') }}">
        <label for="search">Search by skill or level:</label>
        <input
            type="text"
            id="search"
            name="search"
            value="{{ request('search') }}"
        >
        <button type="submit">Search</button>
    </form>

    @if ($skillOffers->count() === 0)
        <p>No skill offers found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Skill</th>
                    <th>Level</th>
                    <th>Session Type</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($skillOffers as $offer)
                <tr>
                    <td>{{ $offer->name }}</td>
                    <td>{{ $offer->skill_name }}</td>
                    <td>{{ $offer->skill_level }}</td>
                    <td>{{ $offer->session_type }}</td>
                    <td>{{ $offer->contact_method }}</td>
                    <td class="actions">
                        <a href="{{ route('skill-offers.show', $offer) }}">View</a>
                        <a href="{{ route('skill-offers.edit', $offer) }}">Edit</a>

                        <form action="{{ route('skill-offers.destroy', $offer) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

       <div class="pagination-nav">
    @if ($skillOffers->onFirstPage())
        <span class="disabled">Previous</span>
    @else
        <a href="{{ $skillOffers->previousPageUrl() }}">Previous</a>
    @endif

    <span class="page-info">
        Page {{ $skillOffers->currentPage() }} of {{ $skillOffers->lastPage() }}
    </span>

    @if ($skillOffers->hasMorePages())
        <a href="{{ $skillOffers->nextPageUrl() }}">Next</a>
    @else
        <span class="disabled">Next</span>
    @endif
</div>

    @endif
@endsection
