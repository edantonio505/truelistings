<div data-order="{{ $property["match"] }}" class="small-12 medium-6 large-4 column result-box mix {{ implode(" ",$property["amenitiesClasses"]) }}">
	<div class="callout1 results boxes rounded" style="min-height: 350px;">
		<p class="title">{{ $property["_source"]["neighborhood"] }}</p>
		<div style="width:100%; height:40px; background-color: rgba(7,160,220,0.7); top:44px; position: relative;">
			<h4 class="calculated matchStyle" style="display:none;">Matches <span class="number calculated-match2">{{ $property["calculated_value"] }}</span>%</h4>
			<h4 class="match matchStyle">Matches <span class="calculated-match3">{{ $property["match"] }}</span>%</h4>
		</div>
		<div style="
			@if($property["_source"]["thumbnail"] != "")
				background: url('{{ $property["_source"]["thumbnail"] }}');
			@else
				background: url('images/400x370&amp;text=Pegasi B');
			@endif
		 background-repeat: no-repeat;
		 background-size: 100% auto;
		 height: 300px; width: 100%;"></div>

		<p style="font-size:17px;">{{ $property["_source"]["address"] }}</p>
		<div class="row">
			<div class="small-6 medium-6 large-6 columns">
				<ul class="grey-text">
					<span style="display: none;" class="calculated-match">{{ $property["calculated_value"] }}</span>
					<li>${{ $property["_source"]["price"] }}</li>
					<li>{{ $property["_source"]["beds"] }} bedroom<?php if($property["_source"]["beds"] > 1) { echo 's'; } ?></li>
				</ul>
			</div>
			<div class="small-6 medium-6 large-6 columns">
				<ul class="matchesgq">
					<li>@include('partials.resultsgq1')</li>
					<li>@include('partials.resultsgq2')</li>
					<li>@include('partials.resultsgq3')</li>
				</ul>
			</div>
		</div>
	</div>
</div>