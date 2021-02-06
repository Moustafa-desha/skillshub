				<nav id="nav">
					<!-- this form  hidden to make logout hen click in butto logout and use javascript to handle it in layout  -->
					<form id="logout-form" action="{{ url('logout') }}" method="post" style="display:none;">
					  @csrf
				    </form>


					<ul class="main-menu nav navbar-nav navbar-right">
						<li><a href="index.html">{{__('web.home') }}</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{__('web.cats') }}<span class="caret"></span></a>
                            <ul class="dropdown-menu">
								@foreach ($cats as $cat)
							  <li><a href="{{ url("category/show/{$cat->id}") }}"> {{ $cat->name() }} </a></li>
							  @endforeach
                            </ul>
                        </li>
						<li><a href="{{ url('contact') }}">{{__('web.contact') }}</a></li>

						@guest
							<li><a href="{{ url('login') }}">{{__('web.signin') }}</a></li>
							<li><a href="{{ url('register') }}">{{__('web.signup') }}</a></li>
						@endguest

						@auth
						  @if (Auth::user()->role->name=='student' )
							<li><a  href="{{ url('profile') }}"> {{__('web.profile') }} </a></li>
							@else
							<li><a  href="{{ url('dashboard') }}"> {{__('web.dashboard') }} </a></li>
						  @endif
							<li><a id="logout-link" href="#"> {{__('web.signout') }} </a></li>
						@endauth
						
						<!-- to change between langs and show only one from session -->
						@if (App::getLocale() =='en')
							<li><a href="{{ url('lang/set/ar') }}">ع</a></li>
						@else
							<li><a href="{{ url('lang/set/en') }}">EN</a></li>
						@endif
						
						
					</ul>
				</nav>