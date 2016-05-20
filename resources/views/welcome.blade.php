@extends('layouts.app')

@section('title', 'True Listings')
@section('styles')
<style>
  .landingBackground {
    background-image: url('/images/background{{ $num }}.jpg');
    min-height: 100%;
    min-width: 1024px;
    background-size:cover;
    background-repeat: no-repeat;
    
    /* Set up proportionate scaling */
    width: 100%;
    height: auto;
    
    /* Set up positioning */
    position: fixed;
    top: 30;
    left: 0;
  }
</style>
@endsection
@section('content')

<div class="landingBackground">
  <div class="container">
    <h3 class="landing-text header"><span class="logo home"><img id="logoHome" src="/images/dashboardicons/logotruelisting.svg">truelisting</span></h3>
    <p class="landing-text" id="homeTextSearch">Search for Apartments and Properties</p>
  </div>


  <div class="row welcome-search-box landing-box">
      <div class="small-12 medium-12 medium-centered columns">
          <div>
              <form action="{{ route('searchProperty') }}">
                <div class="row">
                  <div class="small-12 medium-12 large-12 large-centered columns">
                      <label class="priceRange {{ $errors->has('min') ? ' has-error' : '' }}">Price Range
                      <span class="dollarSign">$<span class="minSlider"></span> - <span class="dollarSign">$</span><span class="maxSlider"></span>
                      <div class="medium-12 columns">
                        <div class="slider" data-slider data-initial-start="25" data-initial-end="75">
                          <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="sliderOutput2"></span>
                          <span class="slider-fill" data-slider-fill></span>
                          <span class="slider-handle"  data-slider-handle role="slider" tabindex="1" aria-controls="sliderOutput1"></span>
                          <input type="hidden" id="minSlider">
                          <input type="hidden" id="maxSlider">
                          <input type="hidden" name="min" id="minSlider1">
                          <input type="hidden" name="max" id="maxSlider1">
                        </div>
                          @if ($errors->has('min'))
                            <span>
                                  <strong>{{ $errors->first('min') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="small-12 medium-6 large-6 columns">
                    <label class="{{ $errors->has('location') ? ' has-error' : '' }}">Location
                      <input type="text" name="location" id="location" value="{{ old('location') }}">
                        @if ($errors->has('location'))
                          <span>
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                        @endif
                    </label>
                  </div>
                  <div class="small-12 medium-6 large-6 columns">
                    <label>Bedrooms
                          <select name="beds">
                              <option value="0" {{ (old('beds') == "0" ? 'selected="selected"': '') }}>Studio</option>
                              <option value="1" {{ (old('beds') == "1" ? 'selected="selected"': '') }}>1</option>
                              <option value="2" {{ (old('beds') == "2" ? 'selected="selected"': '') }}>2</option>
                              <option value="3" {{ (old('beds') == "3" ? 'selected="selected"': '') }}>3</option>
                              <option value="4" {{ (old('beds') == "4" ? 'selected="selected"': '') }}>4</option>
                              <option value="5" {{ (old('beds') == "5" ? 'selected="selected"': '') }}>5</option>
                              <option value="6" {{ (old('beds') == "6" ? 'selected="selected"': '') }}>6</option>
                              <option value="7" {{ (old('beds') == "7" ? 'selected="selected"': '') }}>7</option>
                              <option value="8" {{ (old('beds') == "8" ? 'selected="selected"': '') }}>8</option>
                          </select>
                    </label>
                  </div>
                  
                  <div class="small-12 medium-4 large-4 columns">
                  <label class="{{ $errors->has('gq1') ? ' has-error' : '' }}">Cant Live without</label>
                   <select name="gq1">
                      <option value="">Select one</option>
                      @include('partials.selling_points.sellingPoint1')
                   </select>
                    @if ($errors->has('gq1'))
                      <span>
                          <strong style="color:#D31616;">{{ $errors->first('gq1') }}</strong>
                      </span>
                    @endif
                  </div>
                  <div class="small-12 medium-4 large-4 columns">
                   <label class="{{ $errors->has('gq2') ? ' has-error' : '' }}">really, really want</label>
                   <select name="gq2">
                      <option value="">Select one</option>
                      @include('partials.selling_points.sellingPoint3')
                   </select>
                    @if ($errors->has('gq2'))
                      <span>
                          <strong color style="color:#D31616;">{{ $errors->first('gq2') }}</strong>
                      </span>
                    @endif
                  </div>
                  <div class="small-12 medium-4 large-4 columns">
                   <label class="{{ $errors->has('gq3') ? ' has-error' : '' }}">Wish it would have a</label>
                   <select name="gq3">
                      <option value="">Select one</option>
                      @include('partials.selling_points.sellingPoint2')
                   </select>
                    @if ($errors->has('gq3'))
                      <span>
                          <strong style="color:#D31616;">{{ $errors->first('gq3') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="small-12 medium-4 medium-centered large-4 large-offset-4 columns">
                      <input type="submit" value="Search" class="expanded button" />
                  </div>

                </div>
              </form>
          </div>
      </div>
  </div>
</div>

@endsection


@section('scripts')
    @include('partials.neighborhood_autocomplete')
@stop