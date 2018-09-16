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
                            <h3 class="box-title">ADD NEW TAG</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="{{ route('admin.tag.store') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputEmail3"
                                               placeholder="Enter tag name">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn bg-green-active">SAVE</button>
                                <button type="reset" class="btn bg-yellow-active">REFRESH</button>
                                <a href="{{ route('admin.tag.index') }}" class="btn bg-red-active">BACK</a>
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