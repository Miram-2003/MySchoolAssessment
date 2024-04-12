CREATE DATABASE school_assessment;
USE school_assessment;


CREATE TABLE `Class` (
    `classID` INT PRIMARY KEY AUTO_INCREMENT,
    `className` VARCHAR(255)
);


CREATE TABLE `Student` (
    `studentID` INT PRIMARY KEY AUTO_INCREMENT,
    `studentIndex` INT UNIQUE,
    `studentName` VARCHAR(255),
    `classID` INT,
    FOREIGN KEY (`classID`) REFERENCES Class(`classID`)
);

CREATE TABLE `Teacher` (
    `teacherID` INT PRIMARY KEY AUTO_INCREMENT,
    `teacherName` VARCHAR(255),
    `teacherContact` INT,
    `teacherEmail` VARCHAR(255),
    `teacherPwd` VARCHAR(255)
);


CREATE TABLE `Subjects` (
    `subjectID` INT PRIMARY KEY AUTO_INCREMENT,
    `subjectName` VARCHAR(255)
   
);

INSERT INTO `Subjects` (`subjectName`) VALUES ('History'), ('English Lang.'), ('R.M.E'), ('Career Tech.'), ('Int. Science'), ('Mathematics');


CREATE TABLE `Term` (
    `termID` INT PRIMARY KEY AUTO_INCREMENT,
    `termName` VARCHAR(50)
);


INSERT INTO `Term` (`termName`) VALUES ('Term 1'), ('Term 2'), ('Term 3');



CREATE TABLE `Assessment`(
    `assessmentID` INT PRIMARY KEY AUTO_INCREMENT,
    `assessmentName` VARCHAR(255)

);


INSERT INTO `Assessment` (`assessmentName`) VALUES ('Class test 1 - 20'), ('Class test 2 - 20'), ('Group work - 10'), ('Project work - 10'), ('Exams - 100');


CREATE TABLE `Grade` (
    `gradeID` INT PRIMARY KEY AUTO_INCREMENT,
    `assessmentID` INT,
    `studentID` INT,
    `subjectID` INT,
    `termID` INT,
    `score` INT,
    `year` INT,
    `teacherID` INT,
    FOREIGN KEY (`assessmentID`) REFERENCES `Assessment`(`assessmentID`),
    FOREIGN KEY (`studentID`) REFERENCES `Student`(`studentID`),
    FOREIGN KEY (`subjectID`) REFERENCES `Subjects`(`subjectID`),
    FOREIGN KEY (`termID`) REFERENCES `Term`(`termID`),
    FOREIGN KEY (`teacherID`) REFERENCES `Teacher`(`teacherID`)
);



INSERT INTO `Class` (`className`) VALUES 
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



--
ALTER TABLE `Grade`
  ADD CONSTRAINT `grade_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `Student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE;

