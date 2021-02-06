@extends('admin.layout')

@section('main')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
                  <h3 class="card-title">All categories</h3>
  
                  <div class="card-tools">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-modal">
                        Add New
                      </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name (en)</th>
                        <th>Name (ar)</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($cats as  $cat)
                        <tr>
                            {{-- دى خاصيه فى لارافيل علشان تجيب رقم الايدى اللى انت واقف عليه --}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cat->name ('en') }}</td>
                            <td>{{ $cat->name ('ar') }}</td>
                            {{-- <td>
                                @if ($cat->active)
                                    <button type="button" class="btn btn-success">Active</button>
                                @else   
                                        <button type="button" class="btn btn-danger">Disable</button>
                                @endif
                            </td> --}}
                            <td>
                                @if ($cat->active)
                                    <a href="{{ url("dashboard/categories/toggle/$cat->id") }}" class="btn btn-success">Active</a>
                                @else   
                                        <a href="{{ url("dashboard/categories/toggle/$cat->id") }}" class="btn btn-danger">Disable</a>
                                @endif
                            </td>
                            <td>
                                {{-- هنا بنتعت كل البيانات اللى محتاجينها ع البوتن علشان يرجع بيها ع الفورم --}}
                                <button type="button" class="btn btn-sm btn-info edit-btn" data-id="{{ $cat->id }}" data-name-en="{{ $cat->name ('en') }}" data-name-ar="{{ $cat->name ('ar') }}" data-toggle="modal" data-target="#edit-modal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="{{ url("dashboard/categories/delete/$cat->id") }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                                {{-- <a href="{{ url("dashboard/categories/toggle/$cat->id") }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-toggle-on"></i></i>
                                </a> --}}
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                    <div class="d-flex my-3 justify-content-center">
                    {{ $cats->links() }}
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

  <div class="modal fade" id="add-modal" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>


        <div class="modal-body">

          @include('admin.inc.errors')

          <form method="Post" action="{{ url('dashboard/categories/store') }}" id="add-form">
            @csrf
              <div class="form-group">
                  <label>Name (en)</label>
                  <input type="text" name="name_en" class="form-control">
              </div>
              <div class="form-group">
                  <label>Name (ar)</label>
                  <input type="text" name="name_ar" class="form-control">
              </div>
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" form="add-form" class="btn btn-primary">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

        {{-- موديل التحديث  --}}

  <div class="modal fade" id="edit-modal" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>


        <div class="modal-body">

          @include('admin.inc.errors')
          
          <form method="Post" action="{{ url('dashboard/categories/update') }}" id="edit-form">
            @csrf
            {{-- hidden id to can access data --}}
            <input type="hidden" name="id" id="edit-form-id">
              <div class="form-group">
                  <label>Name (en)</label>
                  <input type="text" name="name_en" class="form-control" id="edit-form-name-en">
              </div>
              <div class="form-group">
                  <label>Name (ar)</label>
                  <input type="text" name="name_ar" class="form-control" id="edit-form-name-ar">
              </div>
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" form="edit-form" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

@endsection

@section('scripts')
    <script>
        $('.edit-btn').click(function() {
            let id = $(this).attr('data-id')
            let nameEn = $(this).attr('data-name-en')
            let nameAr = $(this).attr('data-name-ar')

            console.log(id,nameEn,nameAr);

            $('#edit-form-id').val(id)
            $('#edit-form-name-en').val(nameEn)
            $('#edit-form-name-ar').val(nameAr)


        })
        </script>
@endsection