CREATE TABLE tb_show (
id_show		INTEGER NOT NULL AUTO_INCREMENT,
nomeShow	VARCHAR(250),
localidade	VARCHAR(250),
descricao	VARCHAR(250),
capacidade	INTEGER,
CONSTRAINT pk_tb_show_id_show PRIMARY KEY (id_show)
);

CREATE TABLE tb_evento (
id_evento	INTEGER AUTO_INCREMENT,
id_show		INTEGER,
dt_evento	DATE,
horario		TIME,
preco		FLOAT,
CONSTRAINT pk_tb_evento_id_evento PRIMARY KEY (id_evento),
CONSTRAINT fk_tb_evento_id_show FOREIGN KEY (id_show)
            REFERENCES tb_show (id_show)
);

CREATE TABLE tb_venda (
id_venda	INTEGER AUTO_INCREMENT,
id_evento	INTEGER,
qtde_inteira	INTEGER,
qtde_meia	INTEGER,
CONSTRAINT pk_tb_venda_id_evento PRIMARY KEY (id_venda),
CONSTRAINT fk_tb_venda_id_show FOREIGN KEY (id_evento)
            REFERENCES tb_evento (id_evento)
);


Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, tenetur.