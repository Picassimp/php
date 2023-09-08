--tạo database

create database if not exists MD17306;

use MD17306;

create table if not exists users  (
	id INT PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(50) NOT NULL UNIQUE,
	name VARCHAR(50) NOT NULL,
	password VARCHAR(500) NOT NULL,
	verified BIT DEFAULT 0
);
insert into users (id, email, name, password) values (1, 'Pace', 'Smoth', 'psmoth0@amazon.com');
insert into users (id, email, name, password) values (2, 'Malory', 'Riba', 'mriba1@instagram.com');
insert into users (id, email, name, password) values (3, 'Gretna', 'Fanshaw', 'gfanshaw2@networkadvertising.org');
insert into users (id, email, name, password) values (4, 'Aubrey', 'Gossart', 'agossart3@i2i.jp');
insert into users (id, email, name, password) values (5, 'Clotilda', 'Angel', 'cangel4@linkedin.com');

create table if not exists reset_password (
	id INT PRIMARY KEY AUTO_INCREMENT,
	token VARCHAR(50) NOT NULL,
	timeCreated DATETIME NOT NULL DEFAULT now(),
	email VARCHAR(50) NOT NULL,
	avaiable BIT DEFAULT 1
);

create table if not exists categories (
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	image VARCHAR(200) NOT NULL
);

insert into categories (id, name, image) values (1, 'Laptop', 'https://laptoptcc.com/wp-content/uploads/2023/01/SURFACE-LAPTOP-GO-LAPTOP-TCC.png');
insert into categories (id, name, image) values (2, 'GPU', 'https://cdn.tgdd.vn/hoi-dap/630675/gpu-chip-do-hoa-smartphone-9-800x417.jpg');
insert into categories (id, name, image) values (3, 'CPU', 'https://cdn.tgdd.vn/hoi-dap/1299483/toc-do-cpu-la-gi-co-y-nghia-gi-trong-cac-thiet-bi-dien-tu1-800x450.jpg');

create table if not exists products (
	 id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(50) NOT NULL,
    description VARCHAR(50) NOT NULL,
    quantity INT NOT NULL,
    categoryId INT NOT NULL,
    FOREIGN KEY (categoryId) REFERENCES categories(id)
);

insert into products (id, name, price, image, description, quantity, categoryId) 
values (1, 'Điện thoại 1', 1000, 'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg', 'Điện thoại 1', 10, 1);
insert into products (id, name, price, image, description, quantity, categoryId)
values (2, 'Điện thoại 2', 2000, 'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg', 'Điện thoại 2', 20, 2);
insert into products (id, name, price, image, description, quantity, categoryId)
values (3, 'Điện thoại 3', 3000, 'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg', 'Điện thoại 3', 30, 3);