@extends('admin.layout')


@section('main')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Admin</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- main content -->
    <div class="content">
      <div class="container-fluid">
          <div class="row">
          <div class="col-12 pb-3">

            @include('admin.inc.errors')

              <form method="POST" action="{{ url("/dashboard/admins/store") }}">
                @csrf

                <div class="card-body">

                   <div class="content">
                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label>Name </label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form group">
                                <label>Password</label>
                                <input type="text" class="form-control"  name="password">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form group">
                                <label>Confirm Password</label>
                                <input type="text" class="form-control"  name="password_confirmation">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form group">
                                <label>Role</label>
                                <select class="custom-select form-control" name="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"> {{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                   </div>
                     <hr>
                    <div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
                <!-- /.card-body -->
                </form>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  @endsection


