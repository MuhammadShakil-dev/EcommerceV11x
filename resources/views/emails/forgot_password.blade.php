@component('mail::message')

HI <b>{{ $user->name }}</b>

<p> We understand it happens </p>

<p>
 @component('mail::button', ['url'=> url('reset/'.$user->remember_token)])
 Reset Your Password
 @endcomponent
</p>


<p> In case you have any issues recovering your password, Please contact us.  
</p>

@php
  $getSetting = App\Models\Backend\SystemSetting::getSingle();
@endphp

Thanks,<br>
<!-- {{config('app.name')}} -->
{{ $getSetting->website_name }}

@endcomponent