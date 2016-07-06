<div style="background-color:#bdbdbd; min-height: 100px; width: 100%; margin-top: 47px;">
	<div class="row">
		<div class="large-10 large-centered columns">
			<div class="row">
				<div class="large-6 columns">
					<img src="{{ Auth::user()->getAvatarProfileUrl() }}" style="height:80px; width: 80px; border-radius: 50px; margin: 10px; border: 6px solid #4646ff;">
					<span style="color: white; font-size: 20px;">Welcome {{ ucfirst(Auth::user()->name) }}</span>
				</div>
				<div class="large-6 columns buttonDashboard">
					<div class=row>
						<div class="large-3 columns">
							<a href="{{ route('dashboard') }}">
								<div class="whiteButtonSquare">
									<img src="/images/dashboardicons/gear.svg">
								</div>
								<span>Manage Listings</span>
							</a><br />

								<span>{{ Auth::user()->properties()->count() }} Active Listings</span>

						</div>
						<div class="large-3 columns">
							<a href="{{ route('newProperty') }}">
								<div class="whiteButtonSquare">
									<img src="/images/dashboardicons/plus.svg">
								</div>
								<span>Create a Listing</span>
							</a><br />
						</div>
						<div class="large-3 columns">
							<a href="#">
								<div class="whiteButtonSquare">
									<img src="/images/dashboardicons/statistic.svg">
								</div>
								<span>Statistics</span>
							</a><br />
						</div>
						<div class="large-3 columns">
							<a href="{{ route('getUserFeeds') }}">
								<div class="whiteButtonSquare">
									<i class="fi-refresh"></i>
								</div>
								<span>Refresh Feeds</span>
							</a><br />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>