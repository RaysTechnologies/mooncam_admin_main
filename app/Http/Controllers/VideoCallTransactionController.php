<?php

namespace App\Http\Controllers;

use App\Models\HostProfile;
use Illuminate\Http\Request;
use App\Models\VideoCallTransaction;
use App\Http\Requests\VideoCallTransactionStoreRequest;
use App\Http\Requests\VideoCallTransactionUpdateRequest;

class VideoCallTransactionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', VideoCallTransaction::class);

        $search = $request->get('search', '');

        $videoCallTransactions = VideoCallTransaction::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.video_call_transactions.index',
            compact('videoCallTransactions', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', VideoCallTransaction::class);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view(
            'app.video_call_transactions.create',
            compact('hostProfiles')
        );
    }

    /**
     * @param \App\Http\Requests\VideoCallTransactionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoCallTransactionStoreRequest $request)
    {
        $this->authorize('create', VideoCallTransaction::class);

        $validated = $request->validated();

        $videoCallTransaction = VideoCallTransaction::create($validated);

        return redirect()
            ->route('video-call-transactions.edit', $videoCallTransaction)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\VideoCallTransaction $videoCallTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        VideoCallTransaction $videoCallTransaction
    ) {
        $this->authorize('view', $videoCallTransaction);

        return view(
            'app.video_call_transactions.show',
            compact('videoCallTransaction')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\VideoCallTransaction $videoCallTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Request $request,
        VideoCallTransaction $videoCallTransaction
    ) {
        $this->authorize('update', $videoCallTransaction);

        $hostProfiles = HostProfile::pluck('name', 'id');

        return view(
            'app.video_call_transactions.edit',
            compact('videoCallTransaction', 'hostProfiles')
        );
    }

    /**
     * @param \App\Http\Requests\VideoCallTransactionUpdateRequest $request
     * @param \App\Models\VideoCallTransaction $videoCallTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(
        VideoCallTransactionUpdateRequest $request,
        VideoCallTransaction $videoCallTransaction
    ) {
        $this->authorize('update', $videoCallTransaction);

        $validated = $request->validated();

        $videoCallTransaction->update($validated);

        return redirect()
            ->route('video-call-transactions.edit', $videoCallTransaction)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\VideoCallTransaction $videoCallTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        VideoCallTransaction $videoCallTransaction
    ) {
        $this->authorize('delete', $videoCallTransaction);

        $videoCallTransaction->delete();

        return redirect()
            ->route('video-call-transactions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
