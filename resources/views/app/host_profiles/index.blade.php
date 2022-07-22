@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.host_profiles.index_title')
                </h4>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="input-group">
                                <input
                                    id="indexSearch"
                                    type="text"
                                    name="search"
                                    placeholder="{{ __('crud.common.search') }}"
                                    value="{{ $search ?? '' }}"
                                    class="form-control"
                                    autocomplete="off"
                                />
                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        <i class="icon ion-md-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        @can('create', App\Models\HostProfile::class)
                        <a
                            href="{{ route('host-profiles.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.age')
                            </th>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.mobile')
                            </th>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.email')
                            </th>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.gender')
                            </th>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.photo')
                            </th>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.fans_count')
                            </th>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.followup_count')
                            </th>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.visitor_count')
                            </th>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.firebase_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.token_rate_videocall')
                            </th>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.token_rate_groupcall')
                            </th>
                            <th class="text-left">
                                @lang('crud.host_profiles.inputs.user_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hostProfiles as $hostProfile)
                        <tr>
                            <td>{{ $hostProfile->name ?? '-' }}</td>
                            <td>{{ $hostProfile->age ?? '-' }}</td>
                            <td>{{ $hostProfile->mobile ?? '-' }}</td>
                            <td>{{ $hostProfile->email ?? '-' }}</td>
                            <td>{{ $hostProfile->gender ?? '-' }}</td>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $hostProfile->photo ? \Storage::url($hostProfile->photo) : '' }}"
                                />
                            </td>
                            <td>{{ $hostProfile->fans_count ?? '-' }}</td>
                            <td>{{ $hostProfile->followup_count ?? '-' }}</td>
                            <td>{{ $hostProfile->visitor_count ?? '-' }}</td>
                            <td>{{ $hostProfile->firebase_id ?? '-' }}</td>
                            <td>
                                {{ $hostProfile->token_rate_videocall ?? '-' }}
                            </td>
                            <td>
                                {{ $hostProfile->token_rate_groupcall ?? '-' }}
                            </td>
                            <td>
                                {{ optional($hostProfile->user)->name ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $hostProfile)
                                    <a
                                        href="{{ route('host-profiles.edit', $hostProfile) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $hostProfile)
                                    <a
                                        href="{{ route('host-profiles.show', $hostProfile) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $hostProfile)
                                    <form
                                        action="{{ route('host-profiles.destroy', $hostProfile) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="14">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="14">
                                {!! $hostProfiles->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
