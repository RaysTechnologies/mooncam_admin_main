<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RechargeAmount;
use App\Http\Requests\RechargeAmountStoreRequest;
use App\Http\Requests\RechargeAmountUpdateRequest;

class RechargeAmountController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', RechargeAmount::class);

        $search = $request->get('search', '');

        $rechargeAmounts = RechargeAmount::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.recharge_amounts.index',
            compact('rechargeAmounts', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', RechargeAmount::class);

        $users = User::pluck('name', 'id');

        return view('app.recharge_amounts.create', compact('users'));
    }

    /**
     * @param \App\Http\Requests\RechargeAmountStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RechargeAmountStoreRequest $request)
    {
        $this->authorize('create', RechargeAmount::class);

        $validated = $request->validated();

        $rechargeAmount = RechargeAmount::create($validated);

        return redirect()
            ->route('recharge-amounts.edit', $rechargeAmount)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RechargeAmount $rechargeAmount
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, RechargeAmount $rechargeAmount)
    {
        $this->authorize('view', $rechargeAmount);

        return view('app.recharge_amounts.show', compact('rechargeAmount'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RechargeAmount $rechargeAmount
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, RechargeAmount $rechargeAmount)
    {
        $this->authorize('update', $rechargeAmount);

        $users = User::pluck('name', 'id');

        return view(
            'app.recharge_amounts.edit',
            compact('rechargeAmount', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\RechargeAmountUpdateRequest $request
     * @param \App\Models\RechargeAmount $rechargeAmount
     * @return \Illuminate\Http\Response
     */
    public function update(
        RechargeAmountUpdateRequest $request,
        RechargeAmount $rechargeAmount
    ) {
        $this->authorize('update', $rechargeAmount);

        $validated = $request->validated();

        $rechargeAmount->update($validated);

        return redirect()
            ->route('recharge-amounts.edit', $rechargeAmount)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RechargeAmount $rechargeAmount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, RechargeAmount $rechargeAmount)
    {
        $this->authorize('delete', $rechargeAmount);

        $rechargeAmount->delete();

        return redirect()
            ->route('recharge-amounts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
