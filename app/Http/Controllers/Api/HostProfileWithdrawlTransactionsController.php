<?php

namespace App\Http\Controllers\Api;

use App\Models\HostProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WithdrawlTransactionResource;
use App\Http\Resources\WithdrawlTransactionCollection;

class HostProfileWithdrawlTransactionsController extends Controller
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

        $withdrawlTransactions = $hostProfile
            ->withdrawlTransactions()
            ->search($search)
            ->latest()
            ->paginate();

        return new WithdrawlTransactionCollection($withdrawlTransactions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HostProfile $hostProfile)
    {
        $this->authorize('create', WithdrawlTransaction::class);

        $validated = $request->validate([
            'token' => ['nullable', 'max:255', 'string'],
            'total_amount' => ['nullable', 'max:255', 'string'],
            'recieved_amount' => ['nullable', 'max:255', 'string'],
            'commision' => ['nullable', 'max:255', 'string'],
            'status' => ['nullable', 'max:255', 'string'],
            'date' => ['nullable', 'date'],
        ]);

        $withdrawlTransaction = $hostProfile
            ->withdrawlTransactions()
            ->create($validated);

        return new WithdrawlTransactionResource($withdrawlTransaction);
    }
}
