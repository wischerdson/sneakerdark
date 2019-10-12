@extends('layouts.default')


@section('content')

Personal account. Login completed.<br>
{{ $customer->personal_data->first_name }} {{ $customer->personal_data->last_name }}

@endsection