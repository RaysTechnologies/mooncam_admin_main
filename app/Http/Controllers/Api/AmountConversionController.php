<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AmountConversion;
use App\Http\Controllers\Controller;
use App\Http\Resources\AmountConversionResource;
use App\Http\Resources\AmountConversionCollection;
use App\Http\Requests\AmountConversionStoreRequest;
use App\Http\Requests\AmountConversionUpdateRequest;

class AmountConversionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', AmountConversion::class);

        $search = $request->get('search', '');

        $amountConversions = AmountConversion::search($search)
            ->latest()
            ->paginate();

        return new AmountConversionCollection($amountConversions);
    }

    /**
     * @param \App\Http\Requests\AmountConversionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AmountConversionStoreRequest $request)
    {
        $this->authorize('create', AmountConversion::class);

        $validated = $request->validated();

        $amountConversion = AmountConversion::create($validated);

        return new AmountConversionResource($amountConversion);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AmountConversion $amountConversion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AmountConversion $amountConversion)
    {
        $this->authorize('view', $amountConversion);

        return new AmountConversionResource($amountConversion);
    }

    /**
     * @param \App\Http\Requests\AmountConversionUpdateRequest $request
     * @param \App\Models\AmountConversion $amountConversion
     * @return \Illuminate\Http\Response
     */
    public function update(
        AmountConversionUpdateRequest $request,
        AmountConversion $amountConversion
    ) {
        $this->authorize('update', $amountConversion);

        $validated = $request->validated();

        $amountConversion->update($validated);

        return new AmountConversionResource($amountConversion);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AmountConversion $amountConversion
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        AmountConversion $amountConversion
    ) {
        $this->authorize('delete', $amountConversion);

        $amountConversion->delete();

        return response()->noContent();
    }
}
