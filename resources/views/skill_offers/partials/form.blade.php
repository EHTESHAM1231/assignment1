<div class="space-y-6">
    <!-- Name Field -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Your Name</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $skillOffer->name ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
            required
        >
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Skill Name Field -->
    <div>
        <label for="skill_name" class="block text-sm font-medium text-gray-700">Skill Name</label>
        <input
            type="text"
            id="skill_name"
            name="skill_name"
            value="{{ old('skill_name', $skillOffer->skill_name ?? '') }}"
            placeholder="e.g., Guitar, Python Programming, Photography"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('skill_name') border-red-500 @enderror"
            required
        >
        @error('skill_name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Category Field -->
    @if(isset($categories) && $categories->count() > 0)
    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
        <select 
            id="category_id" 
            name="category_id"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('category_id') border-red-500 @enderror"
        >
            <option value="">-- Select a category (optional) --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $skillOffer->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    @endif

    <!-- Skill Level Field -->
    <div>
        <label for="skill_level" class="block text-sm font-medium text-gray-700">Your Expertise Level</label>
        <select 
            id="skill_level" 
            name="skill_level"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('skill_level') border-red-500 @enderror"
            required
        >
            @php
                $levels = ['Beginner', 'Intermediate', 'Advanced', 'Expert'];
                $selected = old('skill_level', $skillOffer->skill_level ?? '');
            @endphp
            <option value="">-- Select your level --</option>
            @foreach ($levels as $level)
                <option value="{{ $level }}" {{ $selected === $level ? 'selected' : '' }}>
                    {{ $level }}
                </option>
            @endforeach
        </select>
        @error('skill_level')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Session Type Field -->
    <div>
        <label for="session_type" class="block text-sm font-medium text-gray-700">Teaching Mode</label>
        <select 
            id="session_type" 
            name="session_type"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('session_type') border-red-500 @enderror"
            required
        >
            @php
                $types = ['Online', 'In Person', 'Both'];
                $selectedType = old('session_type', $skillOffer->session_type ?? '');
            @endphp
            <option value="">-- Select teaching mode --</option>
            @foreach ($types as $type)
                <option value="{{ $type }}" {{ $selectedType === $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach
        </select>
        @error('session_type')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Contact Method Field -->
    <div>
        <label for="contact_method" class="block text-sm font-medium text-gray-700">Contact Method</label>
        <input
            type="text"
            id="contact_method"
            name="contact_method"
            value="{{ old('contact_method', $skillOffer->contact_method ?? '') }}"
            placeholder="e.g., email@example.com or phone number"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('contact_method') border-red-500 @enderror"
            required
        >
        @error('contact_method')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Availability Notes Field -->
    <div>
        <label for="availability_notes" class="block text-sm font-medium text-gray-700">Availability Notes (Optional)</label>
        <textarea
            id="availability_notes"
            name="availability_notes"
            rows="3"
            placeholder="e.g., Available weekends, evenings after 6pm..."
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('availability_notes') border-red-500 @enderror"
        >{{ old('availability_notes', $skillOffer->availability_notes ?? '') }}</textarea>
        @error('availability_notes')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="flex items-center justify-end space-x-4 pt-4">
        <a href="{{ route('skill-offers.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
            Cancel
        </a>
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            {{ $buttonText }}
        </button>
    </div>
</div>