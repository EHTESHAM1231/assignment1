<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SkillOffer;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SkillOfferController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of skill offers with search and filtering.
     */
    public function index(Request $request)
    {
        $query = SkillOffer::with(['user', 'category']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('skill_name', 'like', "%$search%")
                  ->orWhere('skill_level', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Filter by skill level
        if ($request->filled('level')) {
            $query->where('skill_level', $request->input('level'));
        }

        // Filter by session type
        if ($request->filled('session_type')) {
            $query->where('session_type', $request->input('session_type'));
        }

        $skillOffers = $query->orderBy('created_at', 'desc')->paginate(6)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('skill_offers.index', compact('skillOffers', 'categories'));
    }

    /**
     * Show the form for creating a new skill offer.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('skill_offers.create', compact('categories'));
    }

    /**
     * Store a newly created skill offer.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'skill_name' => 'required|string|max:255',
            'skill_level' => 'required|in:Beginner,Intermediate,Advanced,Expert',
            'session_type' => 'required|in:Online,In Person,Both',
            'contact_method' => 'required|string|max:255',
            'availability_notes' => 'nullable|string|max:1000',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Add the authenticated user's ID
        $data['user_id'] = auth()->id();

        SkillOffer::create($data);

        return redirect()->route('skill-offers.index')
            ->with('success', 'Skill offer created successfully!');
    }

    /**
     * Display the specified skill offer.
     */
    public function show(SkillOffer $skillOffer)
    {
        $skillOffer->load(['user', 'category']);
        return view('skill_offers.show', compact('skillOffer'));
    }

    /**
     * Show the form for editing the specified skill offer.
     */
    public function edit(SkillOffer $skillOffer)
    {
        // Only allow the owner to edit their skill offer
        $this->authorize('update', $skillOffer);
        
        $categories = Category::orderBy('name')->get();
        return view('skill_offers.edit', compact('skillOffer', 'categories'));
    }

    /**
     * Update the specified skill offer.
     */
    public function update(Request $request, SkillOffer $skillOffer)
    {
        // Only allow the owner to update their skill offer
        $this->authorize('update', $skillOffer);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'skill_name' => 'required|string|max:255',
            'skill_level' => 'required|in:Beginner,Intermediate,Advanced,Expert',
            'session_type' => 'required|in:Online,In Person,Both',
            'contact_method' => 'required|string|max:255',
            'availability_notes' => 'nullable|string|max:1000',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $skillOffer->update($data);

        return redirect()->route('skill-offers.index')
            ->with('success', 'Skill offer updated successfully!');
    }

    /**
     * Remove the specified skill offer.
     */
    public function destroy(SkillOffer $skillOffer)
    {
        // Only allow the owner to delete their skill offer
        $this->authorize('delete', $skillOffer);
        
        $skillOffer->delete();

        return redirect()->route('skill-offers.index')
            ->with('success', 'Skill offer deleted successfully!');
    }
}