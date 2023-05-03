create or replace table tbl_user (
    usid int not null PRIMARY KEY AUTO_INCREMENT,
    full_name varchar(300),
    user_name varchar(30), 
    user_password varchar(30),
    role_id int,
    depart_id int,
    br_id int,
    user_status int,
    add_by int,
    date_register date
);


create table tbl_role_level(
    rl_id int not null PRIMARY KEY AUTO_INCREMENT,
    rl_name varchar(90)
);

 