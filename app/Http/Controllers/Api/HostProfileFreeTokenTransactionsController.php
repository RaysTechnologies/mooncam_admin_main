<?php

namespace App\Http\Controllers\Api;

use App\Models\HostProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FreeTokenTransactionResource;
use App\Http\Resources\FreeTokenTransactionCollection;

class HostProfileFreeTokenTransactionsController extends Controller
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

        $freeTokenTransactions = $hostProfile
            ->freeTokenTransactions()
            ->search($search)
            ->latest()
            ->paginate();

        return new FreeTokenTransactionCollection($freeTokenTransactions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HostProfile $hostProfile)
    {
        $this->authorize('create', FreeTokenTransaction::class);

        $validated = $request->validate([
            'free_token' => ['required', 'max:255', 'string'],
        ]);

        $freeTokenTransaction = $hostProfile
            ->freeTokenTransactions()
            ->create($validated);

        return new FreeTokenTransactionResource($freeTokenTransaction);
    }
}
