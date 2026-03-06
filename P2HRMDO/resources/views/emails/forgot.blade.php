@component('mail::message')
<style>
    .reset-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #395583;
        color: #ffffff; /* Change text color to black */
        border-color: #395583;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 600;
    }

    .reset-btn:hover {
        background-color: #315EA0;
    }

    .center-button {
        text-align: center;
    }

    .love {
        margin-top: 10px;
        font-size: 15px;
        color: #030318;  
    }

    .content-email {
        padding: 20px;
        background-color: #fffdfd;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 1);
        text-align: center;
        color: #030318;  
    }
</style>

<p class="love"> Hello, {{ $user->name }}, </p>

<p class="love"> We understand it happens.</p>

<div class="center-button">
    <a class="reset-btn" href="{{ url('reset/' . $user->remember_token) }}">Reset Your Password</a>
</div>

<p class="love"> In case you have any issues recovering your password, please contact HRMDO.</p>

<p class="love">Thanks, <br>{{ config('app.name') }}</p>
@endcomponent
