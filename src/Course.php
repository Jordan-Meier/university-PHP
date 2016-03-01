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
            $this->is_complete = $is_complete;
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

        }

        static function deleteAll()
        {

        }

        function save()
        {

        }

        function delete()
        {

        }

        function update($name, $course_number)
        {

        }

        function getCourses()
        {

        }

        function getDepartment()
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
