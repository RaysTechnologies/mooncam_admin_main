@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a
                    href="{{ route('free-token-transactions.index') }}"
                    class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.free_token_transactions.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.free_token_transactions.inputs.free_token')
                    </h5>
                    <span>{{ $freeTokenTransaction->free_token ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.free_token_transactions.inputs.host_profile_id')
                    </h5>
                    <span
                        >{{ optional($freeTokenTransaction->hostProfile)->name
                        ?? '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('free-token-transactions.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\FreeTokenTransaction::class)
                <a
                    href="{{ route('free-token-transactions.create') }}"
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
