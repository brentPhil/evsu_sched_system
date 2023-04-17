<?php
require_once('dbconfig.php');
$db = new dbconfig();

class view extends dbconfig
{
    public function dept_view(): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn,"SELECT * FROM deppartment");
    }
     public function event_view(): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn, "SELECT * FROM calendar WHERE app_uid = 3");
    }
    public function dept_view_id($id): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn,"SELECT * FROM deppartment WHERE id = '$id'");
    }

    public function pro_view($id): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn,"SELECT * FROM st_profile WHERE st_uid = '$id'");
    }

    public function course_view(): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn,"SELECT * FROM courses");
    }
    public function all_approved_request(): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn, "SELECT * FROM st_request a INNER JOIN deppartment b ON a.dept_id = b.id INNER JOIN courses c ON a.course_id = c.id LEFT JOIN st_profile d ON d.st_uid = a.st_uid INNER JOIN calendar e ON a.rq_id = e.app_uid");
    }

    public function admins(): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn,"SELECT * FROM admin a INNER JOIN deppartment b ON a.dept_id = b.id");
    }
    public function students(): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn,"SELECT * FROM student a INNER JOIN deppartment b ON a.dept_id = b.id");
    }
//    Insert Functions

    public function new_event($ad_id,$uid,$e_type,$e_date,$e_length,$e_category): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn,"INSERT INTO calendar(app_uid, dept_id, event_type, event_date, event_length, event_category) VALUES ('$ad_id','$uid','$e_type','$e_date','$e_length','$e_category')");
    }
    public function pro_save($st_uid, $course_id, $lname, $fname, $middle, $gender, $address, $email, $phone): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn,"INSERT INTO st_profile(st_uid, course_id, lname, fname, middle, gender, address, email, phone) VALUES ('$st_uid', '$course_id', '$lname', '$fname', '$middle', '$gender', '$address', '$email', '$phone')");
    }
    public function new_dept($dept, $desc): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn,"INSERT INTO deppartment( dept, description) VALUES ('$dept','$desc')");
    }
    public function new_course($dept_id, $name, $desc): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn,"INSERT INTO courses( dept_id, name, description) VALUES ('$dept_id','$name','$desc')");
    }
    public function conform_rq($uid, $dept_id, $rq_date): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn,"INSERT INTO calendar(app_uid, event_type, event_date, event_length, event_category, dept_id) VALUES ('$uid', 'request', '$rq_date', '1', '4', '$dept_id')");
    }

    public function new_request($st_uid, $rand_id, $dept, $course, $type, $fullname, $gender,  $contact,  $sched_dt,  $status, $rq_status): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn,
            "INSERT INTO st_request(st_uid, rq_cert, dept_id, course_id, app_type, full_name, a_gender, a_phone, rq_schedule, edu_status, request_status) VALUES 
                                         ('$st_uid','$rand_id','$dept','$course','$type','$fullname', '$gender', '$contact', '$sched_dt', '$status', '$rq_status')");
    }


//    Update Functions
    public function update_request($st_uid,$dept,$course,$type,$fullname, $gender, $contact, $status, $sched_dt, $rq_id): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn, "UPDATE st_request SET st_uid='$st_uid',dept_id='$dept',course_id='$course',app_type='$type',full_name='$fullname',a_gender='$gender',a_phone='$contact',edu_status='$status',rq_schedule='$sched_dt' WHERE rq_id = '$rq_id'");
    }
    public function conform_update($uid, $status): mysqli_result|bool
        {
            global $db;
            return mysqli_query($db->conn, "UPDATE st_request SET request_status = '$status' WHERE rq_id = '$uid'");
        }

//    Delete Functions

    public function del_event_cal($d_id, $uid): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn, "DELETE FROM calendar WHERE id = '$d_id' AND dept_id = '$uid'");
    }
    public function del_rq($id): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn, "DELETE FROM st_request WHERE rq_id = '$id'");
    }
    public function del_sched($id): mysqli_result|bool
    {
        global $db;
        return mysqli_query($db->conn, "DELETE FROM calendar WHERE app_uid = '$id'");
    }
}