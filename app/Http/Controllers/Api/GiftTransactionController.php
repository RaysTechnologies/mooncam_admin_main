<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\GiftTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\GiftTransactionResource;
use App\Http\Resources\GiftTransactionCollection;
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
            ->paginate();

        return new GiftTransactionCollection($giftTransactions);
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

        return new GiftTransactionResource($giftTransaction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GiftTransaction $giftTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, GiftTransaction $giftTransaction)
    {
        $this->authorize('view', $giftTransaction);

        return new GiftTransactionResource($giftTransaction);
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

        return new GiftTransactionResource($giftTransaction);
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

        return response()->noContent();
    }
}
