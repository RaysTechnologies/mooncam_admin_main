<?php

namespace App\Http\Controllers\Api;

use App\Models\BankDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BankDetailsResource;
use App\Http\Resources\BankDetailsCollection;
use App\Http\Requests\BankDetailsStoreRequest;
use App\Http\Requests\BankDetailsUpdateRequest;

class BankDetailsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', BankDetails::class);

        $search = $request->get('search', '');

        $allBankDetails = BankDetails::search($search)
            ->latest()
            ->paginate();

        return new BankDetailsCollection($allBankDetails);
    }

    /**
     * @param \App\Http\Requests\BankDetailsStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankDetailsStoreRequest $request)
    {
        $this->authorize('create', BankDetails::class);

        $validated = $request->validated();

        $bankDetails = BankDetails::create($validated);

        return new BankDetailsResource($bankDetails);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BankDetails $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BankDetails $bankDetails)
    {
        $this->authorize('view', $bankDetails);

        return new BankDetailsResource($bankDetails);
    }

    /**
     * @param \App\Http\Requests\BankDetailsUpdateRequest $request
     * @param \App\Models\BankDetails $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function update(
        BankDetailsUpdateRequest $request,
        BankDetails $bankDetails
    ) {
        $this->authorize('update', $bankDetails);

        $validated = $request->validated();

        $bankDetails->update($validated);

        return new BankDetailsResource($bankDetails);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BankDetails $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BankDetails $bankDetails)
    {
        $this->authorize('delete', $bankDetails);

        $bankDetails->delete();

        return response()->noContent();
    }
}
