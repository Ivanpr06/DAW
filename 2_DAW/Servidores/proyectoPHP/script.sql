create table serie (
	id int(10) auto_increment primary key,
	idApi int,
	original_name varchar(225),
	overview text,
	popularity float,
	poster_path varchar(225),
	first_air_date date,
	name varchar(225),
	vote_average float,
	vote_count int
);


CREATE TABLE serie_genero (
	id int(10) auto_increment primary key,
    serie_id INT,
    genero_id INT,
    constraint fk_serie_genero_serie FOREIGN KEY (serie_id) REFERENCES serie(id),
    constraint fk_serie_genero_genero FOREIGN KEY (genero_id) REFERENCES genero(id)
);

create table genero(
	id int(10) auto_increment primary key,
	id_api int,
	name varchar(225)
);

create table usuario(
	id int(10) auto_increment primary key,
	nombre varchar(225),
	correo varchar(225),
	contrasena varchar(225),
	imagen varchar(225),
	rol VARCHAR(255)
);

ALTER TABLE usuario
MODIFY rol JSON;


create table valoracion(
	id int(10) auto_increment primary key,
	id_usuario int,
	id_serie int,
	nota float,
	fecha date,
	comentario text,
	constraint fk_valoracion_serie foreign key (id_serie) references serie(id),
	constraint fk_valoracion_usuario foreign key (id_usuario) references usuario(id)
);

create table categoria(
	id int(10) auto_increment primary key,
	nombre varchar(225),
	descripcion varchar(225),
	imagen varchar(225)
);

create table ranking(
	id int(10) auto_increment primary key,
	id_usuario int(10),
	id_categoria int(10),
	constraint fk_ranking_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id),
	constraint fk_ranking_categoria FOREIGN KEY (id_categoria) REFERENCES categoria(id)
);


create table ranking_serie(
	id int(10) auto_increment primary key,
	id_serie int(10),
	id_ranking int(10),
	position VARCHAR(10),
    constraint fk_ranking_serie_serie foreign key (id_serie) references serie(id),
    constraint fk_ranking_serie_ranking foreign key (id_ranking) references ranking(id)
);



create table serie_categoria(
	id int(10) auto_increment primary key,
	id_serie int(10),
	id_categoria int(10),
    constraint fk_serie_categoria_serie foreign key (id_serie) references serie(id),
    constraint fk_serie_categoria_categoria foreign key (id_categoria) references categoria(id)
);