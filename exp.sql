create table expenses(exp_id mediumint not null auto_increment,
                      exp_amount float(12,2) not null,
                      merchant_address varchar(2000) not null, 
                      exp_date date not null,
                      exp_desc varchar(2000) ,
                      exp_type varchar(10),
                      cycle_id mediumint,
                      exp_tag varchar(10),
                      cat_id mediumint,
                      user_id mediumint,
                      
                      primary key (exp_id));
					  
alter table exp add billing_year varchar(20);					  