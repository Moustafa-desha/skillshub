@extends('admin.layout')


@section('main')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admins</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{ url('dashboard/admins') }}">Admins</a></li>
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
                  <h3 class="card-title">All Admins</h3>
  
                  <div class="card-tools">
                    <a href="{{ url("dashboard/admins/create") }}" class="btn btn-primary">
                        Add New
                    </a>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Verified</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)

                        <tr>
                            {{-- دى خاصيه فى لارافيل علشان تجيب رقم الايدى اللى انت واقف عليه --}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->role->name }}</td>
                            <td>
                                @if ($admin->email_verified_at !== null)
                                    <span class="btn btn-success">YES</span>
                                @else   
                                        <span class="btn btn-danger">NO</span>
                                @endif
                            </td>
                            <td>
                                @if ($admin->role->name == 'admin')
                                <a href="{{ url("/dashboard/admins/promote/$admin->id") }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-level-up-alt"></i></i>
                                </a> 
                                @else
                                <a href="{{ url("/dashboard/admins/demote/$admin->id") }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-level-down-alt"></i></i>
                                </a> 
                                @endif

                                <a href="{{ url("/dashboard/admins/delete/$admin->id") }}" class="btn btn-sm btn-danger">
                                    <i class="far fa-trash-alt"></i></i>
                                </a> 
                            </td>
                          </tr>

                        @endforeach

                    </tbody>
                  </table>
                    <div class="d-flex my-3 justify-content-center">
                    {{ $admins->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
              </div>
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