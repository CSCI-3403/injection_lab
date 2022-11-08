CREATE DATABASE mydb;

USE mydb;
CREATE TABLE users (username TEXT, password TEXT, UNIQUE(username));
INSERT INTO users VALUES ('admin', 'sup3r_s3cr3t!!!');

CREATE TABLE ccs (number BIGINT, code INT, exp TEXT);
INSERT INTO ccs VALUES (4263982640269299, 837, '02/2023');

CREATE USER db_service@localhost IDENTIFIED BY 'dbservicepassword';
GRANT SELECT,FILE ON *.* to 'db_service'@'localhost';