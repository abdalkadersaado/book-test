<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\LikeDislike;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('genres')->orderBy('id', 'desc')->paginate();

        return view('frontend.books.book', compact('books'));
    }

    // public function all_books()
    // {
    //     $books = Book::with('genres')->get();

    //     return view('frontend.books.book', compact('books'));
    // }
    // Save Like Or dislike
    function save_likedislike(Request $request)
    {

        $data = new LikeDislike;
        $data->book_id = $request->post;
        if ($request->type == 'like') {
            $data->like = 1;
        } else {
            $data->dislike = 1;
        }
        $data->save();
        $data = LikeDislike::find($request->id);
        return response()->json([
            'bool' => true,
            'count_like' => LikeDislike::where('like', 1)->where('book_id', $request->post)->count(),
            'count_dislike' => LikeDislike::where('dislike', 1)->where('book_id', $request->post)->count(),
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::select('id', 'title')->get();
        return view('frontend.books.create', compact('genres'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'description'   => 'required|min:25',
            'genres.*'        => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['title']              = $request->title;
        $data['description']        = Purify::clean($request->description);

        $book = auth()->user()->books()->create($data);

        if (count($request->genres) > 0) {
            $new_genres = [];
            foreach ($request->genres as $genre) {
                $genre = Genre::firstOrCreate([
                    'id' => $genre
                ], [
                    'title' => $genre
                ]);

                $new_genres[] = $genre->id;
            }
            $book->genres()->sync($new_genres);
        }

        return redirect()->route('users.books.index')->with([
            'message' => 'Book created successfully',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genres = Genre::select('id', 'title')->get();
        $book = Book::whereId($id)->first();

        return view('frontend.books.edit', compact('genres', 'book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update_book(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'description'   => 'required|min:25',
            'genres.*'        => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $book = Book::whereId($id)->first();

        if ($book) {
            $data['title']              = $request->title;
            $data['description']        = Purify::clean($request->description);

            $book->update($data);

            if (count($request->genres) > 0) {
                $new_genres = [];
                foreach ($request->genres as $genre) {
                    $genre = Genre::firstOrCreate([
                        'id' => $genre
                    ], [
                        'title' => $genre
                    ]);

                    $new_genres[] = $genre->id;
                }
                $book->genres()->sync($new_genres);
            }



            return redirect()->route('users.books.index')->with([
                'message' => 'Book updated successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('users.books.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::whereId($id)->first();

        if ($book) {

            $book->delete();

            return redirect()->route('users.books.index')->with([
                'message' => 'Book deleted successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('users.books.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }
}
