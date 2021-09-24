<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Arr;

class BookController extends Controller
{
    public function getBookApi() 
    {
        $response = Book::all();
        return $response;
    }

    public function create(){
        $response = Http::get('https://anapioficeandfire.com/api/books');
        $data = json_decode($response->body());
        foreach ($data as $value) {
            foreach ($value->authors as $newvalue) {
           $book = new Book();
           $book->name = $value->name;
           $book->isbn = $value->isbn;
               $book->authors = $newvalue;
               $book->country = $value->country;
               $book->number_of_pages = $value->numberOfPages;
               $book->publisher = $value->publisher;
               $book->release_date = $value->released;
               $book->save();
            }
        }
        return 'saved';
        // return $flattenarray;
    }

}
