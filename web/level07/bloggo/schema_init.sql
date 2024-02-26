DROP DATABASE IF EXISTS bloggo;
CREATE DATABASE bloggo;
DROP TABLE IF EXISTS bloggo.users;
CREATE TABLE bloggo.users (
        username VARCHAR(128) NOT NULL UNIQUE PRIMARY KEY,
        password VARCHAR(128) NOT NULL,
        firstname VARCHAR(128) NOT NULL,
        lastname VARCHAR(128) NOT NULL,
        email VARCHAR(128) NOT NULL,
        cookie VARCHAR(128) DEFAULT NULL);

DROP TABLE IF EXISTS bloggo.blogs;
CREATE TABLE bloggo.blogs (
        owner VARCHAR(128) NOT NULL,
        blogname VARCHAR(128) NOT NULL UNIQUE PRIMARY KEY,
        password VARCHAR(128) NOT NULL);

DROP TABLE IF EXISTS bloggo.entries;
CREATE TABLE bloggo.entries (
        id INT UNSIGNED AUTO_INCREMENT NOT NULL UNIQUE PRIMARY KEY,
        author VARCHAR(128) DEFAULT NULL,
        blogname VARCHAR(128) NOT NULL,
        title VARCHAR(128) NOT NULL,
        keywords VARCHAR(128) NOT NULL,
        entry TEXT(32768) NOT NULL,
	shared INT DEFAULT 0) ENGINE=MyISAM;

ALTER TABLE bloggo.entries ADD FULLTEXT(keywords);

