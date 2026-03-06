@component('mail::message')
<p>Hello,</p>

<p>Your form with MR number {{ $mrform->mrNum }} has been approved and is now in HR for processing.</p>

<p>You can log in to your account by clicking the following link: <a href="{{ url('/login') }}">Login</a></p>

<p>Have a good day,<br>{{ config('app.name') }}</p>
@endcomponent