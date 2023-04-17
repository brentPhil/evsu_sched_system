<?php
require_once('dbconfig.php');

class Archive extends dbconfig
{
    public function st_request_archive($request_id): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT * FROM Request_archive r
LEFT JOIN authorizedpersonnel_archive a
ON r.AuthorizedPersonnelID = a.AuthorizedPersonnelID
WHERE r.StudentID = '$request_id'");
    }
    public function request_archive(): mysqli_result|bool
    {
        global $view;
        return mysqli_query($view->conn, "SELECT * FROM Request_archive r
LEFT JOIN authorizedpersonnel_archive a
ON r.AuthorizedPersonnelID = a.AuthorizedPersonnelID");
    }
    public function archive_Requests($requestID, $status): mysqli_result|bool
    {
        try {
            // Start transaction
            $this->conn->begin_transaction();

            $stmt6 = $this->conn->prepare("UPDATE request SET RequestStatus = ? WHERE RequestID = ?");
            $stmt6->bind_param("ss", $status, $requestID);
            $stmt6->execute();
            $stmt6->close();

            // Archive requests
            $stmt1 = $this->conn->prepare("INSERT INTO request_archive SELECT * FROM request WHERE RequestID = ?");
            $stmt1->bind_param("s", $requestID);
            $stmt1->execute();
            $stmt1->close();

            // Archive document mappings
            $stmt2 = $this->conn->prepare("INSERT INTO documentmapping_archive SELECT * FROM documentmapping WHERE RequestID = ?");
            $stmt2->bind_param("s", $requestID);
            $stmt2->execute();
            $stmt2->close();

            // Archive authorized personnel
            $stmt3 = $this->conn->prepare("INSERT INTO authorizedpersonnel_archive SELECT * FROM authorizedpersonnel WHERE AuthorizedPersonnelID IN (SELECT DISTINCT AuthorizedPersonnelID FROM request_archive)");
            $stmt3->execute();
            $stmt3->close();

            // Clear requests and associated records from original tables
            $stmt4 = $this->conn->prepare("DELETE FROM documentmapping WHERE RequestID = ?");
            $stmt4->bind_param("s", $requestID);
            $stmt4->execute();
            $stmt4->close();

            $stmt5 = $this->conn->prepare("DELETE FROM request WHERE RequestID = ?");
            $stmt5->bind_param("s", $requestID);
            $stmt5->execute();
            $stmt5->close();

            // Delete authorized personnel associated with archived requests
            $stmt4 = $this->conn->prepare("DELETE FROM authorizedpersonnel WHERE AuthorizedPersonnelID IN (SELECT DISTINCT AuthorizedPersonnelID FROM request_archive)");
            $stmt4->execute();
            $stmt4->close();

            // Commit transaction
            $this->conn->commit();

            return true;
        } catch (Exception $e) {
            error_log("Error archiving request: " . $e->getMessage());
            $this->conn->rollback();
            return false;
        }
    }
}