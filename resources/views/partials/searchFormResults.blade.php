<div class="queryResults">
	<form class="formQuery" action="{{ route('searchProperty') }}">
		<div class="row">
			<div class="large-12 large-centered columns">
				<div class="row">
					<div class="small-12 large-2 columns">
						<label>minimum price
							$<input class="inputQuery_text" type="text" name="min" value="{{ $query->input('min') }}"/>
						</label>
					</div>
					<div class="small-12 large-2 columns">
						<label>maximum price
							$<input class="inputQuery_text" type="text" name="max" value="{{ $query->input('max') }}"/>
						</label>
					</div>
					<div class="small-12 large-4 columns">
						<label>Location
							<input class="inputQuery_text" type="text" name="location" id="location" value="{{ $query->input('location') }}">
						</label>
					</div>
					<div class="small-12 large-4 columns">
						<label>Bedrooms
                         	<select class="inputQuery" name="beds">
                              <option value="0" {{ ($query->input('beds') == "0" ? 'selected="selected"': '') }}
                              >Studio</option>
                              <option value="1" {{ ($query->input('beds') == "1" ? 'selected="selected"': '') }}
                              >1</option>
                              <option value="2" {{ ($query->input('beds') == "2" ? 'selected="selected"': '') }}
                              >2</option>
                              <option value="3" {{ ($query->input('beds') == "3" ? 'selected="selected"': '') }}
                              >3</option>
                              <option value="4" {{ ($query->input('beds') == "4" ? 'selected="selected"': '') }}
                              >4</option>
                              <option value="5" {{ ($query->input('beds') == "5" ? 'selected="selected"': '') }}
                              >5</option>
                              <option value="6" {{ ($query->input('beds') == "6" ? 'selected="selected"': '') }}
                              >6</option>
                              <option value="7" {{ ($query->input('beds') == "7" ? 'selected="selected"': '') }}
                              >7</option>
                              <option value="8" {{ ($query->input('beds') == "8" ? 'selected="selected"': '') }}
                              >8</option>
                          	</select>
	                    </label>
					</div>
				</div>
			</div>
			<div class="small-12 large-12 large-centered columns">
				<div class="row">
					<div class="small-12 large-4 columns">
						<label>Cant live without
							<select  class="inputQuery" name="gq1">
		                      <option value="">Select one</option>
		                      @include('partials.selling_points.sellingPoint1r')
		                   	</select>
						</label>
					</div>
					<div class="small-12 large-4 columns">
						<label>Really really want
							<select  class="inputQuery" name="gq2">
		                      <option value="">Select one</option>
		                      @include('partials.selling_points.sellingPoint2r')
		                   	</select>
						</label>
					</div>
					<div class="small-12 large-4 columns">
						<label>I wish it would have
							<select class="inputQuery" name="gq3">
		                      <option value="">Select one</option>
		                      @include('partials.selling_points.sellingPoint3r')
		                   	</select>
						</label>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>