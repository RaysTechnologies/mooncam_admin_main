<?php

namespace App\Http\Controllers;

use App\Models\HostProfile;
use Illuminate\Http\Request;
use App\Models\FreeTokenTransaction;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.free_token_transactions.index',
            compact('freeTokenTransactions', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', FreeTokenTransaction::class);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view(
            'app.free_token_transactions.create',
            compact('hostProfiles')
        );
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

        return redirect()
            ->route('free-token-transactions.edit', $freeTokenTransaction)
            ->withSuccess(__('crud.common.created'));
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

        return view(
            'app.free_token_transactions.show',
            compact('freeTokenTransaction')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FreeTokenTransaction $freeTokenTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Request $request,
        FreeTokenTransaction $freeTokenTransaction
    ) {
        $this->authorize('update', $freeTokenTransaction);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view(
            'app.free_token_transactions.edit',
            compact('freeTokenTransaction', 'hostProfiles')
        );
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

        return redirect()
            ->route('free-token-transactions.edit', $freeTokenTransaction)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('free-token-transactions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
