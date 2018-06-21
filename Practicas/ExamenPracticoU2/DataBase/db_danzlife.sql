DROP DATABASE IF EXISTS db_danzlife;
CREATE DATABASE db_danzlife;
USE db_danzlife;

CREATE TABLE alumnas(
	id int AUTO_INCREMENT,
	nombre varchar(100),
	apellido varchar(100),
	fecha_nacimiento varchar(30),
	grupo int,
	PRIMARY KEY(id)
);

CREATE TABLE grupos(
	id int AUTO_INCREMENT,
	nombre varchar(50),
	PRIMARY KEY(id)
);

CREATE TABLE pagos(
	id int AUTO_INCREMENT,
	grupo int,
	alumna int,
	nombre_mama varchar(100),
	apellido_mama varchar(100),
	fecha_pago varchar(30),
	folio varchar(10),
	imagen_folio varchar(300),
	PRIMARY KEY(id),
	FOREIGN KEY(alumna) REFERENCES alumnas(id),
	FOREIGN KEY(grupo) REFERENCES grupos(id)
);

CREATE TABLE usuarios(
	nombre varchar(20),
	password varchar(20),
	PRIMARY KEY(nombre)
);
