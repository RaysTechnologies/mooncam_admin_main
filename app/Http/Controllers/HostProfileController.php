<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HostProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HostProfileStoreRequest;
use App\Http\Requests\HostProfileUpdateRequest;

class HostProfileController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', HostProfile::class);

        $search = $request->get('search', '');

        $hostProfiles = HostProfile::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.host_profiles.index',
            compact('hostProfiles', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', HostProfile::class);

        $users = User::pluck('name', 'id');

        return view('app.host_profiles.create', compact('users'));
    }

    /**
     * @param \App\Http\Requests\HostProfileStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HostProfileStoreRequest $request)
    {
        $this->authorize('create', HostProfile::class);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $hostProfile = HostProfile::create($validated);

        return redirect()
            ->route('host-profiles.edit', $hostProfile)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, HostProfile $hostProfile)
    {
        $this->authorize('view', $hostProfile);

        return view('app.host_profiles.show', compact('hostProfile'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HostProfile $hostProfile)
    {
        $this->authorize('update', $hostProfile);

        $users = User::pluck('name', 'id');

        return view('app.host_profiles.edit', compact('hostProfile', 'users'));
    }

    /**
     * @param \App\Http\Requests\HostProfileUpdateRequest $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function update(
        HostProfileUpdateRequest $request,
        HostProfile $hostProfile
    ) {
        $this->authorize('update', $hostProfile);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            if ($hostProfile->photo) {
                Storage::delete($hostProfile->photo);
            }

            $validated['photo'] = $request->file('photo')->store('public');
        }

        $hostProfile->update($validated);

        return redirect()
            ->route('host-profiles.edit', $hostProfile)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, HostProfile $hostProfile)
    {
        $this->authorize('delete', $hostProfile);

        if ($hostProfile->photo) {
            Storage::delete($hostProfile->photo);
        }

        $hostProfile->delete();

        return redirect()
            ->route('host-profiles.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
