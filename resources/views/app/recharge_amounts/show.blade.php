@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('recharge-amounts.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.recharge_amounts.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.recharge_amounts.inputs.amount')</h5>
                    <span>{{ $rechargeAmount->amount ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.recharge_amounts.inputs.token')</h5>
                    <span>{{ $rechargeAmount->token ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.recharge_amounts.inputs.unit')</h5>
                    <span>{{ $rechargeAmount->unit ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.recharge_amounts.inputs.user_id')</h5>
                    <span
                        >{{ optional($rechargeAmount->user)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('recharge-amounts.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\RechargeAmount::class)
                <a
                    href="{{ route('recharge-amounts.create') }}"
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
