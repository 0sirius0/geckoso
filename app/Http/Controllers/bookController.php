<?php

namespace App\Http\Controllers;
use App\Book;
use Illuminate\Http\Request;
use App\BookKind;

class bookController extends Controller
{
    //
    function addBook(Request $request){
        $this->validate($request, [
            'book_name'     => 'required',
            'kind_id'  => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $book = new Book();
        $book->name = $request->input('book_name');
        $book->kind_id = $request->input('kind_id');
        $book->amount = $request->input('amount');
        $book->code = 'S_';
        //dd($book);
        $book->save();

        $book->code .= $book->book_kind->kind_code.'_'.$book->id;
        $book->save();
        $message = 'Add book "'.$book->name.'" success';

        return redirect('/book/list')->with(compact('message'));
    }

    function getBookList(){
        $data = Book::paginate(10);
        $kind = BookKind::where('isActive', true)->get();
        return view('booklist')->with(compact('data', 'kind'));
    }

    function getABook(Request $request){
        $b_id = $request->input('book_id');
        $book = Book::Where('id', $b_id)->first();
        $kind = BookKind::where('isActive', true)->get();

        return view('bookinfo')->with(compact('book', 'kind'));
    }

    function updateBook(Request $request){
        $b_id = $request->input('book_id');
        $this->validate($request, [
            'book_name'     => 'required',
            'kind_id'  => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $book = Book::find($b_id);
        $book->name = $request->input('book_name');
        $book->amount = $request->input('amount');
        $book->kind_id = $request->input('kind_id');
        $book->isActive = $request->input('book_status');
        $book->save();
        $message = '"'.$book->name.'" update success !!!';
        return redirect('/book/list')->with(compact('message'));
    }

    function getBookListByKind(Request $request){
        $data = Book::where('kind_id', $request->input('id'))->paginate(10);
        $kind = BookKind::where('id', $request->input('id'))->get();
        //dd($request,$data);
        return view('booklist')->with(compact('data', 'kind'));
    }

    function deleteBook(Request $request){
        $book = Book::find($request)->first();
        $book->isActive = false;
        $message = $book->name.'" has just deleted success !!!';
        $book->save();
        return redirect('/book/list')->with(compact('message'));

    }

    function autocompleteBook(Request $request){
        $kind = $request->input('kind_id');
        $result = Book::where([['kind_id', '=', $kind], ['isActive', '=', true]])->select('id', 'name')->get();

        return $result;
    }
}
