<?php

    class Student
    {
        private $name;
        private $enrollment_date;
        private $dept_id;
        private $id;

        function __construct($name, $enrollment_date, $dept_id, $id = null)
        {
            $this->name = $name;
            $this->enrollment_date = $enrollment_date;
            $this->dept_id = $dept_id;
            $this->id = $id;
        }


        function getName()
        {
            return $this->name;
        }

        function setName($name)
        {
            $this->name = $name;
        }

        function getEnrollmentDate()
        {
            return $this->enrollment_date;
        }

        function setEnrollmentDate($enrollment_date)
        {
            $this->enrollment_date = $enrollment_date;
        }

        function getDeptId()
        {
            return $this->dept_id;
        }

        function setDeptId($dept_id)
        {
            $this->dept_id = $dept_id;
        }

        function getId()
        {
            return $this->id;
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach($returned_students as $student) {
                $name = $student['name'];
                $enrollment_date = $student['enrollment_date'];
                $dept_id = $student['dept_id'];
                $id = $student['id'];
                $new_student = new Student($name, $enrollment_date, $dept_id, $id);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students");
        }

        function save()
        {
            $GLOBALS['DB']->exec(
            "INSERT INTO students (name, enrollment_date, dept_id)
            VALUES (
                '{$this->getName()}',
                '{$this->getEnrollmentDate()}',
                {$this->getDeptId()}
                )
            ");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {

        }

        function update($name, $dept_id)
        {
            $GLOBALS['DB']->exec(
                "UPDATE students
                SET name = '{$name}',
                    dept_id = {$dept_id}
                WHERE id = {$this->getId()};"
            );
            $this->setName($name);
            $this->setDeptId($dept_id);
        }

        function getCourses()
        {
            $query = $GLOBALS['DB']->query(
                "SELECT courses.*
                FROM students
                JOIN courses_students ON (students.id = courses_students.student_id)
                JOIN courses ON (courses_students.course_id = courses.id)
                WHERE students.id = {$this->getId()};"
            );

            $courses = [];
            foreach($query as $course){
                $name = $course['name'];
                $course_number = $course['course_number'];
                $dept_id = $course['dept_id'];
                $id = $course['id'];
                $new_course = new Course($name, $course_number, $dept_id, $id);
                $courses[] = $new_course;
            }
            return $courses;
        }

        function getDepartment()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM departments WHERE id = {$this->getDeptId()}");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result[0]['name'];
        }

        static function find($search_id)
       {
           $found_student = null;
           $students = Student::getAll();
           foreach($students as $student) {
               $student_id = $student->getId();
               if ($student_id == $search_id) {
                 $found_student = $student;
               }
           }
           return $found_student;
       }

    }
 ?>
