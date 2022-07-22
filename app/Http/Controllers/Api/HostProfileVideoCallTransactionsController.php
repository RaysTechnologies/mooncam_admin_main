<?php

namespace App\Http\Controllers\Api;

use App\Models\HostProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VideoCallTransactionResource;
use App\Http\Resources\VideoCallTransactionCollection;

class HostProfileVideoCallTransactionsController extends Controller
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

        $videoCallTransactions = $hostProfile
            ->videoCallTransactions()
            ->search($search)
            ->latest()
            ->paginate();

        return new VideoCallTransactionCollection($videoCallTransactions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HostProfile $hostProfile)
    {
        $this->authorize('create', VideoCallTransaction::class);

        $validated = $request->validate([
            'reciever_id' => ['nullable', 'max:255', 'string'],
            'sender_id' => ['nullable', 'max:255', 'string'],
            'call_duration' => ['nullable', 'max:255', 'string'],
            'token_charge' => ['nullable', 'max:255', 'string'],
        ]);

        $videoCallTransaction = $hostProfile
            ->videoCallTransactions()
            ->create($validated);

        return new VideoCallTransactionResource($videoCallTransaction);
    }
}
