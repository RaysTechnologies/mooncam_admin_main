@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('gift-transactions.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.gift_transactions.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.gift_transactions.inputs.reciever_id')</h5>
                    <span>{{ $giftTransaction->reciever_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.gift_transactions.inputs.sender_id')</h5>
                    <span>{{ $giftTransaction->sender_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.gift_transactions.inputs.gift_id')</h5>
                    <span>{{ $giftTransaction->gift_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.gift_transactions.inputs.gift_name')</h5>
                    <span>{{ $giftTransaction->gift_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.gift_transactions.inputs.token')</h5>
                    <span>{{ $giftTransaction->token ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.gift_transactions.inputs.host_profile_id')
                    </h5>
                    <span
                        >{{ optional($giftTransaction->hostProfile)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('gift-transactions.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\GiftTransaction::class)
                <a
                    href="{{ route('gift-transactions.create') }}"
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
