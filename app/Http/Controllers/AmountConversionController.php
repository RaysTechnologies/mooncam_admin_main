<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AmountConversion;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.amount_conversions.index',
            compact('amountConversions', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', AmountConversion::class);

        $users = User::pluck('name', 'id');

        return view('app.amount_conversions.create', compact('users'));
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

        return redirect()
            ->route('amount-conversions.edit', $amountConversion)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AmountConversion $amountConversion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AmountConversion $amountConversion)
    {
        $this->authorize('view', $amountConversion);

        return view('app.amount_conversions.show', compact('amountConversion'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AmountConversion $amountConversion
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, AmountConversion $amountConversion)
    {
        $this->authorize('update', $amountConversion);

        $users = User::pluck('name', 'id');

        return view(
            'app.amount_conversions.edit',
            compact('amountConversion', 'users')
        );
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

        return redirect()
            ->route('amount-conversions.edit', $amountConversion)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('amount-conversions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
