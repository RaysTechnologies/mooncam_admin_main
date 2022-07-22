<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\RechargeAmount;
use App\Http\Controllers\Controller;
use App\Http\Resources\RechargeAmountResource;
use App\Http\Resources\RechargeAmountCollection;
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
            ->paginate();

        return new RechargeAmountCollection($rechargeAmounts);
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

        return new RechargeAmountResource($rechargeAmount);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RechargeAmount $rechargeAmount
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, RechargeAmount $rechargeAmount)
    {
        $this->authorize('view', $rechargeAmount);

        return new RechargeAmountResource($rechargeAmount);
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

        return new RechargeAmountResource($rechargeAmount);
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

        return response()->noContent();
    }
}
