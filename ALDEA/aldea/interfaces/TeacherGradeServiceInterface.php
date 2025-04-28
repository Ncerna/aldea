<?php 
// app/Services/Interfaces/TeacherGradeServiceInterface.php
interface TeacherGradeServiceInterface {
    public function getTeacherGrades(int $teacherId, int $yearId): array;
}

 ?>