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

	}
?>
