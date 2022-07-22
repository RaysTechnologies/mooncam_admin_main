<?php

namespace App\Http\Controllers\Api;

use App\Models\CountryList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryListResource;
use App\Http\Resources\CountryListCollection;
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
            ->paginate();

        return new CountryListCollection($countryLists);
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

        return new CountryListResource($countryList);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CountryList $countryList
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CountryList $countryList)
    {
        $this->authorize('view', $countryList);

        return new CountryListResource($countryList);
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

        return new CountryListResource($countryList);
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

        return response()->noContent();
    }
}
