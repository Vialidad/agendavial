<ul class="nav navbar-nav navbar-right">
	@if (Auth::guest())
		<li><a href="{{ url('/auth/login') }}">Inicio sesion</a></li>
		<!--<li><a href="{{ url('/auth/register') }}">Register</a></li>-->
	@else
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="{{ url('/auth/logout') }}">Cierra sesion</a></li>
			</ul>
		</li>
	@endif
</ul>