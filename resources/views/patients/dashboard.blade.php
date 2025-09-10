@extends('layouts.app')

@section('content')
<h3>Notifications</h3>
<ul>
@foreach(Auth::guard('patient')->user()->notifications as $notification)
    <li>
        {{ $notification->data['message'] }} 
        <small>{{ $notification->created_at->diffForHumans() }}</small>
    </li>
@endforeach
</ul>

<div class="container py-5">
    <h1 class="text-3xl font-bold mb-4">Bienvenue, {{ auth()->guard('patient')->user()->nom }}</h1>
    <p>Vous êtes connecté en tant que Patient.</p>
</div>
@endsection
