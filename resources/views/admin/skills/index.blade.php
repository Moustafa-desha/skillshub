@extends('admin.layout')

@section('main')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Skills</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Skills</li>
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
                  <h3 class="card-title">All Skills</h3>
  
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
                        <th>Image</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($skills as  $skill)
                        <tr>
                            {{-- دى خاصيه فى لارافيل علشان تجيب رقم الايدى اللى انت واقف عليه --}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $skill->name ('en') }}</td>
                            <td>{{ $skill->name ('ar') }}</td>
                            <td>
                                <img src="{{ asset("uploads/$skill->img") }}" height="80px">
                            </td>
                            <td>{{ $skill->cat->name ('en') }}</td>
                            <td>
                                @if ($skill->active)
                                    <a href="{{ url("dashboard/skills/toggle/$skill->id") }}" class="btn btn-success">Active</a>
                                @else   
                                        <a href="{{ url("dashboard/skills/toggle/$skill->id") }}" class="btn btn-danger">Disable</a>
                                @endif
                            </td>
                            <td>
                                {{-- هنا بنتعت كل البيانات اللى محتاجينها ع البوتن علشان يرجع بيها ع الفورم --}}
                                <button type="button" class="btn btn-sm btn-info edit-btn" data-id="{{ $skill->id }}" data-name-en="{{ $skill->name ('en') }}" data-name-ar="{{ $skill->name ('ar') }}" data-img="{{ $skill->img }}" data-cat-id="{{ $skill->cat_id }}" data-toggle="modal" data-target="#edit-modal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="{{ url("dashboard/skills/delete/$skill->id") }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                    <div class="d-flex my-3 justify-content-center">
                    {{ $skills->links() }}
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

          <form method="Post" action="{{ url('dashboard/skills/store') }}" id="add-form" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                  <label>Name (en)</label>
                  <input type="text" name="name_en" class="form-control">
              </div>
              <div class="form-group">
                  <label>Name (ar)</label>
                  <input type="text" name="name_ar" class="form-control">
              </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Image</label>
                      <div class="input-group">
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img" >
                            <label class="custom-file-label">Image</label>
                            </div>
                            <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                            </div>
                      </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="custom-select form-control" name="cat_id">
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}">{{$cat->name ('en')}}</option>
                            @endforeach
                        </select>
                    </div> 
                </div> 
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

        {{-- موديل تحديث البيانات  --}}

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

            <form method="Post" action="{{ url('dashboard/skills/update') }}" id="edit-form" enctype="multipart/form-data>
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

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Image</label>
                      <div class="input-group">
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img" >
                            <label class="custom-file-label">Image</label>
                            </div>
                      </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="custom-select form-control" name="cat_id" id="edit-form-cat-id">
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}">{{$cat->name('en')}}</option>
                            @endforeach
                        </select>
                    </div> 
                </div> 
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
            let img = $(this).attr('data-img')
            let catId = $(this).attr('data-cat-id')

            console.log(id,nameEn,nameAr);

            $('#edit-form-id').val(id)
            $('#edit-form-name-en').val(nameEn)
            $('#edit-form-name-ar').val(nameAr)
            // $('#edit-form-img').val(img)
            $('#edit-form-cat-id').val(catId)


        })
        </script>
@endsection