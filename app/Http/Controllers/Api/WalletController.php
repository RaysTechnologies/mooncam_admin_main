<?php

namespace App\Http\Controllers\Api;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WalletResource;
use App\Http\Resources\WalletCollection;
use App\Http\Requests\WalletStoreRequest;
use App\Http\Requests\WalletUpdateRequest;

class WalletController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Wallet::class);

        $search = $request->get('search', '');

        $wallets = Wallet::search($search)
            ->latest()
            ->paginate();

        return new WalletCollection($wallets);
    }

    /**
     * @param \App\Http\Requests\WalletStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WalletStoreRequest $request)
    {
        $this->authorize('create', Wallet::class);

        $validated = $request->validated();

        $wallet = Wallet::create($validated);

        return new WalletResource($wallet);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Wallet $wallet)
    {
        $this->authorize('view', $wallet);

        return new WalletResource($wallet);
    }

    /**
     * @param \App\Http\Requests\WalletUpdateRequest $request
     * @param \App\Models\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(WalletUpdateRequest $request, Wallet $wallet)
    {
        $this->authorize('update', $wallet);

        $validated = $request->validated();

        $wallet->update($validated);

        return new WalletResource($wallet);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Wallet $wallet)
    {
        $this->authorize('delete', $wallet);

        $wallet->delete();

        return response()->noContent();
    }
}
