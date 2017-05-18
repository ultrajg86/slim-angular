CREATE DATABASE boardt;

USE boardt;

CREATE TABLE users(
idx INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
user_id VARCHAR(12) NOT NULL DEFAULT '' COMMENT '아이디',
user_name VARCHAR(20) NOT NULL DEFAULT '' COMMENT '이름',
user_pwd VARCHAR(50) NOT NULL DEFAULT '' COMMENT '비밀번호',
user_perm INT NOT NULL DEFAULT '0' COMMENT '권한',
reg_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '가입일',
PRIMARY KEY (idx),
UNIQUE KEY(user_id)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='회원정보';

CREATE TABLE users_token(
idx INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
users_idx INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '회원 idx',
user_token TEXT NOT NULL DEFAULT '' COMMENT '토큰',
expire_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '만기일',
PRIMARY KEY (idx),
UNIQUE KEY(users_idx)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='회원정보 - 토큰';

CREATE TABLE board(
idx INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK',
users_idx INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '회원 pk',
title VARCHAR(100) NOT NULL DEFAULT '' COMMENT '제목',
contents TEXT NOT NULL DEFAULT '' COMMENT '내용',
reg_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일',
PRIMARY KEY (idx)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8 COMMENT='게시판';