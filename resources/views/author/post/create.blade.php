@extends('layouts.backend.app')

@section('title', 'add new post')

@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('asset/backend/bower_components/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <!-- form start -->
            <form class="form-horizontal" action="{{ route('author.post.store') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                <!-- right column -->
                    <div class="col-md-8">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border bg-navy-active">
                            <h3 class="box-title">ADD NEW POST</h3>
                        </div>
                        <!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">Title</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title"
                                               placeholder="Post title">
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <label for="image" class="col-sm-2 control-label">Feature image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="status" value="1" > Publish
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                            </div>
                            <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                    <div class="col-md-4">
                        <!-- Horizontal Form -->
                        <div class="box box-info">
                            <div class="box-header with-border bg-navy-active">
                                <h3 class="box-title">Tag & Category</h3>
                            </div>
                            <!-- /.box-header -->

                            <div class="box-body">
                                    <!-- /.col -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="{{ $errors->has('tags') ? 'focused error' : '' }}">
                                                <label>Tag</label>
                                                <select class="form-control select2" multiple="multiple"
                                                        data-placeholder="Select tag"
                                                        style="width: 100%;" name="tags[]">
                                                    @foreach($tags as $tag)
                                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <div class="{{ $errors->has('categories') ? 'focused error' : '' }}">
                                            <select class="form-control select2" multiple="multiple"
                                                    data-placeholder="Select category"
                                                    style="width: 100%;" name="categories[]">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn bg-green-active">PUBLISH</button>
                                <a href="{{ route('author.post.index') }}" class="btn bg-red-active
                                pull-right">CANCEL</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!-- /.box -->
                    </div>
                <!--/.col (right) -->
                </div>
                <div class="row">
                    <!-- right column -->
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="box box-info">
                            <div class="box-header with-border bg-navy-active">
                                <h3 class="box-title">body</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                               <textarea id="editor1" name="body" rows="10" cols="80">
                                            This is my textarea to be replaced with CKEditor.
                                </textarea>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!--/.col (right) -->
                </div>

            </form>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('scripts')
    <!-- Select2 -->
    <script src="{{ asset('asset/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- CK Editor -->
    <script src="{{ asset('asset/backend/bower_components/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        });

        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1')
        });
    </script>
@endpush