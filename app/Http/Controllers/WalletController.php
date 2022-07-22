<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\HostProfile;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.wallets.index', compact('wallets', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Wallet::class);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view('app.wallets.create', compact('hostProfiles'));
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

        return redirect()
            ->route('wallets.edit', $wallet)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Wallet $wallet)
    {
        $this->authorize('view', $wallet);

        return view('app.wallets.show', compact('wallet'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Wallet $wallet)
    {
        $this->authorize('update', $wallet);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view('app.wallets.edit', compact('wallet', 'hostProfiles'));
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

        return redirect()
            ->route('wallets.edit', $wallet)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('wallets.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
