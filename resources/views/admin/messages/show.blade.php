@extends('admin.layout')


@section('main')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Show Message</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


        @include('admin.inc.messages')


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
           <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Message</h3>
  
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    {{-- <thead>
                      
                    </thead> --}}
                    <tbody>

                        <tr>
                            <th>Name</th>
                            <td>{{ $message->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $message->email }}</td>
                        </tr>

                        <tr>
                            <th>Subject</th>
                            <td>{{ $message->subject ?? "...." }}</td>
                        </tr>

                        <tr>
                            <th>Body</th>
                            <td>{{ $message->body }}</td>
                        </tr>

                    </tbody>
                  </table>

                </div>
                <!-- /.card-body -->
              </div>

              
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Send Respons</h3>
                </div>
                 <!-- /.card-header -->
                <div class="card-body ">

                     @include('admin.inc.errors')

                    <form method="POST" action="{{ url("dashboard/messages/response/$message->id") }}">
                        @csrf

                        <div class="card-bod">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                        
                                <div class="form-group">
                                    <label>Body</label>
                                    <textarea  class="form-control" rows="5" name="body"></textarea>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                                </div>
                        </div>
                    </form>
                </div>
                </div>
                <!-- /.card-body -->
           </div>
         </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('scripts')
    <script>

        </script>
@endsection