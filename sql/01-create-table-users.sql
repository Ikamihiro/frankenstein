create table users (
   id int primary key auto_increment,
   email varchar(250) not null,
   password varchar(100) not null,
   role varchar(80) not null
);