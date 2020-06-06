CREATE TABLE usuario(
		email_usuario VARCHAR(50) primary key,
    cpf_usuario VARCHAR(100) NOT NULL,
    nome_usuario VARCHAR(14) NOT NULL,
    nivel_usuario INT NOT NULL
);

CREATE TABLE doacoes(
		id_doacoes INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		email_usuario VARCHAR(11),
		valor_doacoes FLOAT,
		tipo_doacoes VARCHAR(20),
    foreign key (email_usuario) references usuario(email_usuario)
);

CREATE TABLE gastos(
		id_gastos INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    valor_gastos FLOAT,
		data_gastos VARCHAR(12) NOT NULL,
    tipo_gastos VARCHAR(30) NOT NULL
);
