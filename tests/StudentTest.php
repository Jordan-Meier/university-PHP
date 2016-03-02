<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    $server = 'mysql:host=localhost;dbname=university_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StudentTest extends PHPUnit_Framework_TestCase
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

            $name = "Jonas Frizzle";
            $enrollment_date = "2016-02-10";
            $dept_id = $test_department->getId();
            $test_student = new Student($name, $enrollment_date, $dept_id);
            $test_student->save();

            //Act
            $result = Student::getAll();

            //Assert

            $this->assertEquals($test_student, $result[0]);

        }

        function test_getAll()
        {
            //Arrange
            $name = "History";
            $test_department = new Department($name);
            $test_department->save();

            $name = "Jonas Frizzle";
            $enrollment_date = "2016-02-10";
            $dept_id = $test_department->getId();
            $test_student = new Student($name, $enrollment_date, $dept_id);
            $test_student->save();

            $name2 = "Marsha Grizzle";
            $enrollment_date2 = "2016-02-10";
            $dept_id2 = $test_department->getId();
            $test_student2 = new Student($name2, $enrollment_date2, $dept_id2);
            $test_student2->save();

            //Act
            $result = Student::getAll();

            //Assert
            $this->assertEquals([$test_student, $test_student2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "History";
            $test_department = new Department($name);
            $test_department->save();

            $name = "Jonas Frizzle";
            $enrollment_date = "2016-02-10";
            $dept_id = $test_department->getId();
            $test_student = new Student($name, $enrollment_date, $dept_id);
            $test_student->save();

            $name2 = "Marsha Grizzle";
            $enrollment_date2 = "2016-02-10";
            $dept_id2 = $test_department->getId();
            $test_student2 = new Student($name2, $enrollment_date2, $dept_id2);
            $test_student2->save();


            //Act
            Student::deleteAll();
            $result = Student::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_update()
        {
            //Arrange
            $name = "History";
            $test_department = new Department($name);
            $test_department->save();

            $name = "Mathematics";
            $test_department2 = new Department($name);
            $test_department2->save();

            $name = "Marsha Grizzle";
            $enrollment_date = "2016-02-10";
            $dept_id = $test_department->getId();
            $test_student = new Student($name, $enrollment_date, $dept_id);
            $test_student->save();

            //Act
            $new_name = "Marsha Frizzle";
            $new_dept_id = $test_department2->getId();
            $test_student->update($new_name, $new_dept_id);
            $result = [$test_student->getName(), $test_student->getDeptId()];
            // $result[] = $test_student->getName();
            // $result[] = $test_student->getCourseNumber();

            //Assert
            $this->assertEquals(["Marsha Frizzle", $new_dept_id], $result);
        }

        function test_getCourses()
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

            $name = "Jonas Frizzle";
            $enrollment_date = "2016-02-10";
            $dept_id = $test_department->getId();
            $test_student = new Student($name, $enrollment_date, $dept_id);
            $test_student->save();

            //Act
            $test_course->addStudent($test_student->getId());
            $result = $test_student->getCourses();

            //Assert
            $this->assertEquals([$test_course], $result);
        }

        function test_getDepartment()
        {
            //Arrange
            $name = "History";
            $test_department = new Department($name);
            $test_department->save();

            $name = "Jonas Frizzle";
            $enrollment_date = "2016-02-10";
            $dept_id = $test_department->getId();
            $test_student = new Student($name, $enrollment_date, $dept_id);
            $test_student->save();

            //Act
            $result = $test_student->getDepartment();

            //Assert
            $this->assertEquals($test_department->getName(), $result);
        }


        function test_find()
        {
            //Arrange
            $name = "History";
            $test_department = new Department($name);
            $test_department->save();

            $name = "Jonas Frizzle";
            $enrollment_date = "2016-02-10";
            $dept_id = $test_department->getId();
            $test_student = new Student($name, $enrollment_date, $dept_id);
            $test_student->save();

            $name2 = "Marsha Grizzle";
            $enrollment_date2 = "2016-02-10";
            $dept_id2 = $test_department->getId();
            $test_student2 = new Student($name2, $enrollment_date2, $dept_id2);
            $test_student2->save();
            //Act
            $result = Student::find($test_student->getId());
            //Assert
            $this->assertEquals($test_student, $result);
        }

	}
?>
