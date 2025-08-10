@component('mail::message')

HI <b>{{ $user->name }}</b>

@php
  $getSetting = App\Models\Backend\SystemSetting::getSingle();
@endphp

<p> you're almost ready to start enjoying the benefits of {{ $getSetting->website_name }}. </p>

<p> Simply click the button below to verify your email address. </p>

<p>
 @component('mail::button', ['url'=> url('activate/' .base64_encode($user->id))])
 Verify
 @endcomponent
</p>


<p> This will verify your email address, and then you'll officually be a part of the {{ $getSetting->website_name }}. </p>

Thanks,<br>
{{ $getSetting->website_name }}

@endcomponent