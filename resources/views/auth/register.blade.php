@extends('layouts.app')

@section('content')
<div class="row top-space">
  <div class="medium-6 medium-centered large-4 large-centered columns">
    <form role="form" method="POST" action="{{ url('/register') }}"  style="background-color: white;">
    {!! csrf_field() !!}

      <div class="row column log-in-form">
        <h4 class="text-center">Register a new account</h4>
        <label>Are you a Broker?
            <input type="checkbox" id="showInputLicense"/>
            <div id="brokerLicense" style="display: none;">
                <span>Add your License</span>
                <input type="text" name="brokerLicense"/>
            </div>
        </label>
        <label class="{{ $errors->has('name') ? ' has-error' : '' }}">Name
          <input type="text" name="name" value="{{ old('name') }}">

            @if ($errors->has('name'))
                <span>
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </label>
        <label class="{{ $errors->has('email') ? ' has-error' : '' }}">Email
          <input type="email" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
                <span>
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </label>
        <label class="{{ $errors->has('password') ? ' has-error' : '' }}">Password
          <input type="password" name="password">

            @if ($errors->has('password'))
                <span>
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </label>



        <label class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">Confirm Password
         <input type="password"  name="password_confirmation">

            @if ($errors->has('password_confirmation'))
                <span>
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </label>
        <p><input type="submit" class="button expanded" value="register"</p>
      </div>
    </form>
  </div>
</div>
@endsection
