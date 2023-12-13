-- PostgreSQL

DROP DATABASE crud_demo;

CREATE DATABASE crud_demo;

\connect crud_demo

CREATE TABLE users
(
    "id" serial,
    "name" text NOT NULL,
    "email" text NOT NULL,
    "role" varchar(20) NOT NULL,
    CHECK
        ( role IN ('Reader', 'Editor', 'Administrator')
        ),
    PRIMARY KEY (id)
);

INSERT INTO users (name, email, role)
    VALUES ('John Do', 'john@email.com', 'Administrator');
