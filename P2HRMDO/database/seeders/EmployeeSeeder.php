<?php

namespace Database\Seeders;

use App\Models\{
    Employee,
    User
};
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear records
        Employee::truncate();

        // Insert records
        $employeesCSVFile = fopen(base_path('database/data/employees.csv'), "r");
        $firstline = true;
        while (($row = fgetcsv($employeesCSVFile)) !== false) {
            echo implode(",", $row) . "\n";
            $user = User::where('name', trim($row[5]) . ' ' . trim($row[2]) . ' ' . trim($row[3]))
                ->first();
            if (!$firstline) {
                $employee = [
                    'user_id' => $user ? $user->id : null,
                    'first_name' => $row[2],
                    'last_name' => $row[3],
                    'email' => $row[4],
                    'prefix' => $row[5],
                    'specialization' => $row[6],
                    'college' => $row[7],
                    'department' => $row[8],
                    'emp_type' => $row[9],
                    'emp_no' => $row[10],
                    'image' => $row[11],
                    'employment_status' => $row[12],
                    'hired_at' => $row[13],
                    'resigned_at' => $row[14],
                    "created_at" => Carbon::now()
                ];
    
                Employee::create($employee);
            }
            $firstline = false;
        }

        // college
        /*
            COE - 0001
            COS - 0002
            COA - 0003
            COL - 0004
            COC - 0005
            C0BA - 0006
            ...
        */

        /*
            emp_type

            professor
            chairperson
            dean
            maintenance
            security
            ...
        */

        // emp_no {year}{college}{count}
        // eg: 201800010001

        /* employment status
            permanent full-time
            permanent part-time
            contractual full-time
            contractual part-time
        */

        /*
        $employees = [
            [ //
                'user_id' => "9",
                'first_name' => "Eleanor",
                'last_name' => "Austria",
                'prefix' => "Dr.",
                'specialization' => "BSIT, MIT",
                'college' => "College of Science",
                'emp_type' => "Dean",
                'emp_no' => "2016000201",
                'employment_status' => "permanent full-time",
                "image" => "https://w7.pngwing.com/pngs/129/94/png-transparent-computer-icons-avatar-icon-design-male-teacher-face-heroes-logo.png"
            ],
            [//2
                'user_id' => null,
                'first_name' => "Leonard",
                'last_name' => "Alejandro",
                'prefix' => "Dr.",
                'specialization' => "BSIT, MIT",
                'college' => "College of Science",
                'emp_type' => "Professor",
                'emp_no' => "2016000202",
                'employment_status' => "permanent full-time",
                "image" => "https://w7.pngwing.com/pngs/312/283/png-transparent-man-s-face-avatar-computer-icons-user-profile-business-user-avatar-blue-face-heroes-thumbnail.png"
            ],
            [//3
                'user_id' => "6",
                'first_name' => "Marvi",
                'last_name' => "Bayrante",
                'prefix' => "Mrs.",
                'specialization' => "BSIT, MIT",
                'college' => "College of Science",
                'emp_type' => "Chairperson",
                'emp_no' => "2016000203",
                'employment_status' => "contractual full-time",
                "image" => "https://img.freepik.com/free-icon/user_318-219674.jpg?w=2000"
            ],
            [//4
                'user_id' => null,
                'first_name' => "Anette",
                'last_name' => " Daligcon",
                'prefix' => "Dr.",
                'specialization' => "BSIT, MIT",
                'college' => "College of Science",
                'emp_type' => "Professor",
                'emp_no' => "2016000205",
                'employment_status' => "contractual full-time",
                "image" => "https://w7.pngwing.com/pngs/193/660/png-transparent-computer-icons-woman-avatar-avatar-girl-thumbnail.png"
            ],
            [//5
                'user_id' => null,
                'first_name' => "Gloria",
                'last_name' => " Dela Cruz",
                'prefix' => "Dr.",
                'specialization' => "BSIT, MIT",
                'college' => "College of Science",
                'emp_type' => "Professor",
                'emp_no' => "2016000205",
                'employment_status' => "permanent full-time",
                "image" => "https://png.pngtree.com/element_our/20190529/ourlarge/pngtree-user-cartoon-girl-avatar-image_1200112.jpg"
            ],
            [//6
                'user_id' => null,
                'first_name' => "Gene Justine",
                'last_name' => " Rosales",
                'prefix' => "Dr.",
                'specialization' => "BSIT, MIT",
                'college' => "College of Science",
                'emp_type' => "Professor",
                'emp_no' => "2016000206",
                'employment_status' => "permanent full-time",
                "image" => "https://cdn.icon-icons.com/icons2/2643/PNG/512/male_man_boy_person_avatar_people_white_tone_icon_159357.png"
            ],
            [//7
                'user_id' => null,
                'first_name' => "Nina Ana Marie Jocelyn ",
                'last_name' => "Sales",
                'prefix' => "Ms.",
                'specialization' => "BSIT, MIT",
                'college' => "College of Science",
                'emp_type' => "Professor",
                'emp_no' => "2016000207",
                'employment_status' => "contractual full-time",
                "image" => "https://cdn1.vectorstock.com/i/1000x1000/73/15/female-avatar-profile-icon-round-woman-face-vector-18307315.jpg"
            ],
            [//8
                'user_id' => null,
                'first_name' => "Felnita",
                'last_name' => " Tan",
                'prefix' => "Dr.",
                'specialization' => "BSIT, MIT",
                'college' => "College of Science",
                'emp_type' => "Professor",
                'emp_no' => "2016000208",
                'employment_status' => "contractual part-time",
                "image" => "https://cdn5.vectorstock.com/i/1000x1000/73/04/female-avatar-profile-icon-round-woman-face-vector-18307304.jpg"
            ],
            [//9
                'user_id' => null,
                'first_name' => "Rizalina ",
                'last_name' => "Valencia",
                'prefix' => "Dr.",
                'specialization' => "BSIT, MIT",
                'college' => "College of Science",
                'emp_type' => "Professor",
                'emp_no' => "2016000209",
                'employment_status' => "permanent part-time",
                "image" => "https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png"
            ],
            [//10
                'user_id' => null,
                'first_name' => "Quintina",
                'last_name' => " Verceles",
                'prefix' => "Mrs.",
                'specialization' => "BSIT, MIT",
                'college' => "College of Science",
                'emp_type' => "Professor",
                'emp_no' => "2016000210",
                'employment_status' => "permanent full-time",
                "image" => "https://cdn.icon-icons.com/icons2/2643/PNG/512/female_woman_avatar_people_person_white_tone_icon_159370.png"
            ],
            [//11
                'user_id' => null,
                'first_name' => "Maria Jasmin ",
                'last_name' => "Villanueva",
                'prefix' => "Dr.",
                'specialization' => "BSIT, MIT",
                'college' => "College of Science",
                'emp_type' => "Professor",
                'emp_no' => "2016000202",
                'employment_status' => "permanent part-time",
                "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR6s5z4ojtNwl2jXifp1jiboZ2T0plskgirZXxHaE_UW2jdj9PI-8Ig05DPcMBUUAvWNCQ&usqp=CAU"
            ],

            ///
            [
                'user_id' => null,
                'first_name' => "Edwin",
                'last_name' => "Alfonso",
                'prefix' => "Mr.",
                'specialization' => "PolSci",
                'college' => "COC",
                'emp_type' => "Asst. Instructor",
                'emp_no' => "2015000521",
                'employment_status' => "permanent part-time",
                "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9zXQzdrNiO6JVFsOw0Ldp_AW9M4mjd7SpBANm9JNkxTOh4OJVIqosaxZh4TbfVFMTFzk&usqp=CAU"
            ],
            [
                'user_id' => null,
                'first_name' => "Harold",
                'last_name' => "Astorga",
                'prefix' => "Mr.",
                'specialization' => "Industrial Engineering",
                'college' => "COE",
                'emp_type' => "Instructor",
                'emp_no' => "2021000134",
                'employment_status' => "permanent full-time",
                "image" => "https://classrooms.com/wp-content/uploads/sites/3/2020/12/Most-Famous-Professors-in-History.jpg"
            ],
            [
                'user_id' => null,
                'first_name' => "Benny",
                'last_name' => "Salonga",
                'prefix' => "Mr.",
                'specialization' => "Data Security",
                'college' => "COS",
                'emp_type' => "Instructor",
                'emp_no' => "2021000257",
                'employment_status' => "permanent full-time",
                "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcEM5b_K8yq6b1hOisn9BpWVeVmbr_nlpO0Az4BX4A2dAPEKpDgnbMzjuV36qRhrb8adA&usqp=CAU"
            ],
            [
                'user_id' => null,
                'first_name' => "Greg",
                'last_name' => "Yumul",
                'prefix' => "Mr.",
                'specialization' => "Business Administration",
                'college' => "COBA",
                'emp_type' => "Dean",
                'emp_no' => "2017000632",
                'employment_status' => "contractual full-time",
                "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRo5FQZyJEQ_o29kJesJp_G6-wFw-4wvh1KAVFTEFqhBtOqM6G1LVBbSicbTx17KRX0YXU&usqp=CAU"
            ],
            [
                'user_id' => null,
                'first_name' => "Kurt",
                'last_name' => "Galang",
                'prefix' => "Mr.",
                'specialization' => "Contemporary Art",
                'college' => "COC",
                'emp_type' => "Instructor",
                'emp_no' => "2021000582",
                'employment_status' => "contractual full-time",
                "image" => "https://news.tulane.edu/sites/default/files/AndyHorowitz_600.jpg"
            ],
            [
                'user_id' => null,
                'first_name' => "Mark",
                'last_name' => "Aquino",
                'prefix' => "Mr.",
                'specialization' => "Chemistry",
                'college' => "COS",
                'emp_type' => "Dean",
                'emp_no' => "2021000212",
                'employment_status' => "contractual part-time",
                "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3N2lQjf5ypgROWcdm4cCcAFkVaS4R29rgNM7fn3iWQHyl8Nii7eisGsJxtNXevhgbxFE&usqp=CAU"
            ],
            [
                'user_id' => null,
                'first_name' => "Luke",
                'last_name' => "Skywalker",
                'prefix' => "Jedi Master",
                'specialization' => "Lightsabers",
                'college' => "COS",
                'emp_type' => "Chairperson",
                'emp_no' => "2011000216",
                'employment_status' => "permanent full-time",
                "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBcr8h9h4QPNKLOp7VoaKOHY0DszE7K55n2UrNCuV-Q6ehTDw4AW24DLTeOGk01ECS498&usqp=CAU"
            ],
            [
                'user_id' => null,
                'first_name' => "Forrest",
                'last_name' => "Gump",
                'prefix' => "Mr.",
                'specialization' => "Psychology",
                'college' => "COS",
                'emp_type' => "Dean",
                'emp_no' => "2015000290",
                'employment_status' => "permanent full-time",
                "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsOL4vXPx-sYMIyxf7smUYsMGE0f2YS1KgTDTLwg0h-2YzXHeBINuO9gToK3VchsVlOAY&usqp=CAU"
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }

        */
    }
}
