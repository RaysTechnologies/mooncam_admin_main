@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('amount-conversions.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.amount_conversions.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.amount_conversions.inputs.token')</h5>
                    <span>{{ $amountConversion->token ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.amount_conversions.inputs.amount')</h5>
                    <span>{{ $amountConversion->amount ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.amount_conversions.inputs.unit')</h5>
                    <span>{{ $amountConversion->unit ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.amount_conversions.inputs.symbol')</h5>
                    <span>{{ $amountConversion->symbol ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.amount_conversions.inputs.user_id')</h5>
                    <span
                        >{{ optional($amountConversion->user)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('amount-conversions.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\AmountConversion::class)
                <a
                    href="{{ route('amount-conversions.create') }}"
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
