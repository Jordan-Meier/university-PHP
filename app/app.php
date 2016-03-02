<?php

	require_once __DIR__.'/../vendor/autoload.php';

	$server = 'mysql:host=localhost;dbname=university';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);

	$app = new Silex\Application();
	$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

	$app->get('/', function() use ($app)
	{
		return $app['twig']->render('index.html.twig');
	});

	$app->get('/departments', function() use ($app)
	{
		$departments = Department::getAll();
		return $app['twig']->render('departments.html.twig', array('departments' => $departments));
	});

	$app->post('/departments', function() use ($app)
	{
		$new_department = new Department($_POST['name']);
		$new_department->save();

		$departments = Department::getAll();
		return $app['twig']->render('departments.html.twig', array('departments' => $departments));
	});

	$app->get('/courses', function() use ($app)
	{
		$courses = Course::getAll();
		$departments = Department::getAll();
		return $app['twig']->render('courses.html.twig', array('courses' => $courses, 'departments' => $departments));
	});

	$app->post('/courses', function() use ($app)
	{
		$new_course = new Course($_POST['name'], $_POST['course_number'], $_POST['dept_id']);
		$new_course->save();

		$courses = Course::getAll();
		$departments = Department::getAll();
		return $app['twig']->render('courses.html.twig', array('courses' => $courses, 'departments' => $departments));
	});

	$app->get('/courses/{id}', function($id) use ($app)
	{
		$course = Course::find($id);
		$students = $course->getStudents();
		return $app['twig']->render('course.html.twig', array('course' => $course, 'students' => $students));
	});


	$app->get('/students', function() use ($app)
	{
		$students = Student::getAll();
		$departments = Department::getAll();
		return $app['twig']->render('students.html.twig', array('students' => $students, 'departments' => $departments));
	});

	$app->get('/students/{id}', function($id) use ($app)
	{
		$student = Student::find($id);
		return $app['twig']->render('student.html.twig', array('student' => $student));
	});

	$app->post('/students', function() use ($app)
	{
		$new_student = new Student($_POST['name'], $_POST['enrollment_date'], $_POST['dept_id']);
		$new_student->save();

		$students = Student::getAll();
		$departments = Department::getAll();
		return $app['twig']->render('students.html.twig', array('students' => $students, 'departments' => $departments));
	});

	return $app;

?>
