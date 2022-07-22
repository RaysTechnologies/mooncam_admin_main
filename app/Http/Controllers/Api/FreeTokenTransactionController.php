<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\FreeTokenTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\FreeTokenTransactionResource;
use App\Http\Resources\FreeTokenTransactionCollection;
use App\Http\Requests\FreeTokenTransactionStoreRequest;
use App\Http\Requests\FreeTokenTransactionUpdateRequest;

class FreeTokenTransactionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', FreeTokenTransaction::class);

        $search = $request->get('search', '');

        $freeTokenTransactions = FreeTokenTransaction::search($search)
            ->latest()
            ->paginate();

        return new FreeTokenTransactionCollection($freeTokenTransactions);
    }

    /**
     * @param \App\Http\Requests\FreeTokenTransactionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FreeTokenTransactionStoreRequest $request)
    {
        $this->authorize('create', FreeTokenTransaction::class);

        $validated = $request->validated();

        $freeTokenTransaction = FreeTokenTransaction::create($validated);

        return new FreeTokenTransactionResource($freeTokenTransaction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FreeTokenTransaction $freeTokenTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        FreeTokenTransaction $freeTokenTransaction
    ) {
        $this->authorize('view', $freeTokenTransaction);

        return new FreeTokenTransactionResource($freeTokenTransaction);
    }

    /**
     * @param \App\Http\Requests\FreeTokenTransactionUpdateRequest $request
     * @param \App\Models\FreeTokenTransaction $freeTokenTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(
        FreeTokenTransactionUpdateRequest $request,
        FreeTokenTransaction $freeTokenTransaction
    ) {
        $this->authorize('update', $freeTokenTransaction);

        $validated = $request->validated();

        $freeTokenTransaction->update($validated);

        return new FreeTokenTransactionResource($freeTokenTransaction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FreeTokenTransaction $freeTokenTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        FreeTokenTransaction $freeTokenTransaction
    ) {
        $this->authorize('delete', $freeTokenTransaction);

        $freeTokenTransaction->delete();

        return response()->noContent();
    }
}
