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

        function update()
        {

        }

        function getCourses()
        {

        }

        function getStudnets()
        {

        }

        function addCourse($course_id)
        {

        }

        function addStudent($student_id)
        {
            
        }
    }

 ?>
