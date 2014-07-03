 create table exp_cards(card_id      mediumint not null auto_increment,
                        card_code    varchar(4) not null,
                        card_name    varchar(500) not null,
                        user_id      mediumint not null, 
                                     primary key (card_id));