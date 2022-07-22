<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\VideoCallTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\VideoCallTransactionResource;
use App\Http\Resources\VideoCallTransactionCollection;
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
            ->paginate();

        return new VideoCallTransactionCollection($videoCallTransactions);
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

        return new VideoCallTransactionResource($videoCallTransaction);
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

        return new VideoCallTransactionResource($videoCallTransaction);
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

        return new VideoCallTransactionResource($videoCallTransaction);
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

        return response()->noContent();
    }
}
