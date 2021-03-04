###############
#  DATABASE   #
###############

DROP DATABASE IF EXISTS bdAppWeb;
CREATE DATABASE bdAppWeb;
USE bdAppWeb;

CREATE TABLE  bdAppWeb.role (
	idRole BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
    roleName VARCHAR(255) NOT NULL,
    roleDescription VARCHAR (255) DEFAULT "NO DATA",
    active INTEGER DEFAULT 1,
	PRIMARY KEY(idRole),
    INDEX (idRole)
)ENGINE=InnoDB;

CREATE TABLE bdAppWeb.user (
	idUser  BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	
    idRole BIGINT UNSIGNED NOT NULL,
	userName VARCHAR(255) NOT NULL,
	userSurname VARCHAR(255) NOT NULL,    
    mail VARCHAR(255) UNIQUE NOT NULL,
    pass VARCHAR (255) NOT NULL,
    dni VARCHAR (9)  UNIQUE NOT NULL,
	birthDate DATE,
    indentificationNumber VARCHAR(20) UNIQUE NOT NULL,
	profileImage VARCHAR (255) DEFAULT NULL,
	loginNumber BIGINT UNSIGNED NOT NULL,
    active INTEGER DEFAULT 1,
    remember_token VARCHAR (255),
	PRIMARY KEY (idUser),
	INDEX (idUser),
    CONSTRAINT fk_idRole FOREIGN KEY (idRole) REFERENCES bdAppWeb.role (idRole) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE bdAppWeb.course (
	idCourse BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	
    courseName VARCHAR (50) NOT NULL,
    actualCourse INTEGER NOT NULL,
    active INTEGER DEFAULT 1,
	PRIMARY KEY (idCourse),
	INDEX (idCourse)
)ENGINE=InnoDB;

CREATE TABLE bdAppWeb.subject (
	idSubject  BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	
    idCreator BIGINT UNSIGNED NOT NULL,
    subjectName VARCHAR (50) NOT NULL,
    creditsNumber INTEGER,
    semester VARCHAR(2) NOT NULL,
    subjectType VARCHAR (20) NOT NULL,
    active INTEGER DEFAULT 1,
	PRIMARY KEY (idSubject),
	INDEX (idSubject),
    CONSTRAINT fk_idCreator FOREIGN KEY (idCreator) REFERENCES bdAppWeb.user (idUser) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE bdAppWeb.subject_course (
	idSubjectCourse  BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	
    idSubject BIGINT UNSIGNED NOT NULL,
	idCourse BIGINT UNSIGNED NOT NULL,
	PRIMARY KEY (idSubjectCourse),
	INDEX (idSubjectCourse),
	obs TEXT DEFAULT NULL,
	CONSTRAINT fk_idSubjectCourse FOREIGN KEY (idSubject) REFERENCES bdAppWeb.subject (idSubject) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT fk_idCourseSubject FOREIGN KEY (idCourse) REFERENCES bdAppWeb.course (idCourse) ON UPDATE CASCADE ON DELETE CASCADE
	
)ENGINE=InnoDB;

CREATE UNIQUE INDEX course_subject_index ON bdAppWeb.subject_course (idCourse,idSubject);

CREATE TABLE bdAppWeb.degree (
	idDegree  BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	
    degreeName VARCHAR (50) NOT NULL,
    active INTEGER DEFAULT 1,
	PRIMARY KEY (idDegree),
	INDEX (idDegree)
)ENGINE=InnoDB;

CREATE TABLE bdAppWeb.topic (
    idTopic BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	    
	idSubjectCourse  BIGINT UNSIGNED NOT NULL,
    topicName VARCHAR(255) NOT NULL,
    topicDescription VARCHAR (255) DEFAULT NULL,
    active INTEGER DEFAULT 1,
	PRIMARY KEY (idTopic),
	INDEX (idTopic),
    CONSTRAINT fk_idSubject FOREIGN KEY (idSubjectCourse) REFERENCES bdAppWeb.subject_course (idSubjectCourse) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE bdAppWeb.groups (
    idGroup BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
	groupName VARCHAR (255) UNIQUE NOT NULL,
    groupState INTEGER NOT NULL DEFAULT 1,
    active INTEGER DEFAULT 1,
	PRIMARY KEY (idGroup),
	INDEX (idGroup)

)ENGINE=InnoDB;

CREATE TABLE bdAppWeb.classrom (
    idClass BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	    
	idSubjectCourse  BIGINT UNSIGNED NOT NULL,
	idTopic BIGINT UNSIGNED NOT NULL,	
	idTeacherCreator  BIGINT UNSIGNED NOT NULL,
	idGroup BIGINT UNSIGNED NOT NULL,
	accessCode VARCHAR (255) NOT NULL,
    classState INTEGER NOT NULL DEFAULT 1,
    active INTEGER DEFAULT 1,
	PRIMARY KEY (idClass),
	INDEX (idClass),
    CONSTRAINT fk_idSubjectClass FOREIGN KEY (idSubjectCourse) REFERENCES bdAppWeb.subject_course (idSubjectCourse) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_idTeacherCreator FOREIGN KEY (idTeacherCreator) REFERENCES bdAppWeb.user (idUser) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT fk_idTopicClass FOREIGN KEY (idTopic) REFERENCES bdAppWeb.topic (idTopic) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT fk_idGroupClass FOREIGN KEY (idGroup) REFERENCES bdAppWeb.groups (idGroup) ON UPDATE CASCADE ON DELETE CASCADE

)ENGINE=InnoDB;



CREATE TABLE bdAppWeb.ask (
    idAsk BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	    
	idTopic  BIGINT UNSIGNED NOT NULL,
	idClass BIGINT UNSIGNED NOT NULL,
	idStudent BIGINT UNSIGNED NOT NULL,
    askContent VARCHAR(255) NOT NULL,
    answered  INTEGER DEFAULT 0,
	answer TEXT DEFAULT NULL,
    active INTEGER DEFAULT 1,
	PRIMARY KEY (idAsk),
	INDEX (idAsk),
    CONSTRAINT fk_idClass FOREIGN KEY (idClass) REFERENCES bdAppWeb.classrom (idClass) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT fk_idRopic FOREIGN KEY (idTopic) REFERENCES bdAppWeb.topic (idTopic) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT fk_idStudent FOREIGN KEY (idStudent) REFERENCES bdAppWeb.user (idUser) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE bdAppWeb.teacher_subject (
    idTeacherSubject BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	    
	idTeacher  BIGINT UNSIGNED NOT NULL,
	idSubject BIGINT UNSIGNED NOT NULL,	    
    active INTEGER DEFAULT 1,
	PRIMARY KEY (idTeacherSubject),
	INDEX (idTeacherSubject),
    CONSTRAINT fk_idTeacherSubject FOREIGN KEY (idTeacher) REFERENCES bdAppWeb.user (idUser) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT fk_idSubjectTeacher FOREIGN KEY (idSubject) REFERENCES bdAppWeb.subject_course (idSubjectCourse) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;
CREATE UNIQUE INDEX teacher_subject_index ON bdAppWeb.teacher_subject (idTeacher,idSubject);

CREATE TABLE bdAppWeb.teacher_class (
    idTeacherClass BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	    
	idTeacher  BIGINT UNSIGNED NOT NULL,
	idClass BIGINT UNSIGNED NOT NULL,	    
    active INTEGER DEFAULT 1,
	PRIMARY KEY (idTeacherClass),
	INDEX (idTeacherClass),
    CONSTRAINT fk_idTeacherClass FOREIGN KEY (idTeacher) REFERENCES bdAppWeb.user (idUser) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT fk_idClassTeacher FOREIGN KEY (idClass) REFERENCES bdAppWeb.classrom (idClass) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE bdAppWeb.student_registered (
    idStudentRegistered BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	    
	idStudent  BIGINT UNSIGNED NOT NULL,
	idSubject BIGINT UNSIGNED NOT NULL,	    
    active INTEGER DEFAULT 1,
	PRIMARY KEY (idStudentRegistered),
	INDEX (idStudentRegistered),
    CONSTRAINT fk_idStudentRegistered FOREIGN KEY (idStudent) REFERENCES bdAppWeb.user (idUser) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT fk_idSubjectRegisteredCourse FOREIGN KEY (idSubject) REFERENCES bdAppWeb.subject_course (idSubjectCourse) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;
CREATE UNIQUE INDEX student_subject_index ON bdAppWeb.student_registered (idStudent,idSubject);

CREATE TABLE bdAppWeb.subject_in_degree(
    idSubjectDegree BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	    
	idDegree  BIGINT UNSIGNED NOT NULL,
	idSubject BIGINT UNSIGNED NOT NULL,	    
    active INTEGER DEFAULT 1,
	PRIMARY KEY (idSubjectDegree),
	INDEX (idSubjectDegree),
    CONSTRAINT fk_idDegreeSubject FOREIGN KEY (idDegree) REFERENCES bdAppWeb.degree (idDegree) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT fk_idSubjectDegree FOREIGN KEY (idSubject) REFERENCES bdAppWeb.subject (idSubject) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE bdAppWeb.student_class (
    idStudentClass BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,	    
	idStudent  BIGINT UNSIGNED NOT NULL,
	idClass BIGINT UNSIGNED NOT NULL,
	studentOnline INTEGER UNSIGNED NOT NULL DEFAULT 1,	
	studentBaned INTEGER UNSIGNED NOT NULL DEFAULT 0,		    
    active INTEGER DEFAULT 1,
	PRIMARY KEY (idStudentClass),
	INDEX (idStudentClass),
    CONSTRAINT fk_idStuentClass FOREIGN KEY (idStudent) REFERENCES bdAppWeb.user (idUser) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT fk_idClassStudent FOREIGN KEY (idClass) REFERENCES bdAppWeb.classrom (idClass) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE VIEW ViewClassromInfo AS (Select classrom.idClass, classrom.idSubjectCourse, classrom.idTopic, classrom.idTeacherCreator, classrom.idGroup, classrom.classState, subject.subjectName,subject.idSubject, groups.groupName, topic.topicName, user.userName,user.userSurname from classrom 
                                inner join subject_course on subject_course.idSubjectCourse = classrom.idSubjectCourse
                                inner join subject on subject_course.idSubject = subject.idSubject
                                inner join course on course.idCourse = subject_course.idCourse
                                inner join groups on classrom.idGroup = groups.idGroup 
                                inner join topic on classrom.idTopic = topic.idTopic 
                                inner join user on classrom.idTeacherCreator = user.idUser
                               	where course.actualCourse = 1);

CREATE VIEW ViewStudentsStats AS (SELECT COUNT(subquery.idClass) AS asistanceClass, subquery.idUser, subquery.userName, subquery.userSurname,subquery.mail,subquery.indentificationNumber,subquery.dni,subquery.subjectName, subquery.idSubject, subquery.idCourse, subquery.courseName,SUM(subquery.studentBaned)AS numberBaned FROM (SELECT user.idUser, user.userName, user.userSurname, user.mail,user.indentificationNumber, user.dni,student_class.studentBaned, subject.subjectName, course.courseName, classrom.idClass, course.idCourse,subject.idSubject 
									FROM user 
									INNER JOIN student_class ON student_class.idStudent = user.idUser
									INNER JOIN classrom ON classrom.idClass = student_class.idClass
									INNER JOIN subject_course ON subject_course.idSubjectCourse = classrom.idSubjectCourse
									INNER JOIN subject ON subject.idSubject = subject_course.idSubject
									INNER JOIN course ON course.idCourse = subject_course.idCourse)AS subquery GROUP BY (subquery.idUser));

CREATE VIEW ViewStudentAssignment AS (SELECT 
        student_registered.idStudentRegistered, 
        user.indentificationNumber, user.userName, user.userSurname, user.dni, user.idUser,
        subject.idSubject, subject.subjectName,
        course.idCourse, course.courseName
FROM student_registered
INNER JOIN user ON user.idUser = student_registered.idStudent
INNER JOIN subject_course ON subject_course.idSubjectCourse = student_registered.idSubject
INNER JOIN subject ON subject.idSubject = student_registered.idSubject
INNER JOIN course ON course.idCourse = subject_course.idCourse);

CREATE VIEW ViewTeacherAssignment AS (SELECT 
        teacher_subject.idTeacherSubject, 
        user.indentificationNumber, user.userName, user.userSurname, user.dni, user.idUser,
        subject.idSubject, subject.subjectName,
        course.idCourse, course.courseName
FROM teacher_subject
INNER JOIN user ON user.idUser = teacher_subject.idTeacher
INNER JOIN subject_course ON subject_course.idSubjectCourse = teacher_subject.idSubject
INNER JOIN subject ON subject.idSubject = teacher_subject.idSubject
INNER JOIN course ON course.idCourse = subject_course.idCourse);

CREATE VIEW ViewSubjectAssignment AS (SELECT 
        subject_course.idSubjectCourse, 
        subject.idSubject, subject.subjectName,
        course.idCourse, course.courseName
FROM subject_course
INNER JOIN subject ON subject.idSubject = subject_course.idSubject
INNER JOIN course ON course.idCourse = subject_course.idCourse);



INSERT INTO bdAppWeb.role(roleName) VALUES("Admin"),('Profesor'),("Alumno");

INSERT INTO bdAppWeb.user(idRole,userName,userSurname,mail,pass,dni,indentificationNumber,loginNumber) 
VALUES(1,"Admin","Admin","Admin@Admin.com", "03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4",'000000000' ,'aa0001' ,0),
	  (2,"Profesor","Profesor","Profesor@Profesor.com", "03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4",'000000001','aa0002' ,0),
	  (3,"Alumno","Alumno","Alumno@Alumno.com", "03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4", '000000002' ,'aa0003' ,0);

INSERT INTO bdAppWeb.course (idCourse,courseName,actualCourse) VALUES(1,"Todos",0),(2,"2019/2020",1);

INSERT INTO bdAppWeb.subject(idSubject,idCreator,subjectName,creditsNumber,semester,subjectType) 
VALUES(1,1,"Bases de datos","9", "3º",'obligatoria'),
		(2,1,"Programacion","6", "1º",'obligatoria'),
		(3,1,"Redes de computadores","6", "5º",'obligatoria'),
		(4,1,"Estructura de datos","6", "2º",'obligatoria'),
		(5,1,"Fundamentos de ingeniería de software","9", "4º",'obligatoria'),
		(6,1,"Algorítmica","6", "3º",'obligatoria');
		
INSERT INTO bdAppWeb.subject_course(idSubject,idCourse) VALUES (1,2),(2,2),(3,2),(4,2),(5,2),(6,2);
INSERT INTO bdAppWeb.student_registered(idStudentRegistered,idStudent,idSubject)
VALUES(1,3,1),
		(2,3,2),
		(3,3,4),
		(4,3,5),
		(5,3,6);



/*,
(2,"Nombre 2","Apellido 2","mail 2", "pass 2", 1),
(3,"Nombre 3","Apellido 3","mail 3", "pass 3", 1);

INSERT INTO bdAppWeb.admins(idUser,numIdenti) VALUES(1,"12345");
INSERT INTO bdAppWeb.profesores(idUser,idCreator,numIdenti) VALUES(2,1,"12345");
INSERT INTO bdAppWeb.alumno(idUser,numMat) VALUES(3,"12345");

INSERT INTO bdAppWeb.subject(id_admin, subjectName, semestre, tipo, courseAcademico)  VALUES (1,"Asignatura",'5','Oblg','2019-2020');

INSERT INTO  bdAppWeb.degree(nombreGrado)  VALUES ("Ingenieria de softwarte");

INSERT INTO  bdAppWeb.topic(idSubject,topicName,descripciontopic)VALUES(1,"Tema  1","descripcion del tema  1");

INSERT INTO  bdAppWeb.classrom(idSubject,idTeacherCreator,codAcc, grupo)VALUES(1,1,"1234","GM67");

INSERT INTO bdAppWeb.ask(idTopic, idClass, askContenido)VALUES(1,1,"Esta es la pregunta?");

INSERT INTO `bdAppWeb`.`alumno_ask` (`id_ask_alumno`, `idStudent`, `id_pregunta`) VALUES ('1', '1', '1');

INSERT INTO `bdAppWeb`.`student_class` (`id_student_class`, `idStudent`, `idClass`) VALUES ('1', '1', '1');

INSERT INTO `bdAppWeb`.`student_registered` (`idStudentRegistered`, `idStudent`, `idSubject`) VALUES ('1', '1', '1');

INSERT INTO `bdAppWeb`.`alumno_turno` (`idStudent_turno`, `idStudent`, `idClass`) VALUES ('1', '1', '1');

INSERT INTO `bdAppWeb`.`subject_en_degree` (`idSubject_grado`, `idDegree`, `idSubject`) VALUES ('1', '1', '1');

INSERT INTO `bdAppWeb`.`teacher_subject` (`idTeacherSubject`, `idTeacheres`, `idSubject`) VALUES ('1', '1', '1');

INSERT INTO `bdAppWeb`.`profesores_class` (`idTeacheres_class`, `idTeacheres`, `idClass`) VALUES ('1', '1', '1');*/









