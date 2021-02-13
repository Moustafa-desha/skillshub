@extends('admin.layout')


@section('main')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create New Exam</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url("dashboard")}}">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- main content -->
  <div class="content">
      <div class="container-fluid">
          <div class="col-12 pb-3">

            @include('admin.inc.errors')

              <form method="POST" action="{{ url("dashboard/exams/store") }}" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name (en) </label>
                                <input type="text" class="form-control" name="name_en">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name (ar)</label>
                                <input type="text" class="form-control" name="name_ar">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form group">
                                <label>Description (en)</label>
                                <textarea class="form-control" rows="5" name="desc_en"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form group">
                                <label>Description (ar)</label>
                                <textarea class="form-control" rows="5" name="desc_ar"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Skill</label>
                                    <select class="custom-select form-control" id="edit-form-cat-id" name="skill_id">
                                    @foreach ($skills as $skill)
                                        <option value="{{ $skill->id }}">{{ $skill->name('en') }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group">
                                    <label>Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="img">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="container-fluid">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Questions_num.</label>
                                        <input type="number" class="form-control" name="questions_num">
                                    </div>
                                </div>
                        
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Difficulty</label>
                                        <input type="number" class="form-control" name="difficulty">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Duration (mins.)</label>
                                        <input type="number" class="form-control" name="duration_mins">
                                    </div>
                                </div>
                            </div>
                            </div>
                           
                    </div>
                
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


