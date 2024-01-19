<?php
class Assignment
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function uploadAssignment($title, $description, $filePath, $deadline)
    {
        $query = "INSERT INTO assignments (title, description, file_path, deadline) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'ssss', $title, $description, $filePath, $deadline);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function getAssignments()
    {
        $query = "SELECT * FROM assignments";
        $stmt = mysqli_prepare($this->db, $query);
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
