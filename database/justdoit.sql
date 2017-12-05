PRAGMA FOREIGN_KEYS = ON;
.mode columns
.headers on
.nullvalue NULL

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Team;
DROP TABLE IF EXISTS List;
DROP TABLE IF EXISTS Task;

CREATE TABLE User (
  id INTEGER PRIMARY KEY,
  username TEXT UNIQUE,
  email TEXT UNIQUE,
  phoneNumber INTEGER UNIQUE,
  country TEXT UNIQUE,
  timeZone INTEGER, --UTC Offset
  fullName TEXT,
  birthDate DATE,
  passwordHash TEXT NOT NULL
);

CREATE TABLE Team (
  id INTEGER PRIMARY KEY,
  name TEXT UNIQUE,
  idUser INTEGER REFERENCES User(id)
);

CREATE TABLE List (
  id INTEGER PRIMARY KEY,
  name TEXT UNIQUE,
  idGroup INTEGER REFERENCES Team(id)
);

CREATE TABLE Task (
  id INTEGER PRIMARY KEY,
  idList INTEGER REFERENCES List(id)
);

-- Admin
INSERT INTO User(id, username, fullName, passwordHash) VALUES (1, "admin", "Malaquias","$2a$04$TDAv90bpsp2U2K010ZfC..zrxDQjGbiPEdMyVT9BiOeDlOT/NjMge");
