<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the organisations.
     */
    public function index(): Response
    {
        return Inertia::render('Organisations/Index', [
            'organisations' => Organisation::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new organisation.
     */
    public function create(): Response
    {
        return Inertia::render('Organisations/Create');
    }

    /**
     * Store a newly created organisation in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        Organisation::create($validated);

        return redirect()->route('organisations.index')
            ->with('success', 'Organisation created successfully.');
    }

    /**
     * Display the specified organisation.
     */
    public function show(Organisation $organisation): Response
    {
        return Inertia::render('Organisations/Show', [
            'organisation' => $organisation,
            'farmingBlocks' => $organisation->farmingBlocks,
            'factories' => $organisation->factories,
        ]);
    }

    /**
     * Show the form for editing the specified organisation.
     */
    public function edit(Organisation $organisation): Response
    {
        return Inertia::render('Organisations/Edit', [
            'organisation' => $organisation,
        ]);
    }

    /**
     * Update the specified organisation in storage.
     */
    public function update(Request $request, Organisation $organisation): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $organisation->update($validated);

        return redirect()->route('organisations.index')
            ->with('success', 'Organisation updated successfully.');
    }

    /**
     * Remove the specified organisation from storage.
     */
    public function destroy(Organisation $organisation): RedirectResponse
    {
        $organisation->delete();

        return redirect()->route('organisations.index')
            ->with('success', 'Organisation deleted successfully.');
    }
} 