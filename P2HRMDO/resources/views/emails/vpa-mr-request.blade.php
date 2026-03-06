@component('mail::message')
<p>Hello,</p>

<p>This is to inform you that you have a new MR form approval request with ID number {{ $mrform->mrNum }}.</p>

<p>You can log in to your account by clicking the following link: <a href="{{ url('/login') }}">Login</a></p>

<p>Have a good day,<br>{{ config('app.name') }}</p>
@endcomponent