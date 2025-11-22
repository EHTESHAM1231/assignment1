<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Swap Hub</title>

    {{-- External CSS --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<header>
    <h1>Skill Swap Hub</h1>
    <nav>
        <a href="{{ route('skill-offers.index') }}">Home</a>
        <a href="{{ route('skill-offers.create') }}">Add New Offer</a>
    </nav>
</header>

<div class="container">
    @if(session('success'))
        <div class="message">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>
