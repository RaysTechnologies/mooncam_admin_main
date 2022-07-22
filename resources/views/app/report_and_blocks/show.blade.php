@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('report-and-blocks.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.report_and_blocks.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.report_and_blocks.inputs.blocked_user_id')
                    </h5>
                    <span>{{ $reportAndBlock->blocked_user_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.report_and_blocks.inputs.blocked_user_name')
                    </h5>
                    <span>{{ $reportAndBlock->blocked_user_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.report_and_blocks.inputs.host_profile_id')
                    </h5>
                    <span
                        >{{ optional($reportAndBlock->hostProfile)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('report-and-blocks.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\ReportAndBlock::class)
                <a
                    href="{{ route('report-and-blocks.create') }}"
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
