<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{
    DB
};
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function departmentList($college)
    {
        $college = str_replace("%20", " ", $college);
        $departmentList = DB::table('employees')
            ->select(DB::raw('DISTINCT(`department`)'))
            ->where('college', $college)
            ->where('department', "!=", "")
            ->whereNotNULL('department')
            ->get();

        return $departmentList;
    }

    public function employeeList($college, $department)
    {
        $college = str_replace("%20", " ", $college);
        $department = str_replace("%20", " ", $department);

        $employeeList = DB::table('employees')
            ->select("*")
            ->where('college', $college)
            ->where('department', $department)
            ->whereNull('deleted_at')
            ->get();

        return $employeeList;
    }
}
