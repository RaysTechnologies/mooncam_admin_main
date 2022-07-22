<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CountryList;
use Illuminate\Http\Request;
use App\Http\Requests\CountryListStoreRequest;
use App\Http\Requests\CountryListUpdateRequest;

class CountryListController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', CountryList::class);

        $search = $request->get('search', '');

        $countryLists = CountryList::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.country_lists.index',
            compact('countryLists', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', CountryList::class);

        $users = User::pluck('name', 'id');

        return view('app.country_lists.create', compact('users'));
    }

    /**
     * @param \App\Http\Requests\CountryListStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryListStoreRequest $request)
    {
        $this->authorize('create', CountryList::class);

        $validated = $request->validated();

        $countryList = CountryList::create($validated);

        return redirect()
            ->route('country-lists.edit', $countryList)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CountryList $countryList
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CountryList $countryList)
    {
        $this->authorize('view', $countryList);

        return view('app.country_lists.show', compact('countryList'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CountryList $countryList
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CountryList $countryList)
    {
        $this->authorize('update', $countryList);

        $users = User::pluck('name', 'id');

        return view('app.country_lists.edit', compact('countryList', 'users'));
    }

    /**
     * @param \App\Http\Requests\CountryListUpdateRequest $request
     * @param \App\Models\CountryList $countryList
     * @return \Illuminate\Http\Response
     */
    public function update(
        CountryListUpdateRequest $request,
        CountryList $countryList
    ) {
        $this->authorize('update', $countryList);

        $validated = $request->validated();

        $countryList->update($validated);

        return redirect()
            ->route('country-lists.edit', $countryList)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CountryList $countryList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CountryList $countryList)
    {
        $this->authorize('delete', $countryList);

        $countryList->delete();

        return redirect()
            ->route('country-lists.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
