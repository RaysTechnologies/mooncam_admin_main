@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('call-prices.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.call_prices.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.call_prices.inputs.video_call')</h5>
                    <span>{{ $callPrice->video_call ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.call_prices.inputs.live_streaming')</h5>
                    <span>{{ $callPrice->live_streaming ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.call_prices.inputs.video_call_price_limit')
                    </h5>
                    <span>{{ $callPrice->video_call_price_limit ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.call_prices.inputs.live_streaming_call_price_limit')
                    </h5>
                    <span
                        >{{ $callPrice->live_streaming_call_price_limit ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.call_prices.inputs.photo_price')</h5>
                    <span>{{ $callPrice->photo_price ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.call_prices.inputs.host_profile_id')</h5>
                    <span
                        >{{ optional($callPrice->hostProfile)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('call-prices.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\CallPrice::class)
                <a
                    href="{{ route('call-prices.create') }}"
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
