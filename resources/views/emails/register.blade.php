@extends('layouts.email')

@section('title')
    Registration confirmation
@endsection

@section('main')
    <div style="color: #455a64;margin: 0;padding-top: 10px">
        <br>
        <h1 style="font-size: 30px;color:#37474f;margin: 0;">{{ trans('emails.hi', [], 'messages', $email['locale']) }}, {{ $email['first_name'] }}</h1>
        <br>

        <p>
            <h2>{{ trans('emails.register.subject', [], 'messages', $email['locale']) }}</h2>
            {{ trans('emails.register.msg', [], 'messages', $email['locale']) }}
            <br><br>
            <a href="{{ $email['verify_link'] }}" style="border-radius: 3px;background: #3aa54c;color: #fff;display: block;font-weight: 700;font-size: 16px;line-height: 1.25em;margin: 24px auto 24px;padding: 10px 18px;text-decoration: none;width: 180px; text-align: center;">
                {{ trans('emails.register.btn', [], 'messages', $email['locale']) }}
            </a>
        </p>
    </div>
@endsection