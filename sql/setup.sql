CREATE TABLE IF NOT EXISTS tbsetor (
	setid SERIAL,
	setdescricao TEXT,
	CONSTRAINT pk_tbsetor PRIMARY KEY (setid)
);

CREATE TABLE IF NOT EXISTS tbpergunta (
	perid SERIAL,
	perdescricao TEXT,
	perobrigatoria SMALLINT CHECK (perativa IN (0, 1)) DEFAULT 0,
	perativa SMALLINT CHECK (perativa IN (0, 1)) DEFAULT 0,
	CONSTRAINT pk_tbpergunta PRIMARY KEY (perid)
);

CREATE TABLE IF NOT EXISTS tbdispositivo (
	disid SERIAL,
	disdescricao TEXT,
	CONSTRAINT pk_tbdispositivo PRIMARY KEY (disid)
);

CREATE TABLE IF NOT EXISTS tbavaliacao (
	avaid SERIAL NOT NULL,
	setid INTEGER NOT NULL,
	disid INTEGER NOT NULL,
	avaresposta SMALLINT NOT NULL,
	avadescricao TEXT,
	avadatahora TIMESTAMP NOT NULL,
	CONSTRAINT pk_tbavaliacao PRIMARY KEY (avaid),
	CONSTRAINT fk_tbavaliacao_tbsetor FOREIGN KEY (setid) REFERENCES tbsetor(setid),
	CONSTRAINT fk_tbavaliacao_tbdispositivo FOREIGN KEY (disid) REFERENCES tbdispositivo(disid)
);

CREATE TABLE IF NOT EXISTS tbavaliacaopergunta (
	avaid INTEGER NOT NULL,
	perid INTEGER NOT NULL,
	avpresposta TEXT,
	CONSTRAINT fpk_tbavaliacaopergunta PRIMARY KEY (avaid, perid)
);

CREATE TABLE IF NOT EXISTS tbusuario (
	usuid SERIAL NOT NULL,
	usuusername TEXT NOT NULL,
	ususenha TEXT NOT NULL,
	CONSTRAINT pk_tbusuario PRIMARY KEY (usuid)
);
