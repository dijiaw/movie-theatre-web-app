create table movie 
(   
    movieid int unsigned not null auto_increment primary key,
    name char(50) not null,
    genre char(30) not null,
    length int unsigned not null,
    rating int unsigned not null,
    pgrating char(20) not null,
    status char(20) not null,
    language char(20) not null,
    releasedate char(20),
    director char(100) not null,
    cast TEXT not null,
    synopsis TEXT not null,
    poster char(50) not null,
    trailer char(100) not null 
);


create table showtime
(
    slotid int unsigned not null,
    movieid int unsigned not null,
    hall int unsigned not null,
    dateofshow char(20) not null,
    slot char(20) not null
);


create table member 
(
    memberid int unsigned not null auto_increment primary key,
    realname char(50) not null,
    username char(20) not null,
    email char(50) not null,
    password char(100) not null
);

create table booking 
(
    bookingid int unsigned not null auto_increment primary key,
    slotid int unsigned not null,
    memberid int unsigned,
    seats char(30) not null,
    bookingdate char(88) not null,
    reference int unsigned not null
);

create table ticket
(
    ticketpriceid int unsigned not null auto_increment primary key,
    ticketprice float(4,2) not null,
    dateinfo char(20) not null
);

create table feedback
(
    feedbackid int unsigned not null auto_increment primary key,
    customer char(50) not null,
    email char(50) not null,
    content TEXT not null
);