<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GiftList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.gift_lists.index', compact('giftLists', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', GiftList::class);

        $users = User::pluck('name', 'id');

        return view('app.gift_lists.create', compact('users'));
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

        return redirect()
            ->route('gift-lists.edit', $giftList)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GiftList $giftList
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, GiftList $giftList)
    {
        $this->authorize('view', $giftList);

        return view('app.gift_lists.show', compact('giftList'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GiftList $giftList
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, GiftList $giftList)
    {
        $this->authorize('update', $giftList);

        $users = User::pluck('name', 'id');

        return view('app.gift_lists.edit', compact('giftList', 'users'));
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

        return redirect()
            ->route('gift-lists.edit', $giftList)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('gift-lists.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
