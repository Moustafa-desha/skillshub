@extends('web.layout')

 @section('title')
     Contact Us
 @endsection

@section('main')
		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/home-background.jpg')}})"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="{{ url('/') }}">{{ __('web.home') }}</a></li>
							<li>{{ __('web.contact') }}</li>
						</ul>
						<h1 class="white-text">{{ __('web.getInTouch') }}</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- contact form -->
					<div class="col-md-6">
						<div class="contact-form">
							<h4>{{ __('web.sendMsg') }}</h4>
				<!--we here iclude success and erorrs message from messages pae to chieck this form-->
							@include("web.inc.messages")
							<form method="POST" action="{{ url('contact/message/send') }}">
								@csrf
								<input class="input" type="text" name="name" placeholder="{{ __('web.name') }}">
								<input class="input" type="email" name="email" placeholder="{{ __('web.email') }}">
								<input class="input" type="text" name="subject" placeholder="{{ __('web.subject') }}">
								<textarea class="input" name="body" placeholder="{{ __('web.enteryourMessage') }}"></textarea>
								<button type="submit" class="main-button icon-button pull-right">{{ __('web.sendMessage') }}</button>
							</form>
						</div>
					</div>
					<!-- /contact form -->

					<!-- contact information -->
					<div class="col-md-5 col-md-offset-1">
						<h4>{{ __('web.contactInformation') }}</h4>
						<ul class="contact-details">
							<li><i class="fa fa-envelope"></i>{{$sett->email }}</li>
							<li><i class="fa fa-phone"></i>{{ $sett->phone }}</li>
						</ul>

					</div>
					<!-- contact information -->

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->
@endsection