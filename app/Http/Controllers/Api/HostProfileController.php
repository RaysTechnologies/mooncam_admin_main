<?php

namespace App\Http\Controllers\Api;

use App\Models\HostProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\HostProfileResource;
use App\Http\Resources\HostProfileCollection;
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
            ->paginate();

        return new HostProfileCollection($hostProfiles);
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

        return new HostProfileResource($hostProfile);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, HostProfile $hostProfile)
    {
        $this->authorize('view', $hostProfile);

        return new HostProfileResource($hostProfile);
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

        return new HostProfileResource($hostProfile);
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

        return response()->noContent();
    }
}
