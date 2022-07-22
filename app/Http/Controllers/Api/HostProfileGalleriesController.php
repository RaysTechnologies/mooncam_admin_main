<?php

namespace App\Http\Controllers\Api;

use App\Models\HostProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Http\Resources\GalleryCollection;

class HostProfileGalleriesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, HostProfile $hostProfile)
    {
        $this->authorize('view', $hostProfile);

        $search = $request->get('search', '');

        $galleries = $hostProfile
            ->galleries()
            ->search($search)
            ->latest()
            ->paginate();

        return new GalleryCollection($galleries);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HostProfile $hostProfile)
    {
        $this->authorize('create', Gallery::class);

        $validated = $request->validate([
            'photo' => ['nullable', 'file'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $gallery = $hostProfile->galleries()->create($validated);

        return new GalleryResource($gallery);
    }
}
