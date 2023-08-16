<!-- resources/views/schedules/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Schedule Details</h1>
    <p>Title: {{ $schedule->event_title }}</p>
    <p>Body: {{ $schedule->event_body }}</p>
    <p>Start Date: {{ $schedule->start_date }}</p>
    <p>End Date: {{ $schedule->end_date }}</p>
    <a href="{{ route('show') }}">Back to All Schedules</a>
@endsection
