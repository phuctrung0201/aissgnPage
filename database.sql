create database assign_page;
use assign_page;
create table users (
	id int unsigned auto_increment  not null primary key ,
    usern varchar(50) not null unique,
    passw varchar(50) not null,
    role enum('admin','user') not null default 'user'
) engine = InnoDB;
create table lists (
	id int unsigned auto_increment  not null primary key ,
    listn varchar(50) not null,
    userid int unsigned not null,
    state enum('close','open','in process','solved') not null default 'close',
    foreign key (userid) references users(id) on delete cascade
) engine = InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;
create table tasks (
	id int unsigned auto_increment  not null primary key ,
    task varchar(250) not null,
    listid int unsigned not null,
    foreign key (listid) references lists(id) on delete cascade
);
insert into users(usern,passw,role) values ('mygalaxy2712','nopass123','admin');
