@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('host-profiles.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.host_profiles.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.host_profiles.inputs.name')</h5>
                    <span>{{ $hostProfile->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.host_profiles.inputs.age')</h5>
                    <span>{{ $hostProfile->age ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.host_profiles.inputs.mobile')</h5>
                    <span>{{ $hostProfile->mobile ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.host_profiles.inputs.email')</h5>
                    <span>{{ $hostProfile->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.host_profiles.inputs.gender')</h5>
                    <span>{{ $hostProfile->gender ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.host_profiles.inputs.photo')</h5>
                    <x-partials.thumbnail
                        src="{{ $hostProfile->photo ? \Storage::url($hostProfile->photo) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.host_profiles.inputs.fans_count')</h5>
                    <span>{{ $hostProfile->fans_count ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.host_profiles.inputs.followup_count')</h5>
                    <span>{{ $hostProfile->followup_count ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.host_profiles.inputs.visitor_count')</h5>
                    <span>{{ $hostProfile->visitor_count ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.host_profiles.inputs.firebase_id')</h5>
                    <span>{{ $hostProfile->firebase_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.host_profiles.inputs.token_rate_videocall')
                    </h5>
                    <span>{{ $hostProfile->token_rate_videocall ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.host_profiles.inputs.token_rate_groupcall')
                    </h5>
                    <span>{{ $hostProfile->token_rate_groupcall ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.host_profiles.inputs.user_id')</h5>
                    <span>{{ optional($hostProfile->user)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('host-profiles.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\HostProfile::class)
                <a
                    href="{{ route('host-profiles.create') }}"
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
