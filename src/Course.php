<?php

    class Course
    {
        private $name;
        private $course_number;
        private $dept_id;
        private $id;

        function __construct($name, $course_number, $dept_id, $id = null)
        {
            $this->name = $name;
            $this->course_number = $course_number;
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

        function getCourseNumber()
        {
            return $this->course_number;
        }

        function setCourseNumber($course_number)
        {
            $this->course_number = $course_number;
        }

        function getDeptId()
        {
            return $this->dept_id;
        }

        function getId()
        {
            return $this->id;
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
        //    var_dump($returned_courses);
            $courses = array();
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses");
        }

        function save()
        {
            $GLOBALS['DB']->exec(
            "INSERT INTO courses (name, course_number, dept_id)
            VALUES (
                '{$this->getName()}',
                {$this->getCourseNumber()},
                {$this->getDeptId()}
                )
            ");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {

        }

        function update($name, $course_number)
        {
            $GLOBALS['DB']->exec(
                "UPDATE courses
                SET name = '{$name}',
                    course_number = {$course_number}
                WHERE id = {$this->getId()};"
            );
            $this->setName($name);
            $this->setCourseNumber($course_number);

        }

        function getDepartment()
        {
            $query = $GLOBALS['DB']->query("SELECT name FROM departments WHERE id = {$this->getDeptId()}");
        //    var_dump($query);
            // $result = $query[0]['name'];
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        //    var_dump($result);
            return $result[0]['name'];
            // return $result;
        }

        function getStudents()
        {

        }

        function markComplete()
        {

        }

        function addStudent()
        {

        }
    }

 ?>
