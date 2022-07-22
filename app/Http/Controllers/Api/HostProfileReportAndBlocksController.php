<?php

namespace App\Http\Controllers\Api;

use App\Models\HostProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReportAndBlockResource;
use App\Http\Resources\ReportAndBlockCollection;

class HostProfileReportAndBlocksController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, HostProfile $hostProfile)
    {
        $this->authorize('view', $hostProfile);

        $search = $request->get('search', '');

        $reportAndBlocks = $hostProfile
            ->reportAndBlocks()
            ->search($search)
            ->latest()
            ->paginate();

        return new ReportAndBlockCollection($reportAndBlocks);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HostProfile $hostProfile
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HostProfile $hostProfile)
    {
        $this->authorize('create', ReportAndBlock::class);

        $validated = $request->validate([
            'blocked_user_id' => ['required', 'max:255', 'string'],
            'blocked_user_name' => ['required', 'max:255', 'string'],
        ]);

        $reportAndBlock = $hostProfile->reportAndBlocks()->create($validated);

        return new ReportAndBlockResource($reportAndBlock);
    }
}
