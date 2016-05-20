<div class="title-bar" data-responsive-toggle="realEstateMenu" data-hide-for="small" data-responsivetoggle="is9kiz-responsivetoggle" style="display: none;">
	<button class="menu-icon" type="button" data-toggle=""></button>
	<div class="title-bar-title">Menu</div>
</div>
<div class="top-bar" id="realEstateMenu">
	<div class="top-bar-left">
		<ul class="menu accordion-menu" data-responsive-menu="accordion" role="tablist" aria-multiselectable="true" data-accordionmenu="80zcu3-accordionmenu" data-responsivemenu="u2hz69-responsivemenu">
			<li class="menu-text" role="menuitem"><a class="logo" href="/"><img src="/images/dashboardicons/logotruelisting.svg">truelisting</a></li>
		</ul>
	</div>
	<div class="top-bar-right">
		<ul class="ui menu">
			@if(Auth::check())
				<li class="ui dropdown item" tabindex="0">
				    <i class="dropdown icon"></i>
				    Hi {{ ucfirst(Auth::user()->name) }}
				    <img class="menuAvatar" src="{{ Auth::user()->getAvatarListUrl() }}">
				    <div class="menu transition hidden" tabindex="-1">
				     	@if(Auth::user()->email == 'edantonio505@gmail.com')
							<a class="item" href="{{ route('superadmindashboard') }}"><i class="fi-widget"></i> Super Admin Dashboard</a>
						@endif
						@if(Auth::user()->checkIsAdmin())
							<a class="item" href="{{ route('dashboard') }}">Dashboard</a>
							<a class="item" href="{{ route('brokerdashboard') }}"><i class="fi-widget"></i> Broker Dashboard</a>
						@endif
						@if(Auth::user()->checkIsBroker() && !Auth::user()->checkIsAdmin())
							<a class="item" href="{{ route('dashboard') }}"><i class="fi-widget"></i> Dashboard</a>
						@endif
						<a class="item" href="/logout"><i class="fi-info"></i> Logout</a>
				    </div>
				</li>
				
			@else
				<li class="loggedout"><a href="/login">Login</a></li>
				<li class="loggedout"><a class="button" style="color:white" href="/register">Register</a></li>
			@endif
		</ul>
		
	</div>
</div>