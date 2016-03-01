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
