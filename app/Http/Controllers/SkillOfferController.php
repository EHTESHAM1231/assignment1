<?php

namespace App\Http\Controllers;

use App\Models\SkillOffer;
use Illuminate\Http\Request;

class SkillOfferController extends Controller
{
    // Show all skill offers
    public function index(Request $request)
    {
        $query = SkillOffer::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('skill_name', 'like', "%$search%")
                  ->orWhere('skill_level', 'like', "%$search%");
        }

        $skillOffers = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('skill_offers.index', compact('skillOffers'));
    }

    // Show create form
    public function create()
    {
        return view('skill_offers.create');
    }

    // Handle form submission for creating
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'skill_name' => 'required',
            'skill_level' => 'required',
            'session_type' => 'required',
            'contact_method' => 'required',
            'availability_notes' => 'nullable',
        ]);

        SkillOffer::create($data);

        return redirect()->route('skill-offers.index')
            ->with('success', 'Skill offer added successfully');
    }

    // Show single record
    public function show(SkillOffer $skillOffer)
    {
        return view('skill_offers.show', compact('skillOffer'));
    }

    // Show edit form
    public function edit(SkillOffer $skillOffer)
    {
        return view('skill_offers.edit', compact('skillOffer'));
    }

    // Handle update
    public function update(Request $request, SkillOffer $skillOffer)
    {
        $data = $request->validate([
            'name' => 'required',
            'skill_name' => 'required',
            'skill_level' => 'required',
            'session_type' => 'required',
            'contact_method' => 'required',
            'availability_notes' => 'nullable',
        ]);

        $skillOffer->update($data);

        return redirect()->route('skill-offers.index')
            ->with('success', 'Skill offer updated successfully');
    }

    // Delete
    public function destroy(SkillOffer $skillOffer)
    {
        $skillOffer->delete();

        return redirect()->route('skill-offers.index')
            ->with('success', 'Skill offer deleted');
    }
}
