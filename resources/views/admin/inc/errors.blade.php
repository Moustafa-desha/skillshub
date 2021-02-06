@if($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <p> {{ $error }} </P>
    @endforeach
</div>
@endif