<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function professor(string $id) {
        return Employee::whereId($id)
            ->first();
    }
}
