@extends('layouts.email')

@section('title')
    Registration confirmation
@endsection

@section('main')
    <p>
    <h1 style="font-size: 20px;color:#37474f;margin: 0;">{{ trans('emails.tickets.hi', [], 'messages', $email['locale']) }}, {{ $email['first_name'] }}</h1>
    <br><br>
    <p style="color: #455a64;margin: 0;text-align: justify !important;">
        {{ trans('emails.tickets.p1', [], 'messages', $email['locale']) }}

        <br><br>

        {{ trans('emails.tickets.p2', [], 'messages', $email['locale']) }}

    </p>
    <br><br>
    </p>
    <p style="text-align: center !important;">
        <h2>Voucher</h2>
        {!! html_entity_decode($email['voucher']) !!}
    </p>
    <p style="text-align: center !important;">
        <h2>Tickets</h2>
        @foreach($email['tickets'] as $ticket)
            {!! html_entity_decode($ticket) !!}
            </hr>
        @endforeach
    </p>
@endsection