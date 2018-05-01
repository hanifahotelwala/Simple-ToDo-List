DROP DATABASE IF EXISTS todo;

CREATE DATABASE todo;

USE todo; 

CREATE TABLE todoList (

    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    task varchar(255) NOT NULL, 
    deadline DATE NOT NULL,
    priority VARCHAR(10) NOT NULL
);