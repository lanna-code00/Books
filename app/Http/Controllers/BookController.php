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

    public function create(Request $request){
        $response = Http::get('https://anapioficeandfire.com/api/books');
        $data = json_decode($response->body());
        if(!$request)
        {
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
        } else {
            Book::create($request->all());
            return $request;
        }
        // return $flattenarray;
    }

    public function edit($id){
        $updatebook = Book::findOrFail($id);
        return $updatebook;
    }

    public function update(Request $request, $id)
    {
        $updatebook = Book::where('id', $id)->first();
            $updatebook->name = $request->name;
            $updatebook->isbn = $request->isbn;
            $updatebook->authors = $request->author;
            $updatebook->country = $request->country;
            $updatebook->number_of_pages = $request->pages;
            $updatebook->publisher = $request->publisher;
            $updatebook->release_date = $request->release_date;
            $updatebook->save();
            return $updatebook;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::where('id',$id)->delete();
        return (["message" => "Book deleted successfully!"]);
    }

}
