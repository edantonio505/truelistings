@extends('layouts.app')

@section('content')
<div class="row top-space">
  <div class="medium-6 medium-centered large-4 large-centered columns">

    <form role="form" method="POST" action="{{ url('/login') }}" style="background-color: white;">
    {!! csrf_field() !!}

      <div class="row column log-in-form">
        <h4 class="text-center">Log in with you email account</h4>
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



       
        <p><input type="submit" class="button expanded" value="Log in"</p>
      </div>
    </form>
  </div>
</div>
@endsection
