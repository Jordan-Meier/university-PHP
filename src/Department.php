<?php

    class Department
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
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

        function getId()
        {
            return $this->id;
        }

        static function getAll()
        {
            $returned_departments = $GLOBALS['DB']->query("SELECT * FROM departments;");
            $departments = array();
            foreach($returned_departments as $department) {
                $name = $department['name'];
                $id = $department['id'];
                $new_department = new Department($name, $id);
                array_push($departments, $new_department);
            }
            return $departments;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM departments;");
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO departments (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {

        }

        function update($name)
        {
            $GLOBALS['DB']->exec(
                "UPDATE departments
                SET name = '{$name}'
                WHERE id = {$this->getId()};"
            );
            $this->setName($name);
        }

        function getCourses()
        {
            $courses = array();
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses WHERE dept_id = {$this->getId()}");
            foreach($returned_courses as $course) {
                $name = $course['name'];
                $course_number = $course['course_number'];
                $dept_id = $course['dept_id'];
                $id = $course['id'];

                $new_course = new Course($name, $course_number, $dept_id, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        function getStudents()
        {
            $students = array();
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students WHERE dept_id = {$this->getId()}");
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

    }

 ?>
