<?php

namespace App\Http\Controllers;

use App\Models\CallPrice;
use App\Models\HostProfile;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.call_prices.index', compact('callPrices', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', CallPrice::class);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view('app.call_prices.create', compact('hostProfiles'));
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

        return redirect()
            ->route('call-prices.edit', $callPrice)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CallPrice $callPrice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CallPrice $callPrice)
    {
        $this->authorize('view', $callPrice);

        return view('app.call_prices.show', compact('callPrice'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CallPrice $callPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CallPrice $callPrice)
    {
        $this->authorize('update', $callPrice);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view(
            'app.call_prices.edit',
            compact('callPrice', 'hostProfiles')
        );
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

        return redirect()
            ->route('call-prices.edit', $callPrice)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('call-prices.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
