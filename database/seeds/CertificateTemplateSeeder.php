<?php

use Illuminate\Database\Seeder;

class CertificateTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certificate_templates')->insert([
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'certificate' => 'ATTENDANCE',
                'template' => '<table class="table table-bordered"> <tbody> <tr> <td>01.</td> <td style="text-align: right; ">Name of Student :&nbsp;</td> <td width="50%" style="text-align: left;"><b>{{student_name}}</b><br></td> </tr> <tr> <td>02.</td> <td style="text-align: right; ">Reg. No.&nbsp;:&nbsp;</td> <td width="50%" style="text-align: left;"><span style="font-weight: 700;">{{reg_no}}</span><br></td> </tr> <tr> <td>03.</td> <td style="text-align: right; ">University Reg. No.&nbsp;:&nbsp;</td> <td width="50%" style="text-align: left;"><span style="font-weight: 700;">{{university_reg}}</span><br></td> </tr> <tr> <td>04.</td> <td style="text-align: right; ">Faculty/Level&nbsp;:&nbsp;</td> <td width="50%" style="text-align: left;"><span style="font-weight: 700;">{{faculty}}</span><br></td> </tr><tr><td>05.</td><td style="text-align: right; ">Batch :&nbsp;<br></td><td width="50%" style="text-align: left;"><span style="font-weight: 700;">{{batch}}</span><br></td></tr> <tr> <td>06.</td> <td style="text-align: right; ">Year of Study&nbsp;:&nbsp;</td> <td width="50%" style="text-align: left;"><span style="font-weight: 700;">{{year_of_study}}</span><br></td> </tr> <tr> <td>07.</td> <td style="text-align: right; ">Percentage of Attendance Secured&nbsp;:&nbsp;</td> <td width="50%" style="text-align: left;"><b>{{percentage_of_attendance}}%</b><br></td> </tr> </tbody></table>',
                'custom_css' => '.subpage{padding: 100px;}',
                'student_photo' => 0,
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'certificate' => 'TRANSFER',
                'template' => '<table class="table table-bordered"> <tbody> <tr> <td style="text-align: right;"><span style="text-align: right;">TC No. :&nbsp;</span><br></td> <td style="text-align: left;"><span style="font-weight: 700;">{{tc_num}}</span><br></td> <td rowspan="5">{{student_image}}</td> </tr> <tr> <td style="text-align: right; "><span style="text-align: right;">Faculty/Level :&nbsp;</span><br></td> <td style="text-align: left;"><span style="font-weight: 700;">{{faculty}}</span><br></td> </tr> <tr> <td style="text-align: right; "><span style="text-align: right;">Admission No./Reg.No. :</span><br></td> <td style="text-align: left;"><span style="font-weight: 700;">{{reg_no}}</span><br></td> </tr> <tr> <td style="text-align: right;"><span style="text-align: right;">University Reg. No. :</span><br></td> <td style="text-align: left;"><b>{{university_reg}}</b><br></td> </tr><tr><td style="text-align: right;">Batch. :<br></td><td style="text-align: left;"><span style="font-weight: 700;">{{batch}}</span><br></td></tr> </tbody></table><table class="table table-bordered"> <tbody> <tr> <td>01.</td> <td style="text-align: right; ">Name of Student :&nbsp;</td> <td width="50%" style="text-align: left;"><b>{{student_name}}</b><br></td> </tr> <tr> <td>02.</td> <td style="text-align: right; ">Name of Father.&nbsp;:&nbsp;</td> <td width="50%" style="text-align: left;"><b>{{parents_name}}</b><br></td> </tr> <tr> <td>03.</td> <td style="text-align: right; ">Date of Birth :&nbsp;</td> <td width="50%" style="text-align: left;"><span style="font-weight: 700;">{{date_of_birth}}</span><br></td> </tr> <tr> <td>04.</td> <td style="text-align: right; ">Gender :&nbsp;</td> <td width="50%" style="text-align: left;"><span style="font-weight: 700;">{{gender}}</span><br></td> </tr> <tr> <td>05.</td> <td style="text-align: right; ">Nationality :&nbsp;</td> <td width="50%" style="text-align: left;"><span style="font-weight: 700;">{{nationality}}</span><br></td> </tr> <tr> <td>06.</td> <td style="text-align: right; ">Religion :&nbsp;</td> <td width="50%" style="text-align: left;"><b>{{religion}}</b><br></td> </tr> <tr> <td>07.</td> <td style="text-align: right; ">Community &amp; Caste :&nbsp;</td> <td width="50%" style="text-align: left;"><span style="font-weight: 700;">{{caste}}</span><br></td> </tr> <tr> <td>08.</td> <td style="text-align: right; ">Date of Admission :&nbsp;</td> <td width="50%" style="text-align: left;"><span style="font-weight: 700;">{{reg_date}}</span><br></td> </tr> <tr> <td>09.</td> <td style="text-align: right; ">Date of Leaving :&nbsp;</td> <td width="50%" style="text-align: left;"><b>{{date_of_leaving}}</b><br></td> </tr> <tr> <td>10.</td> <td style="text-align: right;">Class studied at the time of leaving :&nbsp;</td> <td width="50%" style="text-align: left;"><b>{{leaving_time_class}}</b><br></td> </tr> <tr> <td>11.</td> <td style="text-align: right; ">Whether qualified for promotion to higher class :&nbsp;</td> <td width="50%" style="text-align: left;"><b>{{qualified_to_promote}}</b><br></td> </tr> <tr> <td>12.</td> <td style="text-align: right; ">Whether the student has paid all Balance fees to the college :&nbsp;</td> <td width="50%" style="text-align: left;"><b>{{paid_fee_status}}</b><br></td> </tr> <tr> <td>13.</td> <td style="text-align: right; ">Conduct and Character :&nbsp;</td> <td width="50%" style="text-align: left;"><span style="font-weight: 700;">{{character}}</span><br></td> </tr> </tbody></table>',
                'custom_css' => '.subpage{padding: 100px;}',
                'student_photo' => 0,
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'certificate' => 'CHARACTER',
                'template' => '<p>This is to certify that&nbsp;<span style="color: rgb(57, 57, 57);"><b>{{student_name}}</b></span>&nbsp;Son of&nbsp;<span style="color: rgb(57, 57, 57);"><b>{{father_name}}</b> </span>&amp;&nbsp;<span style="color: rgb(57, 57, 57);"><b>{{mother_name}}</b></span>, Permanent Address<b>&nbsp;<span style="color: rgb(57, 57, 57);">{{address}}</span></b>, is known to me for about&nbsp;<span style="color: rgb(57, 57, 57);"><b>{{year}}</b></span>&nbsp;years. He is a citizen of&nbsp;<span style="color: rgb(57, 57, 57);"><b>{{country}}</b>&nbsp;</span>by birth.</p><p><br></p><p>To the best of my knowledge, he bears a <b>{{character}}</b> character and is not involved in such activities which are against the state freedom and peace. I wish all success and prosperity in his life.</p>',
                'custom_css' => '.subpage{padding: 100px;}',
                'student_photo' => 0,
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'certificate' => 'BONAFIDE',
                'template' => 'This is to certify that <b>{{student_name}} </b>Reg No. <b>{{reg_no}}</b>   Son of <b>{{parents_name}}</b> is a bonafide student of this College in the <b>{{course}}</b> course during the period <b>{{period}}</b>. His/Her Date of Birth as per our School/College record is <b>{{date_of_birth}}</b>.His/Her Conduct and Character are <b>{{character}}</b>.',
                'custom_css' => '.subpage{padding: 100px;}',
                'student_photo' => 0,
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'certificate' => 'COURSE COMPLETION',
                'template' => '<p>This is to certify that <b>{{student_name}}</b> Reg No. <b>{{reg_no}}</b>&nbsp; Son of <b>{{parents_name}} </b>has studied <b>{{course}}</b> in our college during the <b>{{period}}</b>. His/Her Date of Birth as per our School/College record is <b>{{date_of_birth}}</b>.His/Her Conduct and Character are <b>{{character}}</b> during the tenure of his studies.<br></p>',
                'custom_css' => '.subpage{padding: 100px;}',
                'student_photo' => 0,
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'certificate' => 'GENERAL TEMPLATE',
                'template' => '<p style="text-align: center; ">REG.NO.:<b>{{reg_no}}</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;REG.DATE: <b>{{reg_date}}</b></p><p style="text-align: center; "><b><br></b></p><p style="text-align: center; ">This is to certify that <b>{{student_name}}</b> son/daughter of <b>{{parents_name}}</b> Residing at <b>{{address}}</b> is bonafide Student of our school.</p><p style="text-align: center; "><br></p><p style="text-align: center; ">He/She is /was very obedient, sincere and hardworking.</p><p style="text-align: center; "><br></p><p style="text-align: center; ">He/She bears a good moral character. His/Her Date of Birth is <b>{{date_of_birth}}</b> and Place of Birth is <b>{{address}}</b>.<br></p>',
                'custom_css' => '.subpage{padding: 100px;}',
                'student_photo' => 1,
                'status' => 1
            ],
            [
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'created_by' => 1,
            'certificate' => 'IDENTITY CARD',
            'template' => '<h5 style="text-align: center;"><b>{{student_name}}</b></h5><h6 style="text-align: center; "><b>{{faculty}}-</b><b>{{semester}}</b></h6><p></p><p><b>PARENT : {{parents_name}}</b></p><p></p><p><b>ADDRESS : {{address}}</b></p><p><b>CONTACT : {{guardian_mobile_1}}</b></p><p><b>VALID DATE : JAN 2019-  FEB 2020</b></p><p></p>',
            'custom_css' => '.subpage{padding:83px 5px 5px;color:#000!important}.page-content{padding:8px 20px 24px}h5{font-size:14px;margin:2px auto}h6{font-size:12px;margin:2px auto}.student_image{border-radius:0;width:100px;height:auto;border:2px #438eb9 solid}p{margin:1px 0 0;font-size:10px;text-align:left!important}',
            'student_photo' => 1,
            'status' => 1
            ],
        ]);
    }
}

