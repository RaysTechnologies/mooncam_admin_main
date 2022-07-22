@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a
                    href="{{ route('withdrawl-transactions.index') }}"
                    class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.withdrawl_transactions.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.withdrawl_transactions.inputs.token')</h5>
                    <span>{{ $withdrawlTransaction->token ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.withdrawl_transactions.inputs.total_amount')
                    </h5>
                    <span
                        >{{ $withdrawlTransaction->total_amount ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.withdrawl_transactions.inputs.recieved_amount')
                    </h5>
                    <span
                        >{{ $withdrawlTransaction->recieved_amount ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.withdrawl_transactions.inputs.commision')
                    </h5>
                    <span>{{ $withdrawlTransaction->commision ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.withdrawl_transactions.inputs.status')</h5>
                    <span>{{ $withdrawlTransaction->status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.withdrawl_transactions.inputs.date')</h5>
                    <span>{{ $withdrawlTransaction->date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.withdrawl_transactions.inputs.host_profile_id')
                    </h5>
                    <span
                        >{{ optional($withdrawlTransaction->hostProfile)->name
                        ?? '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('withdrawl-transactions.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\WithdrawlTransaction::class)
                <a
                    href="{{ route('withdrawl-transactions.create') }}"
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
