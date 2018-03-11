	<!-- SIDE BAR -->
	<div class="sidebar-menu">
		
			
		<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="index.html">
					<img src="assets/images/logo@2x.png" width="120" alt="" />
				</a>
			</div>
			
						<!-- logo collapse icon -->
						
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
									
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
		</header>
				
		
		
				
		
		<div class="sidebar-user-info">
			
			<div class="sui-normal">
				<a href="#" class="user-link">
					<img src="{{ asset('neonAssets/images/thumb-1.png') }}" alt="" class="img-circle" />
					
					<span>Welcome,</span>
					<strong>{{ \Auth::user()->name }}</strong>
				</a>
			</div>
			
			<div class="sui-hover inline-links animate-in"><!-- You can remove "inline-links" class to make links appear vertically, class "animate-in" will make A elements animateable when click on user profile -->				
				<a href="#">
					<i class="entypo-pencil"></i>
					New Page
				</a>
				
				<a href="mailbox.html">
					<i class="entypo-mail"></i>
					Inbox
				</a>
				
				<a href="extra-lockscreen.html">
					<i class="entypo-lock"></i>
					Log Off
				</a>
				
				<span class="close-sui-popup">&times;</span><!-- this is mandatory -->			</div>
		</div>		
		<ul id="main-menu" class="">
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
			<!-- Search Bar -->
			<li id="search">
				<form method="get" action="">
					<input type="text" name="q" class="search-input" placeholder="Search something..."/>
					<button type="submit">
						<i class="entypo-search"></i>
					</button>
				</form>
			</li>
			<li>
				<a href="{{ url('/') }}">
					<i class="entypo-layout"></i>
					<span>HOME</span>
				</a>
			</li>
			<li>
				<a href="{{ url('/activity') }}">
					<i class="entypo-rocket"></i>
					<span>ACTIVITY</span>
				</a>
			</li>
			<li>
				<a href="charts.html">
					<i class="entypo-users"></i>
					<span>VOLUNTEERS</span>
				</a>
			</li>
			<li>
				<a href="charts.html">
					<i class="entypo-vcard"></i>
					<span>PROFILE</span>
				</a>
			</li>
			<li>
				<a href="charts.html">
					<i class="entypo-cog"></i>
					<span>SETTINGS</span>
				</a>
			</li>
		</ul>
				
	</div>
	<!-- SIDE BAR -->	