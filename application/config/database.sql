DROP SCHEMA IF EXISTS bob;
CREATE SCHEMA IF NOT EXISTS bob;
USE bob;

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
	user_id           INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	user_givenname    VARCHAR(255) ,
	user_familyname   VARCHAR(255) ,
	user_email        VARCHAR(255) ,
	user_password     CHAR(64),  -- Hash-code van 64 tekens
	user_gender       ENUM('m','f'),
	user_weight       FLOAT        ,
	user_lastloginid  CHAR(32) UNIQUE
);