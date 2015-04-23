drop table USER_CONTENT;
drop table USER_TABLE;

create table USER_TABLE(
  ID int not null auto_increment,
  EMAIL varchar(64) not null,
  PASSWORD varchar(64) not null,
  ADMIN bool,
  primary key (ID)
  );
  
  
insert into USER_TABLE (EMAIL, PASSWORD, ADMIN) value('admin', md5('1234'), true);
insert into USER_TABLE (EMAIL, PASSWORD, ADMIN) value('user1@domain.com', md5('1111'), false);
insert into USER_TABLE (EMAIL, PASSWORD, ADMIN) value('user2@domain.com', md5('2222'), false);
insert into USER_TABLE (EMAIL, PASSWORD, ADMIN) value('user3@domain.com', md5('3333'), false);


create table USER_CONTENT(
  USER_FK int not null,
  ID int not null auto_increment, 
  DESCRIPTION varchar(64) not null,
  USERNAME varchar(64),
  URL varchar(256),
  primary key (ID, USER_FK),
  foreign key (USER_FK)
    references USER_TABLE(ID)
	on update cascade
	on delete cascade
  );
