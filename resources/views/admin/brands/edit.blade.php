@extends('admin.layouts.master')

@section('title')
    Cập Nhật Thương Hiệu
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Brand</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" method="post" id="brandForm">
                <input type="hidden" name="id" value="{{ $brand->id }}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ $brand->name }}" onkeyup="ChangeToSlug()" id="slug"
                                        class="form-control" placeholder="Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Slug</label>
                                    <input type="text" name="slug" value="{{ $brand->slug }}" id="convert_slug" readonly class="form-control"
                                        placeholder="Slug">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <div>
                                        <input type="radio" name="status" value="1" id="" {{ $brand->status == 1 ? 'checked' : ''}}>
                                        <span class="mr-3">Active</span>
                                        <input type="radio" name="status" value="0" id="" {{ $brand->status == 0 ? 'checked' : ''}}>
                                        <span>Block</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection

@section('scripts')
    <script>
        $('#brandForm').on('submit', function(e) {
            e.preventDefault();

            var element = $(this);
            $.ajax({
                url: "{{ route('admin.brands.update') }}",
                type: 'PUT',
                data: element.serializeArray(),
                success: function(response) {

                    if (response.status) {
                        window.location.href = "{{ route('admin.brands.index') }}"
                    }
                    if (response.errors && response.errors['name']) {
                        $('#slug').addClass('is-invalid').siblings('p').addClass(
                            'invalid-feedback').html(response.errors.name)
                    } else {
                        $('#slug').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                    }

                    if (response.errors && response.errors['slug']) {
                        $('#convert_slug').addClass('is-invalid').siblings('p').addClass(
                            'invalid-feedback').html(response.errors.slug)
                    } else {
                        $('#convert_slug').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                    }
                }
            })
        })
    </script>
@endsection


