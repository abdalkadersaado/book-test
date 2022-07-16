@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">
@endsection
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create post</h6>
            <div class="ml-auto">
                <a href="{{ route('users.books.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Posts</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('users.books.store') }}" method="post" enctype="multipart/form-data">
                @csrf

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="title">title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control summernote" >{!! old('description')  !!}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>




            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="genres">Genres</label>
                        <button type="button" class="btn btn-primary btn-xs" id="select_btn_genre">Select all</button>
                        <button type="button" class="btn btn-primary btn-xs" id="deselect_btn_genre">Deselect all</button>
                       <select name="genres[]" multiple class="form-control selects" id="select_all_genres">
                        @foreach ($genres as $genre )

                        <option value="{{ $genre->id }}" {{ in_array($genre->id, old('genres[]',[])) ? 'selected': '' }}  >{{ $genre->title }}</option>
                        @endforeach
                    </select>
                        @error('genres')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>



            <div class="form-group pt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.summernote').summernote({
                tabSize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('.selects').select2({
                genres: true,
                minimumResultsForSearch: Infinity
            });
            $('#select_btn_genre').click(function (){
                $('#select_all_genres > option').prop("selected", "selected");
                $('#select_all_genres').trigger('change');
            });

            $('#deselect_btn_genre').click(function (){
                $('#select_all_genres > option').prop("selected", "");
                $('#select_all_genres').trigger('change');
            });

            $('#post-images').fileinput({
                theme: "fas",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
        });
    </script>
@endsection
