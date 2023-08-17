@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                     <!-- 予定を編集するページに遷移するボタン -->
                     <a href="{{ route('schedule_calendar') }}" class="btn btn-primary">
                         {{ __('schedule_calendar') }}
                         </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
