@extends('layouts.email')

@section('main')
    <br><br>
    @lang('emails.forgot.msg'): <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
@endsection
