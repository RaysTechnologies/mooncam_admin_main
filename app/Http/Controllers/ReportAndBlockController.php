<?php

namespace App\Http\Controllers;

use App\Models\HostProfile;
use Illuminate\Http\Request;
use App\Models\ReportAndBlock;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.report_and_blocks.index',
            compact('reportAndBlocks', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', ReportAndBlock::class);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view('app.report_and_blocks.create', compact('hostProfiles'));
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

        return redirect()
            ->route('report-and-blocks.edit', $reportAndBlock)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ReportAndBlock $reportAndBlock
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ReportAndBlock $reportAndBlock)
    {
        $this->authorize('view', $reportAndBlock);

        return view('app.report_and_blocks.show', compact('reportAndBlock'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ReportAndBlock $reportAndBlock
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ReportAndBlock $reportAndBlock)
    {
        $this->authorize('update', $reportAndBlock);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view(
            'app.report_and_blocks.edit',
            compact('reportAndBlock', 'hostProfiles')
        );
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

        return redirect()
            ->route('report-and-blocks.edit', $reportAndBlock)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('report-and-blocks.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
