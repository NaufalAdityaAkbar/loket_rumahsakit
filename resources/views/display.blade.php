@extends('layouts.app')

@section('title', 'Display Antrian')

@section('content')
    <h2 class="text-2xl mb-4">Display Antrian</h2>

    <div>
        <livewire:display-queue />
    </div>
@endsection
