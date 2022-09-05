DROP SCHEMA IF EXISTS posse;

CREATE SCHEMA posse;

USE posse;

SET character_set_results=utf8mb4;
SET  character_set_connection=utf8mb4;
SET character_set_client=utf8mb4;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `tel` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `img` VARCHAR(255) NOT NULL,
    `img_path` VARCHAR(255) NOT NULL
);

INSERT INTO
    `users` (
        `name`,
        `email`,
        `tel`,
        `password`,
        `img`,
        `img_path`
    )
VALUES
    (
        '多田一稀',
        'kazkaz.t@icloud.com',
        '09037119259',
        sha1('password'),
        '浜辺美波.jpeg',
        'img/test'
    );

DROP TABLE IF EXISTS rooms;

CREATE TABLE rooms (
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `img` VARCHAR(255) NOT NULL,
    `img_path` VARCHAR(255) NOT NULL,
    `limit` INT NOT NULL
);

INSERT INTO
    `rooms`
SET
    `name` = '横もく',
    `img` = '横もくB.jpeg',
    `img_path` = 'img/test',
    `limit` = 5;

DROP TABLE IF EXISTS users_rooms;

CREATE TABLE users_rooms (
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `user_id` INT NOT NULL,
    `room_id` INT NOT NULL
);

INSERT INTO
    `users_rooms`
SET
    `user_id` = 1,
    `room_id` = 1;

DROP TABLE IF EXISTS chats;

CREATE TABLE chats (
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `content` VARCHAR(255) NOT NULL,
    `user_id` INT NOT NULL,
    `room_id` INT NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `changed_at` DATETIME,
    `deleted_at` DATETIME
);

INSERT INTO
    `chats`
SET
    `content` = 'ヤッホー',
    `user_id` = 1,
    `room_id` = 1;