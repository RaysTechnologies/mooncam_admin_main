<?php

namespace App\Http\Controllers\Api;

use App\Models\CallPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CallPriceResource;
use App\Http\Resources\CallPriceCollection;
use App\Http\Requests\CallPriceStoreRequest;
use App\Http\Requests\CallPriceUpdateRequest;

class CallPriceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', CallPrice::class);

        $search = $request->get('search', '');

        $callPrices = CallPrice::search($search)
            ->latest()
            ->paginate();

        return new CallPriceCollection($callPrices);
    }

    /**
     * @param \App\Http\Requests\CallPriceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CallPriceStoreRequest $request)
    {
        $this->authorize('create', CallPrice::class);

        $validated = $request->validated();

        $callPrice = CallPrice::create($validated);

        return new CallPriceResource($callPrice);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CallPrice $callPrice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CallPrice $callPrice)
    {
        $this->authorize('view', $callPrice);

        return new CallPriceResource($callPrice);
    }

    /**
     * @param \App\Http\Requests\CallPriceUpdateRequest $request
     * @param \App\Models\CallPrice $callPrice
     * @return \Illuminate\Http\Response
     */
    public function update(
        CallPriceUpdateRequest $request,
        CallPrice $callPrice
    ) {
        $this->authorize('update', $callPrice);

        $validated = $request->validated();

        $callPrice->update($validated);

        return new CallPriceResource($callPrice);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CallPrice $callPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CallPrice $callPrice)
    {
        $this->authorize('delete', $callPrice);

        $callPrice->delete();

        return response()->noContent();
    }
}
