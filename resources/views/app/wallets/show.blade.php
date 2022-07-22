@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('wallets.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.wallets.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.wallets.inputs.token')</h5>
                    <span>{{ $wallet->token ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.wallets.inputs.free_token')</h5>
                    <span>{{ $wallet->free_token ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.wallets.inputs.host_profile_id')</h5>
                    <span
                        >{{ optional($wallet->hostProfile)->name ?? '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('wallets.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Wallet::class)
                <a href="{{ route('wallets.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
