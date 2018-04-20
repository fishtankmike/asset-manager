@extends('layouts.app')

<!-- Main Content -->
@section('content')



<!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content">
      <div class="page-brand-info">
        <div class="brand">
          <img class="brand-img" src="/logo.svg" alt="...">
        </div>
        <p class="font-size-20">With over 100 years experience developing and delivering wiping solutions across multiple segments, Chicopee can provide fresh ideas to your wiping problems.</p>
      </div>
      <div class="page-login-main">
        <div class="brand visible-xs">
          <img class="brand-img" src="/logo.svg" alt="...">
        </div>
        <h3 class="font-size-24">Forgot My Password</h3>
        <p>Enter your email address to receive a password reset link.</p>
          
          
          
          
               @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                 
          
          
          
          
          
        <form role="form" method="POST" action="{{ url('/password/email') }}">
            
            {!! csrf_field() !!}
            
            
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="sr-only" for="inputEmail">Email</label>
              
                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
              
              
              
            <input type="email" class="form-control"  name="email" value="{{ old('email') }}" placeholder="Email">
          </div>
       
          <button type="submit" class="btn btn-primary btn-block" style="margin-top:0px;">Send Password Reset Link</button>
        </form>
        <p style="margin-top:38px;">Come to the wrong place? <a href="javascript:history.back()">Go back</a></p>
        <footer class="page-copyright">
     
          <p>© 2016 All Rights Reserved Chicopee®</p>
         
        </footer>
      </div>
    </div>
  </div>
  <!-- End Page -->




<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
