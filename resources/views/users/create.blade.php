@extends('layouts.app')


@section('content')

  <form action="{{ route('user.store') }}" method="POST">

   @csrf



  </form>

@endsection