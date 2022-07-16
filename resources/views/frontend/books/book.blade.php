@extends('layouts.app')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
        <div class="ml-auto">
            <a href="{{ route('users.books.create') }}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add new post</span>
            </a>
        </div>
    </div>

    {{-- @include('backend.posts.filter.filter') --}}

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    {{-- <th>Category</th> --}}
                    <th>User</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td><a href="">{{ $book->title }}</a></td>
                    {{-- @foreach ($post->genres as $item)
                    <td>
                        <a href="">{{ $item->title }}</a>
                    </td>
                    @endforeach --}}
                    <td>{{ $book->user->name }}</td>
                    <td>{{ $book->created_at->format('d-m-Y h:i a') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('users.books.edit',$book->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this book?') ) { document.getElementById('post-delete-{{ $book->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            <form action="{{ route('users.books.destroy',$book->id) }}" method="post" id="post-delete-{{ $book->id }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No posts found</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7">
                        <div class="float-right">
                            {{-- {!! $books->links() !!} --}}
                        </div>
                    </th>
                </tr>
            </tfoot>
        </table>
        {!! $books->appends(request()->input())->links() !!}
    </div>
</div>


@endsection
