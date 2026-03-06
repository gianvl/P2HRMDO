<?php

namespace Database\Seeders;

use App\Models\PositionFormMapping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionFormMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'position' => "Dean",
                'college' => "College of Science",
                'department' => "Dean, College of Science",
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <select class="dropwdown-dean" id="department" name="department" style="width: 100%; height: 25px; margin-left: -30px;" required>
                        <option value=""></option>
                        <option value="Information Technology and Information System Department"{{ old(\'department\') === \'Information Technology and Information System Department\' ? \' selected\' : \'\' }}>Information Technology and Information System Department</option>
                        <option value="Computer Science Department"{{ old(\'department\') === \'Computer Science Department\' ? \' selected\' : \'\' }}>Computer Science Department</option>
                        <option value="Chemistry Department"{{ old(\'department\') === \'Chemistry Department\' ? \' selected\' : \'\' }}>Chemistry Department</option>
                        <option value="Biology Department"{{ old(\'department\') === \'Biology Department\' ? \' selected\' : \'\' }}>Biology Department</option>
                        <option value="Mathematics Department"{{ old(\'department\') === \'Mathematics Department\' ? \' selected\' : \'\' }}>Mathematics Department</option>
                        <option value="Physics Department"{{ old(\'department\') === \'Physics Department\' ? \' selected\' : \'\' }}>Physics Department</option>
                    </select>
                '
            ],

            [
                'position' => "Chairperson",
                'college' => "College of Science",
                'department' => 'Information Technology and Information System Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Information Technology and Information System Department">
                '
            ],

            [
                'position' => "Chairperson",
                'college' => "College of Science",
                'department' => 'Computer Science Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Computer Science Department">
                '
            ],

            [
                'position' => "Chairperson",
                'college' => "College of Science",
                'department' => 'Chemistry Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Chemistry Department">
                '
            ],

            [
                'position' => "Chairperson",
                'college' => "College of Science",
                'department' => 'Biology Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Biology Department">
                '
            ],

            [
                'position' => "Chairperson",
                'college' => "College of Science",
                'department' => 'Mathematics Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Mathematics Department">
                '
            ],

            [
                'position' => "Chairperson",
                'college' => "College of Science",
                'department' => 'Physics Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Physics Department">
                '
            ],

            [
                'position' => "Dean",
                'college' => "College of Engineering",
                'department' => "Dean, College of Engineering",
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Engineering">
                ',
                'forms_department_column' => '
                <select class="dropwdown-select" id="department" name="department" style="width: 100%; height: 25px; margin-left: -30px;" required>
                    <option value="">Select Department</option>
                    <option value="Civil Engineering Department"{{ old(\'department\') === \'Civil Engineering Department\' ? \' selected\' : \'\' }}>Civil Engineering Department</option>
                    <option value="Chemical Engineering Department"{{ old(\'department\') === \'Chemical Engineering Department\' ? \' selected\' : \'\' }}>Chemical Engineering Department</option>
                    <option value="Computer Engineering Department"{{ old(\'department\') === \'Computer Engineering Department\' ? \' selected\' : \'\' }}>Computer Engineering Department</option>
                    <option value="Electrical and Electronics Engineering Department"{{ old(\'department\') === \'Electrical and Electronics Engineering Department\' ? \' selected\' : \'\' }}>Electrical and Electronics Engineering Department</option>
                    <option value="Petroleum Engineering Department"{{ old(\'department\') === \'Petroleum Engineering Department\' ? \' selected\' : \'\' }}>Petroleum Engineering Department</option>
                    <option value="Industrial Engineering Department"{{ old(\'department\') === \'Industrial Engineering Department\' ? \' selected\' : \'\' }}>Industrial Engineering Department</option>
                    <option value="Mechanical Engineering Department"{{ old(\'department\') === \'Mechanical Engineering Department\' ? \' selected\' : \'\' }}>Mechanical Engineering Department</option>
                </select>
                '
            ],

            [
                'position' => "Chairperson",
                'college' => "College of Engineering",
                'department' => 'Civil Engineering Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Engineering">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Civil Engineering Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Engineering",
                'department' => 'Chemical Engineering Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Engineering">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Chemical Engineering Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Engineering",
                'department' => 'Computer Engineering Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Engineering">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Computer Engineering Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Engineering",
                'department' => 'Electrical and Electronics Engineering Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Engineering">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Electrical and Electronics Engineering Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Engineering",
                'department' => 'Petroleum Engineering Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Engineering">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Petroleum Engineering Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Engineering",
                'department' => 'Industrial Engineering Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Engineering">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Industrial Engineering Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Engineering",
                'department' => 'Mechanical Engineering Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Engineering">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Mechanical Engineering Department">
                '
            ],

            [
                'position' => "Dean",
                'college' => "College of Law",
                'department' => "Law Department",
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Law">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Law Department">
                '
            ],

            [
                'position' => "Dean",
                'college' => "College of Pharmacy",
                'department' => "Pharmacy Department",
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Pharmacy">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Pharmacy Department">
                '
            ],

            [
                'position' => "Dean",
                'college' => "College of Nursing",
                'department' => "Nursing Department",
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Nursing">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Nursing Department">
                '
            ],

            [
                'position' => "Dean",
                'college' => "College of Education and Liberal Arts",
                'department' => "Dean, College of Education and Liberal Arts",
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Education and Liberal Arts">
                ',
                'forms_department_column' => '
                <select class="dropwdown-select" id="department" name="department" style="width: 100%; height: 25px; margin-left: -30px;" required>
                    <option value="">Select Department</option>
                    <option value="Communication Department"{{ old(\'department\') === \'Communication Department\' ? \' selected\' : \'\' }}>Communication Department</option>
                    <option value="Education Department"{{ old(\'department\') === \'Education Department\' ? \' selected\' : \'\' }}>Education Department</option>
                    <option value="Languages Department"{{ old(\'department\') === \'Languages Department\' ? \' selected\' : \'\' }}>Languages Department</option>
                    <option value="Physical Education Department"{{ old(\'department\') === \'Physical Education Department\' ? \' selected\' : \'\' }}>Physical Education Department</option>
                    <option value="Social Science Department"{{ old(\'department\') === \'Social Science Department\' ? \' selected\' : \'\' }}>Social Science Department</option>
                </select>
                '
            ],

            [
                'position' => "Chairperson",
                'college' => "College of Education and Liberal Arts",
                'department' => 'Communication Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Communication Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Education and Liberal Arts",
                'department' => 'Education Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Education Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Education and Liberal Arts",
                'department' => 'Languages Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Languages Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Education and Liberal Arts",
                'department' => 'Physical Education Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Physical Education Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Education and Liberal Arts",
                'department' => 'Social Science Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Social Science Department">
                '
            ],

            [
                'position' => "Dean",
                'college' => "College of Business Administration",
                'department' => "Dean, College of Business Administration",
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Business Administration">
                ',
                'forms_department_column' => '
                <select class="dropwdown-select" id="department" name="department" style="width: 100%; height: 25px; margin-left: -30px;" required>
                    <option value="">Select Department</option>
                    <option value="Accountancy Department"{{ old(\'department\') === \'Civil Engineering Department\' ? \' selected\' : \'\' }}>Civil Engineering Department</option>
                    <option value="Customs Administration Department"{{ old(\'department\') === \'Chemical Engineering Department\' ? \' selected\' : \'\' }}>Chemical Engineering Department</option>
                    <option value="Finance and Economics Department"{{ old(\'department\') === \'Chemical Engineering Department\' ? \' selected\' : \'\' }}>Chemical Engineering Department</option>
                    <option value="Management and Marketing Department"{{ old(\'department\') === \'Chemical Engineering Department\' ? \' selected\' : \'\' }}>Chemical Engineering Department</option>
                </select>
                '
            ],

            [
                'position' => "Chairperson",
                'college' => "College of Business Administration",
                'department' => 'Accountancy Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Accountancy Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Business Administration",
                'department' => 'Customs Administration Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Customs Administration Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Business Administration",
                'department' => 'Finance and Economics Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Finance and Economics Department">
                '
            ],
            [
                'position' => "Chairperson",
                'college' => "College of Business Administration",
                'department' => 'Management and Marketing Department',
                'forms_college_column' => '
                    <input type="hidden" name="college" value="College of Science">
                ',
                'forms_department_column' => '
                    <input type="hidden" name="department" value="Management and Marketing Department">
                '
            ],
            

        ];

        foreach ($positions as $position) {
            PositionFormMapping::create($position);
        }
    }
}
