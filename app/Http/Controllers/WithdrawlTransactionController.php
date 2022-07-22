<?php

namespace App\Http\Controllers;

use App\Models\HostProfile;
use Illuminate\Http\Request;
use App\Models\WithdrawlTransaction;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.withdrawl_transactions.index',
            compact('withdrawlTransactions', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', WithdrawlTransaction::class);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view(
            'app.withdrawl_transactions.create',
            compact('hostProfiles')
        );
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

        return redirect()
            ->route('withdrawl-transactions.edit', $withdrawlTransaction)
            ->withSuccess(__('crud.common.created'));
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

        return view(
            'app.withdrawl_transactions.show',
            compact('withdrawlTransaction')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\WithdrawlTransaction $withdrawlTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Request $request,
        WithdrawlTransaction $withdrawlTransaction
    ) {
        $this->authorize('update', $withdrawlTransaction);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view(
            'app.withdrawl_transactions.edit',
            compact('withdrawlTransaction', 'hostProfiles')
        );
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

        return redirect()
            ->route('withdrawl-transactions.edit', $withdrawlTransaction)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('withdrawl-transactions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
