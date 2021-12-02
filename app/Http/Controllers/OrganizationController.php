<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Organization/Index',[
            'organizations' => Organization::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Organization/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizationRequest $request)
    {
        $validated = $request->validated();

        Organization::create($validated);
        return redirect()->route('organizations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        return Inertia::render('Organization/Show' , compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        return Inertia::render('Organization/Edit' , compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrganizationRequest $request, Organization $organization)
    {
        $validated = $request->safe()->only(['name', 'email','kvk','street','phone']);

        $organization->update($validated);

        return redirect()->route('organizations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        return Redirect::route('organizations.index');

    }
}
