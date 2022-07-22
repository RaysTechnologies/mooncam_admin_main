<?php

namespace App\Http\Controllers\Api;

use App\Models\HostProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GiftTransactionResource;
use App\Http\Resources\GiftTransactionCollection;

class HostProfileGiftTransactionsController extends Controller
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

        $giftTransactions = $hostProfile
            ->giftTransactions()
            ->search($search)
            ->latest()
            ->paginate();

        return new GiftTransactionCollection($giftTransactions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HostProfile $hostProfile)
    {
        $this->authorize('create', GiftTransaction::class);

        $validated = $request->validate([
            'reciever_id' => ['nullable', 'max:255', 'string'],
            'sender_id' => ['required', 'max:255', 'string'],
            'gift_id' => ['nullable', 'max:255', 'string'],
            'gift_name' => ['nullable', 'max:255', 'string'],
            'token' => ['nullable', 'max:255', 'string'],
        ]);

        $giftTransaction = $hostProfile->giftTransactions()->create($validated);

        return new GiftTransactionResource($giftTransaction);
    }
}
