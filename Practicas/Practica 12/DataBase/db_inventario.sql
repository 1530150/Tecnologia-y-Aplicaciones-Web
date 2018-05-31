DROP DATABASE IF EXISTS db_inventario;
CREATE DATABASE IF NOT EXISTS db_inventario;
USE db_inventario;

CREATE TABLE usuarios(
	id int AUTO_INCREMENT,
	nombre varchar(50),
	apellido varchar(50),
	nombre_usuario varchar(30),
	password varchar(50),
	correo varchar(30),
	fecha_registro date,
	PRIMARY KEY(id)
);

CREATE TABLE categorias(
	id int AUTO_INCREMENT,
	nombre varchar(50),
	descripcion varchar(300),
	fecha_agregado date,
	PRIMARY KEY(id)
);

CREATE TABLE productos(
	id int AUTO_INCREMENT,
	codigo varchar(20),
	nombre varchar(50),
	fecha_agregado date,
	precio int,
	stock int,
	categoria int,
	PRIMARY KEY(id),
	FOREIGN KEY(categoria) REFERENCES categorias(id)
);

CREATE TABLE historiales(
	id int AUTO_INCREMENT,
	producto int,
	usuario int,
	fecha date,
	nota varchar(300),
	referencia varchar(100),
	cantidad int,
	PRIMARY KEY(id),
	FOREIGN KEY(usuario) REFERENCES usuarios(id),
	FOREIGN KEY(producto) REFERENCES productos(id)
);
