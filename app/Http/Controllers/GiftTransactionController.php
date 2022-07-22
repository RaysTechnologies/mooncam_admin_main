<?php

namespace App\Http\Controllers;

use App\Models\HostProfile;
use Illuminate\Http\Request;
use App\Models\GiftTransaction;
use App\Http\Requests\GiftTransactionStoreRequest;
use App\Http\Requests\GiftTransactionUpdateRequest;

class GiftTransactionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', GiftTransaction::class);

        $search = $request->get('search', '');

        $giftTransactions = GiftTransaction::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.gift_transactions.index',
            compact('giftTransactions', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', GiftTransaction::class);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view('app.gift_transactions.create', compact('hostProfiles'));
    }

    /**
     * @param \App\Http\Requests\GiftTransactionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GiftTransactionStoreRequest $request)
    {
        $this->authorize('create', GiftTransaction::class);

        $validated = $request->validated();

        $giftTransaction = GiftTransaction::create($validated);

        return redirect()
            ->route('gift-transactions.edit', $giftTransaction)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GiftTransaction $giftTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, GiftTransaction $giftTransaction)
    {
        $this->authorize('view', $giftTransaction);

        return view('app.gift_transactions.show', compact('giftTransaction'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GiftTransaction $giftTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, GiftTransaction $giftTransaction)
    {
        $this->authorize('update', $giftTransaction);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view(
            'app.gift_transactions.edit',
            compact('giftTransaction', 'hostProfiles')
        );
    }

    /**
     * @param \App\Http\Requests\GiftTransactionUpdateRequest $request
     * @param \App\Models\GiftTransaction $giftTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(
        GiftTransactionUpdateRequest $request,
        GiftTransaction $giftTransaction
    ) {
        $this->authorize('update', $giftTransaction);

        $validated = $request->validated();

        $giftTransaction->update($validated);

        return redirect()
            ->route('gift-transactions.edit', $giftTransaction)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GiftTransaction $giftTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, GiftTransaction $giftTransaction)
    {
        $this->authorize('delete', $giftTransaction);

        $giftTransaction->delete();

        return redirect()
            ->route('gift-transactions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
