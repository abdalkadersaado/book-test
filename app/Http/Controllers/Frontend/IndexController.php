<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Genre;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Validator;


class IndexController extends Controller
{

    public function index()
    {
        $books = Book::with(['user'])
            ->when(request('genre_id') != '', function ($query) {
                $query->WhereHas('genres', function ($q) {
                    $q->where('genre_id', request('genre_id'));
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();
        // return dd($books);
        $genres = Genre::orderBy('id', 'desc')->select('id', 'title')->get();
        return view('frontend.index', compact('books', 'genres'));
    }

    public function search()
    {

        $books = Book::with(['user'])
            ->when(request('keyword') != '', function ($query) {
                $query->search(request('keyword'), null, true);
            })
            ->when(request('genre_id') != '', function ($query) {
                $query->WhereHas('genres', function ($q) {
                    $q->where('id', request('genre_id'));
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();
        $genres = Genre::orderBy('id', 'desc')->select('id', 'title')->get();
        return view('frontend.index', compact('books', 'genres'));
    }
}
