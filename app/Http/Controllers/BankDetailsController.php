<?php

namespace App\Http\Controllers;

use App\Models\BankDetails;
use App\Models\HostProfile;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_bank_details.index',
            compact('allBankDetails', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', BankDetails::class);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view('app.all_bank_details.create', compact('hostProfiles'));
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

        return redirect()
            ->route('all-bank-details.edit', $bankDetails)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BankDetails $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BankDetails $bankDetails)
    {
        $this->authorize('view', $bankDetails);

        return view('app.all_bank_details.show', compact('bankDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BankDetails $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BankDetails $bankDetails)
    {
        $this->authorize('update', $bankDetails);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view(
            'app.all_bank_details.edit',
            compact('bankDetails', 'hostProfiles')
        );
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

        return redirect()
            ->route('all-bank-details.edit', $bankDetails)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('all-bank-details.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
