<?php
require_once('dbconfig.php');
$insert = new dbconfig();

class insert extends dbconfig
{
    public function new_event($ad_id,$uid,$e_type,$e_date,$e_length,$e_category): mysqli_result|bool
    {
        global $insert;
        return mysqli_query($insert->conn,"INSERT INTO calendar(app_uid, dept_id, event_type, event_date, event_length, event_category) VALUES ('$ad_id','$uid','$e_type','$e_date','$e_length','$e_category')");
    }
    public function newDocuments($name, $description): mysqli_result|bool
    {
        global $insert;
        $stmt = $insert->conn->prepare("INSERT INTO documents(DocumentName, DocumentDescription) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function new_request($requestType, $studentId, $studentFullName, $studentEmail, $studentAddress, $studentGender, $studentPhone, $department, $course, $education, $schedule, $authorizedPersonnelId, $requestStatus, $createdAt, $selectedDocuments): mysqli_result|bool
    {
        global $insert;
        $stmt = $insert->conn->prepare("INSERT INTO `request`(`RequestType`, `StudentID`, `StudentFullName`, `StudentEmail`, `StudentAddress`, `StudentGender`, `StudentPhone`, `Department`, `Course`, `Education`, `Schedule`, `AuthorizedPersonnelID`, `CreatedAt`, `RequestStatus`) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssssss", $requestType, $studentId, $studentFullName, $studentEmail, $studentAddress, $studentGender, $studentPhone, $department, $course, $education, $schedule, $authorizedPersonnelId, $createdAt, $requestStatus);
        $result = $stmt->execute();
        $RequestID = $stmt->insert_id;
        $stmt->close();

        if (!$result) {
            return false;
        }
        foreach ($selectedDocuments as $document) {
            $stmt = $insert->conn->prepare("INSERT INTO documentmapping (RequestID, DocumentID) VALUES (?, ?)");
            $stmt->bind_param("ss", $RequestID, $document);
            $result = $stmt->execute();
            $stmt->close();

            if (!$result) {
                return false;
            }
        }
        return true;
    }
    public function pro_save($st_uid, $course_id, $lname, $fname, $middle, $gender, $address, $email, $phone): bool
    {
        $stmt = $this->conn->prepare("INSERT INTO st_profile(st_uid, course_id, lname, fname, middle, gender, address, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssssss", $st_uid, $course_id, $lname, $fname, $middle, $gender, $address, $email, $phone);
        return $stmt->execute();
    }
    public function new_dept($dept, $desc): mysqli_result|bool
    {
        global $insert;
        return mysqli_query($insert->conn,"INSERT INTO deppartment( dept, description) VALUES ('$dept','$desc')");
    }
    public function new_course($dept_id, $name, $desc): mysqli_result|bool
    {
        global $insert;
        return mysqli_query($insert->conn,"INSERT INTO courses( dept_id, name, description) VALUES ('$dept_id','$name','$desc')");
    }
    public function conform_rq($uid, $rq_date) {
        $stmt = $this->conn->prepare("INSERT INTO calendar(app_uid, event_type, event_date, event_length, event_category) VALUES (?, 'request', ?, '1', '4')");
        $stmt->bind_param("is", $uid, $rq_date);
        return $stmt->execute();
    }
}