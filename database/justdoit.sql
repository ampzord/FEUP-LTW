** This file contains an SQLite 2.1 database ** (u��        �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      �       �       table User User 7 CREATE TABLE User (
  id INTEGER PRIMARY KEY,
  username TEXT UNIQUE,
  email TEXT UNIQUE,
  phoneNumber INTEGER UNIQUE,
  country TEXT UNIQUE,
  timeZone INTEGER, --UTC Offset
  fullName TEXT NOT NULL,        <  & �  $&&index (User autoindex 1) User 3        t  & �  $&&index (User autoindex 2) User 4        �  & �  $&&index (User autoindex 3) User 5        �  & �  $&&index (User autoindex 4) User 6        x  � �  �table Team Team 10 CREATE TABLE Team (
  id INTEGER PRIMARY KEY,
  name TEXT UNIQUE,
  idUser INTEGER REFERENCES User(id)
)        �  & �  $&&index (Team autoindex 1) Team 9        D  � �  �table List List 12 CREATE TABLE List
(
  id INTEGER PRIMARY KEY,
  name TEXT UNIQUE,
  idGroup INTEGER REFERENCES Team(id)
)       |  ' �  	$''index (List autoindex 1) List 11           n �  
ntable Task Task 13 CREATE TABLE Task
(
  id INTEGER PRIMARY KEY,
  idList INTEGER REFERENCES List(id)
)                        cadmin �   �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               a �   ��                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   a �   ��                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   a �   ��                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       4           �  

admin Malaquias a �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
  birthDate DATE,
  passwordHash TEXT NOT NULL
)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      