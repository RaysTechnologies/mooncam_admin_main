<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\HostProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\GalleryStoreRequest;
use App\Http\Requests\GalleryUpdateRequest;

class GalleryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Gallery::class);

        $search = $request->get('search', '');

        $galleries = Gallery::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.galleries.index', compact('galleries', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Gallery::class);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view('app.galleries.create', compact('hostProfiles'));
    }

    /**
     * @param \App\Http\Requests\GalleryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryStoreRequest $request)
    {
        $this->authorize('create', Gallery::class);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $gallery = Gallery::create($validated);

        return redirect()
            ->route('galleries.edit', $gallery)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Gallery $gallery)
    {
        $this->authorize('view', $gallery);

        return view('app.galleries.show', compact('gallery'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Gallery $gallery)
    {
        $this->authorize('update', $gallery);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view('app.galleries.edit', compact('gallery', 'hostProfiles'));
    }

    /**
     * @param \App\Http\Requests\GalleryUpdateRequest $request
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryUpdateRequest $request, Gallery $gallery)
    {
        $this->authorize('update', $gallery);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            if ($gallery->photo) {
                Storage::delete($gallery->photo);
            }

            $validated['photo'] = $request->file('photo')->store('public');
        }

        $gallery->update($validated);

        return redirect()
            ->route('galleries.edit', $gallery)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Gallery $gallery)
    {
        $this->authorize('delete', $gallery);

        if ($gallery->photo) {
            Storage::delete($gallery->photo);
        }

        $gallery->delete();

        return redirect()
            ->route('galleries.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
