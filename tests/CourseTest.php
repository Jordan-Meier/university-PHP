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
            //Arrange
            $name = "History";
            $test_department = new Department($name);
            $test_department->save();

            $name = "Pre Colonial N. America";
            $course_number = 103;
            $dept_id = $test_department->getId();
            $test_course = new Course($name, $course_number, $dept_id);
            $test_course->save();

            //Act
            $result = Course::getAll();

            //Assert

            $this->assertEquals($test_course, $result[0]);

        }

        function test_getAll()
        {
            //Arrange
            $name = "History";
            $test_Department = new Department($name);
            $test_Department->save();

            $name = "Pre Colonial N. America";
            $course_number = 103;
            $dept_id = $test_Department->getId();
            $test_course = new Course($name, $course_number, $dept_id);
            $test_course->save();

            $name2 = "American Civial War";
            $course_number2 = 104;
            $dept_id2 = $test_Department->getId();
            $test_course2 = new Course($name2, $course_number2, $dept_id2);
            $test_course2->save();

            //Act
            $result = Course::getAll();

            //Assert
            $this->assertEquals([$test_course, $test_course2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "History";
            $test_Department = new Department($name);
            $test_Department->save();

            $name = "Pre Colonial N. America";
            $course_number = 103;
            $dept_id = $test_Department->getId();
            $test_course = new Course($name, $course_number, $dept_id);
            $test_course->save();

            $name2 = "American Civial War";
            $course_number2 = 104;
            $dept_id2 = $test_Department->getId();
            $test_course2 = new Course($name2, $course_number2, $dept_id2);
            $test_course->save();


            //Act
            Course::deleteAll();
            $result = Course::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_getDepartment()
        {
            //Arrange
            $name = "History";
            $test_department = new Department($name);
            $test_department->save();

            $name = "Pre Colonial N. America";
            $course_number = 103;
            $dept_id = $test_department->getId();
            $test_course = new Course($name, $course_number, $dept_id);
            $test_course->save();

            //Act
            $result = $test_course->getDepartment();

            //Assert
            $this->assertEquals($test_department->getName(), $result);
        }
	}
?>
