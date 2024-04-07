CREATE DATABASE school_assessment;
USE school_assessment;

-- Table: Class
CREATE TABLE Class (
    classID INT PRIMARY KEY AUTO_INCREMENT,
    className VARCHAR(255)
);

-- Table: Student
CREATE TABLE Student (
    studentID INT PRIMARY KEY AUTO_INCREMENT,
    studentIndex INT UNIQUE,
    studentName VARCHAR(255),
    classID INT,
    FOREIGN KEY (classID) REFERENCES Class(classID)
);

-- Table: Teacher
CREATE TABLE Teacher (
    teacherID INT PRIMARY KEY AUTO_INCREMENT,
    teacherName VARCHAR(255),
    teacherContact INT,
    teacherEmail VARCHAR(255),
    teacherPwd VARCHAR(255)
);

-- Table: Subject
CREATE TABLE Subject (
    subjectID INT PRIMARY KEY AUTO_INCREMENT,
    subjectName VARCHAR(255)
   
);

CREATE TABLE Term (
    termID INT PRIMARY KEY AUTO_INCREMENT,
    termName VARCHAR(50)
);

-- Inserting terms into the Term table
INSERT INTO Term (termName) VALUES ('Term 1'), ('Term 2'), ('Term 3');

-- Table: Assessment
CREATE TABLE Assessment (
    assessmentID INT PRIMARY KEY AUTO_INCREMENT,
    studentID INT,
    subjectID INT,
    termID INT,
    score INT,
    teacherID INT,
    FOREIGN KEY (studentID) REFERENCES Student(studentID),
    FOREIGN KEY (subjectID) REFERENCES Subject(subjectID),
    FOREIGN KEY (termID) REFERENCES Term(termID),
    FOREIGN KEY (teacherID) REFERENCES Teacher(teacherID)
);


-- Inserting class names into the Class table
INSERT INTO Class (className) VALUES 
('Nursery'), 
('Creche'),
('KG1'),
('KG2'),
('Primary 1'),
('Primary 2'),
('Primary 3'),
('Primary 4'),
('Primary 5'),
('Primary 6'),
('JHS1'),
('JHS2'),
('JHS3');



