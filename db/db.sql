

create or replace table tbl_issue_category (
    isc_id int not null PRIMARY KEY AUTO_INCREMENT,
    isc_name varchar(50)
);

create or replace table tbl_issue_type(
    ist_id int not null PRIMARY KEY AUTO_INCREMENT,
    isc_id int,
    ist_name varchar(150)
);

create or replace table tbl_issue_status (
    is_id int not null PRIMARY KEY AUTO_INCREMENT,
    is_name varchar(300)
);

create or replace table tbl_issue_request(
    ir_id int not null PRIMARY KEY AUTO_INCREMENT,
    ist_id int,
    ir_state int,
    ir_detail text,
    reqeust_by int,
    request_date date,
    assign_by int,
    assign_date date,
    rate_point int
);

create or replace table tbl_issue_history(
    ih_id int not null PRIMARY KEY AUTO_INCREMENT,
    ir_id int,
    ir_state int,
    ih_detail text,
    update_by int,
    update_date date
);

create or replace table tbl_request_email(
 re_id int not null PRIMARY KEY AUTO_INCREMENT,
 user_id int,
 user_email varchar(100),
 pass_email varchar(30),
 date_request date,
 update_by int,
 date_update date 
);

create or replace table tbl_item_data(
    item_id int not null PRIMARY KEY AUTO_INCREMENT,
    item_name varchar(300)
);

create or replace table tbl_request_status(
    rs_id int not null PRIMARY KEY AUTO_INCREMENT,
    rs_name varchar(150)
);

create or replace table tbl_request_use_item(
    rui_id int not null PRIMARY KEY AUTO_INCREMENT, 
    rs_id int,
    depart_id int,
    request_by int,
    reqeust_date date
);

create or replace table tbl_request_use_item_detail(
    riud_id int not null PRIMARY KEY AUTO_INCREMENT,
    rui_id int,
    item_id int,
    item_value int
);



