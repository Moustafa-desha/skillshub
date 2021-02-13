<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello {{ $name }}</title>
</head>
<body>
    <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
        <hr>
          </div>
          <div class="card-body">
            <h3>Hello {{ $name }} </h3>
            <p> {{ $body }} </p>
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
  
      </section>
</body>
</html>