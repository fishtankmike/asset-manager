@extends('layouts.app')

@section('content')


 <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->

  <div class="page animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">

    <div class="page-content">

        <div class="page-brand-info">
            <div class="brand">
                <img class="brand-img" src="/img/svg/fishtank.svg" alt="..." width="200px">
            </div>
            <p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu bibendum quam. Ut facilisis auctor pharetra. Cras ut dictum mi. Sed mollis massa eros, quis elementum dui gravida sit amet.</p>
        </div>

        <div class="page-login-main">

            <div class="brand visible-xs">
                <img class="brand-img" src="chicopee_red.svg" alt="...">
            </div>

            @if (Auth::guest())

                <h3 class="font-size-24">Asset Management</h3>
                <p>Please sign in using your login details below.</p>

                <form role="form" method="POST" action="{{ url('/login') }}">
                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="sr-only" for="inputEmail">Email</label>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email') }}" placeholder="Email">
                     </div>
                     <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                         @if ($errors->has('password'))
                             <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <label class="sr-only" for="inputPassword">Password</label>
                        <input type="password" class="form-control" class="form-control" id="inputPassword" name="password" placeholder="Password">
                    </div>
                    <div class="form-group clearfix">
                        <div class="checkbox-custom checkbox-inline checkbox-primary pull-left">
                            <input type="checkbox" id="remember" name="checkbox">
                            <label for="inputCheckbox">Remember me</label>
                        </div>
                        <a class="pull-right" href="{{ url('/password/reset') }}">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </form>

            @else

                @if (Auth::user()->isAdmin())
                    <h3 class="font-size-24">Asset Management</h3>
                    <p><em>You are already logged in as {{ Auth::user()->name }}</em></p>
                    <br/>
                    <p>If you are not <em>{{ Auth::user()->name }}</em>, <a href="{{ url('/logout') }}">click here to Logout</a>.</p>
                    <p>Otherwise <a href="{{ url('/admin/assets/') }}">click here to return to the dashboard</a>.</p>
                @else
                    <h3 class="font-size-24">Asset Management</h3>
                    <p><em>You are already logged in as {{ Auth::user()->name }}</em></p>
                    <br/>
                    <p>If you are not <em>{{ Auth::user()->name }}</em>, <a href="{{ url('/logout') }}">click here to Logout</a>.</p>
                    <p>Otherwise <a href="{{ url('/assets/') }}">click here to return to the dashboard</a>.</p>
                @endif

            @endif

            <footer class="page-copyright">
                <p>&copy; 2016 All Rights Reserved YOUR COMPANY NAME</p>
            </footer>

        </div>

    </div>

</div>
<!-- End Page -->





@endsection
