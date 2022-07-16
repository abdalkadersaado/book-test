@extends('layouts.app')

@section('content')
    @include('frontend.filter.filter')
    <div class="col-lg-9 col-12">
        <div class="blog-page">
            @forelse($books as $book)
                <article class="blog__post d-flex flex-wrap">
                    <div class="thumb">
                        <a href="">
                            @if($book->cover != null)
                                {{-- <img src="{{ asset('assets/book/' . $post->media->first()->file_name) }}" alt="{{ $post->title() }}"> --}}
                                <img src="{{ asset('assets/books/img2.jpg') }}" alt="books images">
                            @else
                                <img src="{{ asset('assets/books/default.jpg') }}" alt="books images">
                            @endif
                        </a>
                    </div>
                    <div class="content">
                        <h4><a href="">{{ $book->title }}</a></h4>
                        <ul class="post__meta">
                            {{-- <li>author : <a href="{{ route('frontend.author.posts', $post->user->username) }}" title="Posts by {{ $post->user->name }}">{{ $post->user->name }}</a></li> --}}
                            <li>author : {{ $book->user->name }}</li>
                            <li class="post_separator">/</li>
                            <li>{{ $book->created_at->format('M d Y') }}</li>
                        </ul>
                        <p>{!! \Illuminate\Support\Str::limit($book->description, 145, '...') !!}</p>
                        <div class="blog__btn">
                             @if ($book->genres->count() > 0)
                            <div class="">
                                <span>Genre: </span>
                                @foreach($book->genres as $genre)
                                    <span style=" display: inline-block; font-size: 12px; line-height: 20px; margin: 5px 5px 0 0; text-transform: capitalize;"><a href="#">{{ $genre->title }} -</a></span>

                                    @endforeach
                            </div>
                        @endif
                        <br>
                        </div>

                                <span title="Likes" id="saveLikeDislike" data-type="like" data-post="{{ $book->id}}" class="mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold">
                                    Like
                                    <span class="like-count">{{ $book->likes() }}</span>
                                    {{-- <span class="liked">{{ $book->likes() }}</span> --}}

                                </span>
                                <span title="Dislikes" id="saveLikeDislike" data-type="dislike" data-type="dislike" data-post="{{ $book->id}}" class="mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold">
                                    Dislike
                                    <span class="dislike-count">{{ $book->dislikes() }}</span>
                                    {{-- <span class="disliked">{{ $book->dislikes() }}</span> --}}
                                </span>


                    </div>

                </article>

            @empty
                <div class="text-center">No Books found</div>
            @endforelse

        </div>
        {!! $books->appends(request()->input())->links() !!}
    </div>

    <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
        @include('partial.frontend.sidebar')
    </div>

    @endsection

