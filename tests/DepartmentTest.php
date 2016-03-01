<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $server = 'mysql:host=localhost;dbname=university_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DepartmentTest extends PHPUnit_Framework_TestCase
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
            $test_Department = new Department($name);
            $test_Department->save();

            //Act
            $result = Department::getAll();

            //Assert
            $this->assertEquals($test_Department, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "History";
            $test_Department = new Department($name);
            $test_Department->save();

            $name2 = "Philosophy";
            $test_Department2 = new Department($name2);
            $test_Department2->save();
            //Act
            $result = Department::getAll();
            //Assert
            $this->assertEquals([$test_Department, $test_Department2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "History";
            $test_Department = new Department($name);
            $test_Department->save();

            $name2 = "Philosophy";
            $test_Department2 = new Department($name2);
            $test_Department2->save();

            //Act
            Department::deleteAll();
            $result = Department::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_update()
        {
            //Arrange
            $name = "History";
            $test_Department = new Department($name);
            $test_Department->save();

            //Act
            $new_name = "History of America";
            $test_Department->update($new_name);
            $result = $test_Department->getName();

            //Assert
            $this->assertEquals("History of America", $result);

        }

        function test_getCourses()
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
            $result = $test_Department->getCourses();
            //Assert
            $this->assertEquals([$test_course, $test_course2], $result);
        }
	}
?>
