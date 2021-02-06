<!--we us this to include in show page to show success messages nd faild messages with error -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p> {{ $error }} </P>
            @endforeach
        </div>
    @endif

    {{-- this message for cheick if user ask for change password or not we show for him success message when click in button --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
