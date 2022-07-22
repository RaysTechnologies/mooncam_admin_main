@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a
                    href="{{ route('video-call-transactions.index') }}"
                    class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.video_call_transactions.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.video_call_transactions.inputs.reciever_id')
                    </h5>
                    <span>{{ $videoCallTransaction->reciever_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.video_call_transactions.inputs.sender_id')
                    </h5>
                    <span>{{ $videoCallTransaction->sender_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.video_call_transactions.inputs.call_duration')
                    </h5>
                    <span
                        >{{ $videoCallTransaction->call_duration ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.video_call_transactions.inputs.token_charge')
                    </h5>
                    <span
                        >{{ $videoCallTransaction->token_charge ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.video_call_transactions.inputs.host_profile_id')
                    </h5>
                    <span
                        >{{ optional($videoCallTransaction->hostProfile)->name
                        ?? '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('video-call-transactions.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\VideoCallTransaction::class)
                <a
                    href="{{ route('video-call-transactions.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
