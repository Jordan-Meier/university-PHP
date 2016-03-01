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

        function update($name, $dept_id)
        {

        }

        function getCourses()
        {

        }

        function getDepartment()
        {

        }


    }

 ?>
