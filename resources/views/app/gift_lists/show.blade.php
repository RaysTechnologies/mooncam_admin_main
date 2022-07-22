@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('gift-lists.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.gift_lists.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.gift_lists.inputs.name')</h5>
                    <span>{{ $giftList->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.gift_lists.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $giftList->image ? \Storage::url($giftList->image) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.gift_lists.inputs.token')</h5>
                    <span>{{ $giftList->token ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.gift_lists.inputs.user_id')</h5>
                    <span>{{ optional($giftList->user)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('gift-lists.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\GiftList::class)
                <a
                    href="{{ route('gift-lists.create') }}"
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
