<?php
class Submission
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function uploadSubmission($assignmentId, $studentId, $filePath)
    {
        $query = "INSERT INTO submissions (assignment_id, student_id, file_path) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'iis', $assignmentId, $studentId, $filePath);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function getSubmissionsByAssignment($assignmentId)
    {
        $query = "SELECT * FROM submissions WHERE assignment_id = ?";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'i', $assignmentId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $listAssignment = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $listAssignment[] = $row;
        }
        mysqli_stmt_close($stmt);

        return $listAssignment;
    }
}
