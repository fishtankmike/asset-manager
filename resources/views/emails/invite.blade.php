<p>Hello {{ $user->name }},</p>

<p>You have been invited to the Chicopee Asset System, please <a href="{{ url('login') }}">login</a> with the following details:</p>

<p><strong>Username</strong> = {{ $user->email }}</p>
<p><strong>Password</strong> = {{ $password }}</p>

<p>Regards,<br/>
Chicopee</p>