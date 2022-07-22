<?php

namespace App\Http\Controllers\Api;

use App\Models\GiftList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\GiftListResource;
use App\Http\Resources\GiftListCollection;
use App\Http\Requests\GiftListStoreRequest;
use App\Http\Requests\GiftListUpdateRequest;

class GiftListController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', GiftList::class);

        $search = $request->get('search', '');

        $giftLists = GiftList::search($search)
            ->latest()
            ->paginate();

        return new GiftListCollection($giftLists);
    }

    /**
     * @param \App\Http\Requests\GiftListStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GiftListStoreRequest $request)
    {
        $this->authorize('create', GiftList::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $giftList = GiftList::create($validated);

        return new GiftListResource($giftList);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GiftList $giftList
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, GiftList $giftList)
    {
        $this->authorize('view', $giftList);

        return new GiftListResource($giftList);
    }

    /**
     * @param \App\Http\Requests\GiftListUpdateRequest $request
     * @param \App\Models\GiftList $giftList
     * @return \Illuminate\Http\Response
     */
    public function update(GiftListUpdateRequest $request, GiftList $giftList)
    {
        $this->authorize('update', $giftList);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($giftList->image) {
                Storage::delete($giftList->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $giftList->update($validated);

        return new GiftListResource($giftList);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GiftList $giftList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, GiftList $giftList)
    {
        $this->authorize('delete', $giftList);

        if ($giftList->image) {
            Storage::delete($giftList->image);
        }

        $giftList->delete();

        return response()->noContent();
    }
}
