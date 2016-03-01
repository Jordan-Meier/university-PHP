<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $server = 'mysql:host=localhost;dbname=university_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
            Department::deleteAll();
        }

        function test_save()
        {
            // //Arrange
            // $name = "History";
            // $id = null;
            // $test_department = new Department($name, $id);
            // $test_department->save();
            //
            // $name = "Pre Colonial N. America";
            // $course_number = 103;
            // $dept_id = $this->getDeptId();
            // $test_course = new Course($name, $course_number, $dept_id, $id);
            //
            // //Act
            // $test_course->save();
            //
            // //Assert
            // $result = Course::getAll();
            // $this->assertEquals($test_course, $result[0]);

        }
	}
?>
