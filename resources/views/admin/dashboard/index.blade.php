

@extends('admin.layouts.app',['title' => 'Admin Dashboard'])

@section('content')
    <div>Welcome {{ auth()->user()->name }}</div>
@endsection