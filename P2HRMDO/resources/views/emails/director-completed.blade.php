@component('mail::message')
<p>Hello,</p>

<p>We are pleased to inform you that your form with MR number {{ $mrform->mrNum }} is now completed.</p>

<p>You can log in to your account by clicking the following link: <a href="{{ url('/login') }}">Login</a></p>

<p>Have a good day,<br>{{ config('app.name') }}</p>
@endcomponent