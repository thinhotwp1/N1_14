database
create database cart

create table products(
    id int primary key auto_increment,
    title varchar(250),
    thumbnail varchar(550),
    content longtext,
    price float,
    create_at datetime,
    updated_at datetime
);

create table orders (
    id int primary key auto_increment,
    fullname varchar(50),
    phone_number varchar(150),
    email varchar(200),
    address varchar(200),
    order_date datetime

);

create table order_details(
    id int primary key aotu_increment,
    order_id int references orders (id),
    product_id int references products (id),
    num int,
    price float
)
INSERT INTO products(title,thumbnail,price)
VALUES ("Viper","https://i.pinimg.com/564x/76/de/52/76de524a984e6a56fb26a7f0bb6a44e7.jpg",20000);
("Viper","https://i.pinimg.com/564x/76/de/52/76de524a984e6a56fb26a7f0bb6a44e7.jpg",20000);
("Viper","https://i.pinimg.com/564x/76/de/52/76de524a984e6a56fb26a7f0bb6a44e7.jpg",20000);
("Viper","https://i.pinimg.com/564x/76/de/52/76de524a984e6a56fb26a7f0bb6a44e7.jpg",20000);
("Viper","https://i.pinimg.com/564x/76/de/52/76de524a984e6a56fb26a7f0bb6a44e7.jpg",20000);
("Viper","https://i.pinimg.com/564x/76/de/52/76de524a984e6a56fb26a7f0bb6a44e7.jpg",20000);
("Viper","https://i.pinimg.com/564x/76/de/52/76de524a984e6a56fb26a7f0bb6a44e7.jpg",20000);

b2. Cau truc

- database
    - config.php
    - dbhelper.php
- untils
    - utility.php

b3. Phat trien chuc nang

1, products.php
2. detals.php
3. cart.php
-> cart[
    {
        'id':1,
        'num':3
    },{
        'id':3,
        'num':1
    }
    ]
]

