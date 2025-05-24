<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Available Courses</h2>
    <div id="course-list"></div>

    <script>
    $(document).ready(function() {
        $.getJSON('api/courses.php', function(courses) {
            courses.forEach(function(course) {
                $('#course-list').append(
                    `<div>
                        <h4>${course.title}</h4>
                        <p>${course.description}</p>
                        <button onclick="enroll(${course.id})">Enroll</button>
                    </div>`
                );
            });
        });
    });

    function enroll(courseId) {
        $.post('ajax/enroll.php', { course_id: courseId }, function(response) {
            alert(response.message);
        }, 'json');
    }
    </script>
</body>
</html>