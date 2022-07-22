<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\WithdrawlTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\WithdrawlTransactionResource;
use App\Http\Resources\WithdrawlTransactionCollection;
use App\Http\Requests\WithdrawlTransactionStoreRequest;
use App\Http\Requests\WithdrawlTransactionUpdateRequest;

class WithdrawlTransactionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', WithdrawlTransaction::class);

        $search = $request->get('search', '');

        $withdrawlTransactions = WithdrawlTransaction::search($search)
            ->latest()
            ->paginate();

        return new WithdrawlTransactionCollection($withdrawlTransactions);
    }

    /**
     * @param \App\Http\Requests\WithdrawlTransactionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WithdrawlTransactionStoreRequest $request)
    {
        $this->authorize('create', WithdrawlTransaction::class);

        $validated = $request->validated();

        $withdrawlTransaction = WithdrawlTransaction::create($validated);

        return new WithdrawlTransactionResource($withdrawlTransaction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\WithdrawlTransaction $withdrawlTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        WithdrawlTransaction $withdrawlTransaction
    ) {
        $this->authorize('view', $withdrawlTransaction);

        return new WithdrawlTransactionResource($withdrawlTransaction);
    }

    /**
     * @param \App\Http\Requests\WithdrawlTransactionUpdateRequest $request
     * @param \App\Models\WithdrawlTransaction $withdrawlTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(
        WithdrawlTransactionUpdateRequest $request,
        WithdrawlTransaction $withdrawlTransaction
    ) {
        $this->authorize('update', $withdrawlTransaction);

        $validated = $request->validated();

        $withdrawlTransaction->update($validated);

        return new WithdrawlTransactionResource($withdrawlTransaction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\WithdrawlTransaction $withdrawlTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        WithdrawlTransaction $withdrawlTransaction
    ) {
        $this->authorize('delete', $withdrawlTransaction);

        $withdrawlTransaction->delete();

        return response()->noContent();
    }
}
