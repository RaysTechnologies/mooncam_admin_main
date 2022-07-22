<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ReportAndBlock;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReportAndBlockResource;
use App\Http\Resources\ReportAndBlockCollection;
use App\Http\Requests\ReportAndBlockStoreRequest;
use App\Http\Requests\ReportAndBlockUpdateRequest;

class ReportAndBlockController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', ReportAndBlock::class);

        $search = $request->get('search', '');

        $reportAndBlocks = ReportAndBlock::search($search)
            ->latest()
            ->paginate();

        return new ReportAndBlockCollection($reportAndBlocks);
    }

    /**
     * @param \App\Http\Requests\ReportAndBlockStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportAndBlockStoreRequest $request)
    {
        $this->authorize('create', ReportAndBlock::class);

        $validated = $request->validated();

        $reportAndBlock = ReportAndBlock::create($validated);

        return new ReportAndBlockResource($reportAndBlock);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ReportAndBlock $reportAndBlock
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ReportAndBlock $reportAndBlock)
    {
        $this->authorize('view', $reportAndBlock);

        return new ReportAndBlockResource($reportAndBlock);
    }

    /**
     * @param \App\Http\Requests\ReportAndBlockUpdateRequest $request
     * @param \App\Models\ReportAndBlock $reportAndBlock
     * @return \Illuminate\Http\Response
     */
    public function update(
        ReportAndBlockUpdateRequest $request,
        ReportAndBlock $reportAndBlock
    ) {
        $this->authorize('update', $reportAndBlock);

        $validated = $request->validated();

        $reportAndBlock->update($validated);

        return new ReportAndBlockResource($reportAndBlock);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ReportAndBlock $reportAndBlock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ReportAndBlock $reportAndBlock)
    {
        $this->authorize('delete', $reportAndBlock);

        $reportAndBlock->delete();

        return response()->noContent();
    }
}
