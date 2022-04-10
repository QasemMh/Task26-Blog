-- Blog Tables
CREATE DATABASE task26_blog;
use task26_blog;

-- category
CREATE TABLE category(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL
);
-- role
create table role(
id INT(11) PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(60) NOT NULL
);

-- users
CREATE TABLE users(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    username VARCHAR(60) NOT NULL UNIQUE,
    email VARCHAR(60) UNIQUE,
    password VARCHAR(60) NOT NULL,
    role_id int(11) not null,
    createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
     FOREIGN KEY(role_id) REFERENCES role(id)
);
    
    -- post
CREATE TABLE post(
     id INT(11) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
   content TEXT NOT NULL,
   path varchar(255) not null,
        createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
        author_id INT(11) NOT NULL, 
        category_id INT(11) NOT NULL,
        FOREIGN KEY(author_id) REFERENCES users(id), 
        FOREIGN KEY(category_id) REFERENCES category(id));

-- post_comment
CREATE TABLE post_comment(
            id INT(11) PRIMARY KEY AUTO_INCREMENT,
            content TEXT NOT NULL,
            name VARCHAR(60) NOT NULL,
            email VARCHAR(60) NOT NULL,
            post_id INT(11) NOT NULL,
            createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
             FOREIGN KEY(post_id) REFERENCES post(id));


-- Admin dashboard Table:
use task26_blog;

CREATE TABLE aboutUs(
id int(11) PRIMARY KEY AUTO_INCREMENT,
title varchar(250) not null,
content text not null,
path varchar(255) not null
);

CREATE TABLE home(
id int(11) PRIMARY KEY AUTO_INCREMENT,
tap_title varchar(50) not null,
logo_name varchar(50) not null,
facebook_url varchar(255) not null,
insta_url varchar(255) not null,
twitter_url varchar(255) not null
);

CREATE TABLE concat(
id int(11) PRIMARY KEY AUTO_INCREMENT,
phone varchar(14) not null,
email varchar(150) not null,
location varchar(50) not null,
map_url varchar(500) not null
);


-- user message 
create table user_message(
id int(11) PRIMARY KEY AUTO_INCREMENT,
name varchar(60) not null,
email varchar(100) not null,
subject varchar(60) not null,
message text not null
);

