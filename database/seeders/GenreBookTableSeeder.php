<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class GenreBookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::all();
        foreach ($books as $book) {
            $genres = Genre::inRandomOrder()->take(2)->pluck('id')->toArray();
            $book->genres()->sync($genres);
        }
    }
}
