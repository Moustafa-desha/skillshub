@extends('web.layout')

@section('title')
    Verify Email
@endsection

@section('main')
            <!-- to show diffrent message if email vifried or not yet -->
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success" role="alert">
                A new email verification link has been emailed to you!
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                Your Email Not Verifyed Yet . Please Cheick Your Inbox
            </div>
        @endif

        		<!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- login form -->
					<div class="col-md-6 col-md-offset-3">
						<div class="contact-form">
							<form method="POST" action="{{ url('email/verification-notification') }}">
                                @csrf
								<button type="submit" class="main-button icon-button pull-right">Resend Email</button>
							</form>
						</div>
					</div>
					<!-- /login form -->

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->
@endsection