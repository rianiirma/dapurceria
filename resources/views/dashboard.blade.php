@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
                <p>You're logged in as: <strong>{{ auth()->user()->name }}</strong></p>
                <p class="mt-2">Role: <strong>{{ auth()->user()->role }}</strong></p>
                
                @if(auth()->user()->isAdmin())
                    <div class="mt-6">
                        <a href="" class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 inline-block">
                            Go to Admin Dashboard
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection