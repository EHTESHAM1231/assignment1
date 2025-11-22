<div class="field">
    <label for="name">Your Name</label>
    <input
        type="text"
        id="name"
        name="name"
        value="{{ old('name', $skillOffer->name ?? '') }}"
    >
    @error('name')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="field">
    <label for="skill_name">Skill Name</label>
    <input
        type="text"
        id="skill_name"
        name="skill_name"
        value="{{ old('skill_name', $skillOffer->skill_name ?? '') }}"
    >
    @error('skill_name')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="field">
    <label for="skill_level">Skill Level</label>
    <select id="skill_level" name="skill_level">
        @php
            $levels = ['Beginner', 'Intermediate', 'Advanced'];
            $selected = old('skill_level', $skillOffer->skill_level ?? '');
        @endphp
        <option value="">-- Select level --</option>
        @foreach ($levels as $level)
            <option value="{{ $level }}" {{ $selected === $level ? 'selected' : '' }}>
                {{ $level }}
            </option>
        @endforeach
    </select>
    @error('skill_level')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="field">
    <label for="session_type">Session Type</label>
    <select id="session_type" name="session_type">
        @php
            $types = ['Online', 'In-person'];
            $selectedType = old('session_type', $skillOffer->session_type ?? '');
        @endphp
        <option value="">-- Select session type --</option>
        @foreach ($types as $type)
            <option value="{{ $type }}" {{ $selectedType === $type ? 'selected' : '' }}>
                {{ $type }}
            </option>
        @endforeach
    </select>
    @error('session_type')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="field">
    <label for="contact_method">Contact Method</label>
    <input
        type="text"
        id="contact_method"
        name="contact_method"
        value="{{ old('contact_method', $skillOffer->contact_method ?? '') }}"
    >
    @error('contact_method')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="field">
    <label for="availability_notes">Availability Notes</label>
    <textarea
        id="availability_notes"
        name="availability_notes"
    >{{ old('availability_notes', $skillOffer->availability_notes ?? '') }}</textarea>
    @error('availability_notes')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<button type="submit">{{ $buttonText }}</button>
