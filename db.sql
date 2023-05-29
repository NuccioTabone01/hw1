use hw1;

CREATE TABLE users (
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null
) Engine = InnoDB;

CREATE TABLE posts (
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    firstName varchar(255) not null unique,
    lastName varchar(255) not null,
    commentText varchar(255) ,
    nlikes int,
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) Engine = InnoDB;
