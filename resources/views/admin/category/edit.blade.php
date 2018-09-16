@extends('layouts.backend.app')

@section('title', 'add new tag')

@push('css')
@endpush

@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border bg-navy-active">
                            <h3 class="box-title">EDIT CATEGORY</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="{{ route('admin.category.update',$category->id ) }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputEmail3"
                                               value="{{ $category->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <label for="image" class="col-sm-2 control-label">Category image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                            <div class="box-body">
                                <label for="image" class="col-sm-2 control-label">Current image</label>
                                <div class="col-sm-10">
                                    <img src="{{ Storage::url('category/'.$category->image) }}" alt="image"
                                    class="img-fluid" width="120px" height="80px">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn bg-green-active">UPDATE</button>
                                <a href="{{ route('admin.category.index') }}" class="btn bg-red-active">BACK</a>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('scripts')
@endpush