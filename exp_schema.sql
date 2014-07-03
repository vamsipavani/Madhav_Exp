create table users(user_id              mediumint not null auto_increment,
                   user_name            varchar(10) not null,
                   user_password        varchar(10) not null,
                   monthly_sal          float(12,2),
                   Billing_cycle        varchar(100),
                   Annual_saving_target float(15,2),
                                        primary key(user_id));
 
 create table exp_categories(cat_id      mediumint not null auto_increment,
                             cat_code    varchar(4) not null,
                             cat_meaning varchar(500) not null,
                                         primary key (cat_id));
  
create table user_exp_categories(user_exp_cat_id mediumint not null auto_increment, 
                                 user_id         mediumint not null, 
                                 cat_id          mediumint not null, 
                                                 primary key(user_exp_cat_id));
                                                    
create table projected_expenses(Proj_exp_id      mediumint not null auto_increment, 
                                 user_id         mediumint not null, 
                                 cat_id          mediumint not null, 
                                                 primary key(Proj_exp_id));

 create table exp_cards(card_id      mediumint not null auto_increment,
                        card_code    varchar(4) not null,
                        card_name    varchar(500) not null,
                        user_id      mediumint not null, 
                                     primary key (card_id));
                                     
create table exp_merchants(mer_id mediumint not null auto_increment,
                          mer_name varchar(2000) not null, 
                          mer_address varchar(2000) not null, 
                          cat_id  mediumint not null, 
                          primary key (mer_id));                                   

create table expenses(exp_id              mediumint not null auto_increment,
                      exp_amount          float(12,2) not null,
                      merchant_address    varchar(2000) not null, 
                      exp_date            date not null,
                      exp_desc            varchar(2000) ,
                      exp_type            varchar(10),
                      cycle_id            mediumint,
                      exp_tag             varchar(10),
                      cat_id              mediumint,
                      user_id             mediumint,
					  billing_year        varchar(20),
                                          primary key (exp_id));
										  
show tables;										  


insert into users(user_Id, user_name, user_password)
values( 1, 'data_admin', 'data_admin');

insert into exp_categories(cat_id, cat_code, cat_meaning)
values(1,'FOOD','Groceries');

insert into exp_categories(cat_id, cat_code, cat_meaning)
values(2,'FUEL','Gasoline');

insert into exp_categories(cat_id, cat_code, cat_meaning)
values(3,'MOVI','Entertainment');

insert into exp_categories(cat_id, cat_code, cat_meaning)
values(4,'IMMI','Immigration');

insert into exp_categories(cat_id, cat_code, cat_meaning)
values(5,'GOLF','Golf');

insert into exp_categories(cat_id, cat_code, cat_meaning)
values(7,'MEDI','Medical');

insert into exp_categories(cat_id, cat_code, cat_meaning)
values(8,'TRVL','Travel');

insert into exp_categories(cat_id, cat_code, cat_meaning)
values(9,'UNKN','Unknown');

insert into exp_categories(cat_id, cat_code, cat_meaning)
values(10,'MISC','Mmiscellaneous');

insert into user_exp_categories(user_id, cat_id)
values(1, 1);

insert into user_exp_categories(user_id, cat_id)
values(1, 2);

insert into user_exp_categories(user_id, cat_id)
values(1, 3);

insert into user_exp_categories(user_id, cat_id)
values(1, 4);

insert into user_exp_categories(user_id, cat_id)
values(1, 5);

insert into user_exp_categories(user_id, cat_id)
values(1, 6);

insert into user_exp_categories(user_id, cat_id)
values(1, 7);

insert into user_exp_categories(user_id, cat_id)
values(1, 8);

insert into user_exp_categories(user_id, cat_id)
values(1, 9);


insert into user_exp_categories(user_id, cat_id)
values(1, 10);
