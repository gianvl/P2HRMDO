@component('mail::message')
<p>Hello,</p>

<p>This is to inform you that your forecast form with ID number {{ $forecastSection1->forecast_num_id  }} has been approved.</p>

<p>You can log in to your account by clicking the following link: <a href="{{ url('/login') }}">Login</a></p>

<p>Have a good day,<br>{{ config('app.name') }}</p>
@endcomponent