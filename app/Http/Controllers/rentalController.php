<?php

namespace App\Http\Controllers;
use App\Rental;
use Illuminate\Http\Request;
use App\BookKind;
use App\Book;
use App\StudentClass;
use App\Student;

class rentalController extends Controller
{
    //
    function createRental(){
        $kinds = BookKind::where('isActive', true)->get();
        $books = Book::where('isActive', true)->get();
        $classes = StudentClass::where('isActive', true)->get();
        $students = Student::where('isActive', true)->get();
 
        return view('rental')->with(compact('kinds', 'books', 'classes', 'students'));
    }

    function addRental(Request $request){

        $this->validate($request, [
            'book-id'     => 'required',
            'student-id'  => 'required',
        ]);

        $rental = new Rental();
        $book_id = trim($request->input('book-id'));
        $student_id = trim($request->input('student-id'));
        
        $booktotal = Book::find($book_id)->amount;
        $bookcount = Rental::where([
                ['book_id', '=', $book_id],
                ['isRecieve', '=', false],
            ])->get()->count();
        
        $studentcount = Rental::where(  [
                ['student_id', '=', $student_id],
                ['isRecieve', '=', false],
            ])->get()->count();

        if($booktotal > $bookcount && $studentcount<=3){
            $rental->book_id = $book_id;
            $rental->student_id = $student_id;
            $rental->save();
            $message = 'Rental success';
        }else{
            $message = 'Empty Book in library or this student borrow more than 3 books';
        }

        return redirect('/rental/history')->with(compact('message'));
    }

    function getRentalAll(){
        $rentals = Rental::paginate(15);
        $viewall = true;
        $message = 'Rental success';
        return view('history')->with(compact('rentals', 'viewall', 'message'));
    }

    function getRentalDisable(){
        $rentals = Rental::where('isRecieve', false)->paginate(15);
        $viewall = false;
        return view('history')->with(compact('rentals', 'viewall'));
    }

    function getRentalByStudentId(Request $request){
        $student_id = $request->input('student_id');
        $rentals = Rental::where('student_id', $student_id)->orderBy('isRecieve')->paginate(15);
        $viewall = false;
        return view('history')->with(compact('rentals', 'viewall'));
    }

    function getRentalByStudentName(Request $request){
        $student_name = $request->input('student_name');
        $rentals = Rental::join('students', 'students.id', '=', 'rentals.student_id')
                    ->where('students.name', 'LIKE', '%'.$student_name.'%')
                    ->paginate(15);
        $viewall = false;
        return view('history')->with(compact('rentals', 'viewall'));
    }

    function updateRental(Request $request){
        $rental_id = $request->input('rental_id');
        $rental = Rental::find($rental_id);
        $rental->isRecieve = true;
        $rental->save();

        return redirect('/rental/history');
    }

}
