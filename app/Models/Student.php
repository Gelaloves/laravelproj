<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'your_students_table_name'; // Replace with your actual table name

    protected $fillable = ['name', 'email', 'other_column']; // Define the columns you want to be mass assignable

    // Add any other model-specific methods or relationships here
    
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Retrieve all students
    public function index()
    {
        $allStudents = Student::all();
        return view('students.index', ['students' => $allStudents]);
    }

    // Create a new student record
    public function create()
    {
        Student::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'other_column' => 'some_value',
        ]);
        
        return redirect()->route('students.index');
    }

    // Update a student record
    public function update($id)
    {
        $studentToUpdate = Student::find($id);
        if (!$studentToUpdate) {
            return redirect()->route('students.index')->with('error', 'Student not found');
        }

        $studentToUpdate->update([
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);

        return redirect()->route('students.index');
    }

    // Delete a student record
    public function destroy($id)
    {
        $studentToDelete = Student::find($id);
        if (!$studentToDelete) {
            return redirect()->route('students.index')->with('error', 'Student not found');
        }

        $studentToDelete->delete();

        return redirect()->route('students.index');
    }
}

}