-- Create the schema
CREATE TABLE users (
    user_id INT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(100)
);

CREATE TABLE teachers (
    teacher_id INT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(100)
);

CREATE TABLE courses (
    course_id INT PRIMARY KEY,
    title VARCHAR(100),
    category VARCHAR(50),
    teacher_id INT,
    FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id)
);

CREATE TABLE enrollments (
    enrollment_id INT PRIMARY KEY,
    user_id INT,
    course_id INT,
    enrollment_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
);

CREATE TABLE reviews (
    review_id INT PRIMARY KEY,
    user_id INT,
    course_id INT,
    rating INT,
    comment TEXT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
);

-- Insert data into users
INSERT INTO users (user_id, name, email) VALUES
(1, 'Alice', 'alice@example.com'),
(2, 'Bob', 'bob@example.com'),
(3, 'Charlie', 'charlie@example.com'),
(4, 'David', 'david@example.com'),
(5, 'Eve', 'eve@example.com');

-- Insert data into teachers
INSERT INTO teachers (teacher_id, name, email) VALUES
(1, 'Professor Oak', 'oak@example.com'),
(2, 'Professor Elm', 'elm@example.com'),
(3, 'Professor Birch', 'birch@example.com');

-- Insert data into courses
INSERT INTO courses (course_id, title, category, teacher_id) VALUES
(1, 'Introduction to SQL', 'Database', 1),
(2, 'Advanced Python', 'Programming', 2),
(3, 'Web Development Basics', 'Web', 3),
(4, 'Data Analysis with Python', 'Data Science', 2);

-- Insert data into enrollments
INSERT INTO enrollments (enrollment_id, user_id, course_id, enrollment_date) VALUES
(1, 1, 1, '2025-01-01'),
(2, 2, 1, '2025-01-05'),
(3, 3, 2, '2025-01-10'),
(4, 4, 3, '2025-01-15'),
(5, 5, 4, '2025-01-20');

-- Insert data into reviews
INSERT INTO reviews (review_id, user_id, course_id, rating, comment) VALUES
(1, 1, 1, 5, 'Excellent course!'),
(2, 2, 1, 4, 'Very informative.'),
(3, 3, 2, 3, 'Good, but could be better.'),
(4, 4, 3, 5, 'Amazing content!'),
(5, 5, 4, 4, 'Great course on data analysis.');

-- Join examples with aggregates and advanced queries

-- 1. Find the average rating for each course
SELECT courses.title AS Course, AVG(reviews.rating) AS Average_Rating
FROM courses
LEFT JOIN reviews ON courses.course_id = reviews.course_id
GROUP BY courses.title;

-- 2. Count the number of students enrolled in each course
SELECT courses.title AS Course, COUNT(enrollments.user_id) AS Total_Students
FROM courses
LEFT JOIN enrollments ON courses.course_id = enrollments.course_id
GROUP BY courses.title;

-- 3. List all teachers and the total number of courses they teach
SELECT teachers.name AS Teacher, COUNT(courses.course_id) AS Total_Courses
FROM teachers
LEFT JOIN courses ON teachers.teacher_id = courses.teacher_id
GROUP BY teachers.name; 

-- 4. Find courses with more than 1 review
SELECT courses.title AS Course, COUNT(reviews.review_id) AS Total_Reviews
FROM courses
LEFT JOIN reviews ON courses.course_id = reviews.course_id
GROUP BY courses.title
HAVING COUNT(reviews.review_id) > 1;

-- 5. Find the highest-rated course
SELECT courses.title AS Course, MAX(reviews.rating) AS Highest_Rating
FROM courses
LEFT JOIN reviews ON courses.course_id = reviews.course_id
GROUP BY courses.title
ORDER BY Highest_Rating DESC
LIMIT 1;

-- 6. Find the average number of students per course
SELECT AVG(Student_Count) AS Avg_Students_Per_Course
FROM (
    SELECT COUNT(enrollments.user_id) AS Student_Count
    FROM courses
    LEFT JOIN enrollments ON courses.course_id = enrollments.course_id
    GROUP BY courses.course_id
) AS Course_Student_Counts;

-- 7. List courses along with the names of students enrolled and the teacher's name
SELECT 
    courses.title AS Course, 
    teachers.name AS Teacher, 
    users.name AS Student
FROM courses
LEFT JOIN teachers ON courses.teacher_id = teachers.teacher_id
LEFT JOIN enrollments ON courses.course_id = enrollments.course_id
LEFT JOIN users ON enrollments.user_id = users.user_id;

-- 8. Count the number of courses in each category
SELECT category, COUNT(course_id) AS Total_Courses
FROM courses
GROUP BY category;

-- 9. Find the teacher with the most courses assigned
SELECT teachers.name AS Teacher, COUNT(courses.course_id) AS Total_Courses
FROM teachers
LEFT JOIN courses ON teachers.teacher_id = courses.teacher_id
GROUP BY teachers.name
ORDER BY Total_Courses DESC
LIMIT 1;

-- 10. List all reviews along with the corresponding course title and student name
SELECT 
    courses.title AS Course, 
    users.name AS Student, 
    reviews.rating, 
    reviews.comment
FROM reviews
LEFT JOIN courses ON reviews.course_id = courses.course_id
LEFT JOIN users ON reviews.user_id = users.user_id;

-- 11. Find courses that have no students enrolled
SELECT courses.title AS Course
FROM courses
LEFT JOIN enrollments ON courses.course_id = enrollments.course_id
WHERE enrollments.enrollment_id IS NULL;

-- 12. Find teachers who have no courses assigned
SELECT teachers.name AS Teacher
FROM teachers
LEFT JOIN courses ON teachers.teacher_id = courses.teacher_id
WHERE courses.course_id IS NULL;

-- 13. Calculate the total number of reviews given by each student
SELECT users.name AS Student, COUNT(reviews.review_id) AS Total_Reviews
FROM users
LEFT JOIN reviews ON users.user_id = reviews.user_id
GROUP BY users.name;

-- 14. Find students who are enrolled in more than 1 course
SELECT users.name AS Student, COUNT(enrollments.course_id) AS Total_Courses
FROM users
LEFT JOIN enrollments ON users.user_id = enrollments.user_id
GROUP BY users.name
HAVING COUNT(enrollments.course_id) > 1;

-- 15. Find the total number of enrollments per course category
SELECT courses.category, COUNT(enrollments.enrollment_id) AS Total_Enrollments
FROM courses
LEFT JOIN enrollments ON courses.course_id = enrollments.course_id
GROUP BY courses.category;

-- 16. Find the course with the lowest average rating
SELECT courses.title AS Course, AVG(reviews.rating) AS Average_Rating
FROM courses
LEFT JOIN reviews ON courses.course_id = reviews.course_id
GROUP BY courses.title
ORDER BY Average_Rating ASC
LIMIT 1;

-- 17. List all students and the courses they reviewed
SELECT 
    users.name AS Student, 
    courses.title AS Course, 
    reviews.rating, 
    reviews.comment
FROM users
LEFT JOIN reviews ON users.user_id = reviews.user_id
LEFT JOIN courses ON reviews.course_id = courses.course_id;

-- 18. Calculate the average rating per teacher
SELECT 
    teachers.name AS Teacher, 
    AVG(reviews.rating) AS Average_Rating
FROM teachers
LEFT JOIN courses ON teachers.teacher_id = courses.teacher_id
LEFT JOIN reviews ON courses.course_id = reviews.course_id
GROUP BY teachers.name;

-- 19. Find teachers with courses that have no reviews
SELECT teachers.name AS Teacher
FROM teachers
LEFT JOIN courses ON teachers.teacher_id = courses.teacher_id
LEFT JOIN reviews ON courses.course_id = reviews.course_id
WHERE reviews.review_id IS NULL;

-- 20. List all students who haven't enrolled in any courses
SELECT users.name AS Student
FROM users
LEFT JOIN enrollments ON users.user_id = enrollments.user_id
WHERE enrollments.enrollment_id IS NULL;
