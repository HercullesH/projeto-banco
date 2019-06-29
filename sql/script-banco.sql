-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema biblioteca
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8 ;
USE `biblioteca` ;

-- -----------------------------------------------------
-- Table `biblioteca`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `endereco` VARCHAR(45) NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`aluno` (
  `id_usuario` INT NOT NULL,
  `curso` VARCHAR(45) NULL,
  `matricula` VARCHAR(45) NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_aluno_usuario1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_aluno_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `biblioteca`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`professor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`professor` (
  `id_usuario` INT NOT NULL,
  `siape` VARCHAR(45) NOT NULL,
  `lates` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_professor_usuario_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_professor_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `biblioteca`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`funcionario` (
  `id_usuario` INT NOT NULL,
  `siape` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_funcionario_usuario1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_funcionario_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `biblioteca`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`telefone_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`telefone_usuario` (
  `id_telefone` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(45) NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_telefone`),
  INDEX `fk_telefone_usuario_usuario1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_telefone_usuario_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `biblioteca`.`usuario` (`id_usuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`cargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`cargo` (
  `id_cargo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_cargo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`funcionario/cargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`funcionario_cargo` (
  `id_cargo` INT NOT NULL,
  `id_funcionario` INT NOT NULL,
  `data` DATE NULL,
  PRIMARY KEY (`id_cargo`, `id_funcionario`),
  INDEX `fk_table2_cargo1_idx` (`id_cargo` ASC),
  INDEX `fk_table2_funcionario1_idx` (`id_funcionario` ASC),
  CONSTRAINT `fk_table2_cargo1`
    FOREIGN KEY (`id_cargo`)
    REFERENCES `biblioteca`.`cargo` (`id_cargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_table2_funcionario1`
    FOREIGN KEY (`id_funcionario`)
    REFERENCES `biblioteca`.`funcionario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`area_conhecimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`area_conhecimento` (
  `id_area` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_area`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`titulo_livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`titulo_livro` (
  `isbn` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `edicao` VARCHAR(45) NOT NULL,
  `volume` VARCHAR(45) NOT NULL,
  `id_area` INT NOT NULL,
  PRIMARY KEY (`isbn`),
  INDEX `fk_titulo_livro_area_conhecimento1_idx` (`id_area` ASC),
  CONSTRAINT `fk_titulo_livro_area_conhecimento1`
    FOREIGN KEY (`id_area`)
    REFERENCES `biblioteca`.`area_conhecimento` (`id_area`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`exemplar_livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`exemplar_livro` (
  `id_exemplar` INT NOT NULL AUTO_INCREMENT,
  `qtd_exemplares` INT NOT NULL,
  `isbn_livro` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_exemplar`),
  INDEX `fk_exemplar_livro_titulo_livro1_idx` (`isbn_livro` ASC),
  CONSTRAINT `fk_exemplar_livro_titulo_livro1`
    FOREIGN KEY (`isbn_livro`)
    REFERENCES `biblioteca`.`titulo_livro` (`isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`emprestimo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`emprestimo` (
  `data_emprestimo` DATE NOT NULL,
  `data_devolucao` DATE NOT NULL,
  `id_usuario` INT NOT NULL,
  `id_exemplar` INT NOT NULL,
  PRIMARY KEY (`data_emprestimo`),
  INDEX `fk_emprestimo_usuario1_idx` (`id_usuario` ASC),
  INDEX `fk_emprestimo_exemplar_livro1_idx` (`id_exemplar` ASC),
  CONSTRAINT `fk_emprestimo_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `biblioteca`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_emprestimo_exemplar_livro1`
    FOREIGN KEY (`id_exemplar`)
    REFERENCES `biblioteca`.`exemplar_livro` (`id_exemplar`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`editora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`editora` (
  `id_editora` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `endereco` VARCHAR(45) NULL,
  PRIMARY KEY (`id_editora`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`telefone_editora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`telefone_editora` (
  `id_telefone` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(45) NOT NULL,
  `id_editora` INT NOT NULL,
  PRIMARY KEY (`id_telefone`, `id_editora`),
  INDEX `fk_telefone_editora_editora1_idx` (`id_editora` ASC),
  CONSTRAINT `fk_telefone_editora_editora1`
    FOREIGN KEY (`id_editora`)
    REFERENCES `biblioteca`.`editora` (`id_editora`)
    ON DELETE cascade
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`publicacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`publicacao` (
  `isbn_livro` VARCHAR(45) NOT NULL,
  `id_editora` INT NOT NULL,
  INDEX `fk_publicacao_titulo_livro1_idx` (`isbn_livro` ASC),
  INDEX `fk_publicacao_editora1_idx` (`id_editora` ASC),
  CONSTRAINT `fk_publicacao_titulo_livro1`
    FOREIGN KEY (`isbn_livro`)
    REFERENCES `biblioteca`.`titulo_livro` (`isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_publicacao_editora1`
    FOREIGN KEY (`id_editora`)
    REFERENCES `biblioteca`.`editora` (`id_editora`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`autor` (
  `id_autor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `endereco` VARCHAR(45) NULL,
  PRIMARY KEY (`id_autor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`telefone_autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`telefone_autor` (
  `id_telefone` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(45) NOT NULL,
  `id_autor` INT NOT NULL,
  PRIMARY KEY (`id_telefone`),
  INDEX `fk_telefone_autor_autor1_idx` (`id_autor` ASC),
  CONSTRAINT `fk_telefone_autor_autor1`
    FOREIGN KEY (`id_autor`)
    REFERENCES `biblioteca`.`autor` (`id_autor`)
    ON DELETE cascade
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`escrito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`escrito` (
  `id_autor` INT NOT NULL,
  `isbn_livro` VARCHAR(45) NOT NULL,
  INDEX `fk_escrito_autor1_idx` (`id_autor` ASC),
  INDEX `fk_escrito_titulo_livro1_idx` (`isbn_livro` ASC),
  CONSTRAINT `fk_escrito_autor1`
    FOREIGN KEY (`id_autor`)
    REFERENCES `biblioteca`.`autor` (`id_autor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_escrito_titulo_livro1`
    FOREIGN KEY (`isbn_livro`)
    REFERENCES `biblioteca`.`titulo_livro` (`isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`palavra_chave`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`palavra_chave` (
  `id_palavra` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_palavra`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`livro/palavra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`livro_palavra` (
  `isbn_livro` VARCHAR(45) NULL,
  `id_palavra` INT NOT NULL,
  INDEX `fk_livro/palavra_titulo_livro1_idx` (`isbn_livro` ASC),
  INDEX `fk_livro/palavra_palavra_chave1_idx` (`id_palavra` ASC),
  CONSTRAINT `fk_livro/palavra_titulo_livro1`
    FOREIGN KEY (`isbn_livro`)
    REFERENCES `biblioteca`.`titulo_livro` (`isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livro/palavra_palavra_chave1`
    FOREIGN KEY (`id_palavra`)
    REFERENCES `biblioteca`.`palavra_chave` (`id_palavra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Populando área de conhecimento
-- -----------------------------------------------------




insert into area_conhecimento(nome, descricao) 
values ('Ciências da saúde','Livros cujo temas principais são relacionados a saúde');

insert into area_conhecimento(nome, descricao)
values ('Ciências humanas','Livros cujo temas principais são relacionados a área de humanas (história, geografia, filosofia, etc');

insert into area_conhecimento(nome, descricao) 
values ('Ciências sociais aplicadas','Livros cujo temas principais são relacionados a aspectos sociais');

insert into area_conhecimento(nome, descricao) 
values ('Ciências exatas','Livros cujo temas principais são relacionados as areas exatas');

insert into area_conhecimento(nome, descricao) 
values ('Tecnologia da informação','Livros cujo temas principais são relacionados a area de T.I.');

insert into area_conhecimento(nome, descricao) 
values ('Linguística, Letras e Artes','Livros cujo temas principais são relacionados a literatura');


-- -----------------------------------------------------
-- Populando autores
-- -----------------------------------------------------


insert into autor (id_autor, nome, endereco) values (1, 'Bobby', '1 Raven Center');
insert into autor (id_autor, nome, endereco) values (2, 'Ethelyn', '18 Buena Vista Alley');
insert into autor (id_autor, nome, endereco) values (3, 'Marsh', '60 Delladonna Street');
insert into autor (id_autor, nome, endereco) values (4, 'Fabien', '121 Dunning Trail');
insert into autor (id_autor, nome, endereco) values (5, 'Vanny', '3 Knutson Drive');
insert into autor (id_autor, nome, endereco) values (6, 'Mel', '70 Redwing Alley');
insert into autor (id_autor, nome, endereco) values (7, 'Aubry', '1499 Northwestern Way');
insert into autor (id_autor, nome, endereco) values (8, 'Caresse', '55018 Surrey Drive');
insert into autor (id_autor, nome, endereco) values (9, 'Anatole', '29877 Rowland Road');
insert into autor (id_autor, nome, endereco) values (10, 'Bibby', '436 Summit Trail');
insert into autor (id_autor, nome, endereco) values (11, 'Lisa', '59 Loftsgordon Crossing');
insert into autor (id_autor, nome, endereco) values (12, 'Cordell', '1 Stone Corner Place');
insert into autor (id_autor, nome, endereco) values (13, 'Trina', '4 Bonner Plaza');
insert into autor (id_autor, nome, endereco) values (14, 'Dore', '14 Acker Crossing');
insert into autor (id_autor, nome, endereco) values (15, 'Floris', '31011 Maryland Drive');
insert into autor (id_autor, nome, endereco) values (16, 'Julie', '2 Division Trail');
insert into autor (id_autor, nome, endereco) values (17, 'Shalne', '6649 South Park');
insert into autor (id_autor, nome, endereco) values (18, 'Jilly', '21429 Monica Circle');
insert into autor (id_autor, nome, endereco) values (19, 'Dorie', '2949 Glendale Circle');
insert into autor (id_autor, nome, endereco) values (20, 'Octavia', '356 Walton Hill');


-- -----------------------------------------------------
-- Populando editoras
-- -----------------------------------------------------

insert into editora (id_editora, nome, endereco) values (1, 'White, Rice and Heidenreich', '145 Veith Hill');
insert into editora (id_editora, nome, endereco) values (2, 'Greenholt, Schaefer and Swaniawski', '1 Utah Road');
insert into editora (id_editora, nome, endereco) values (3, 'Maggio LLC', '27 Vera Center');
insert into editora (id_editora, nome, endereco) values (4, 'Lynch, Bechtelar and Cormier', '9 Dakota Park');
insert into editora (id_editora, nome, endereco) values (5, 'Flatley-Torphy', '0 Bartelt Point');
insert into editora (id_editora, nome, endereco) values (6, 'Torp, Hilpert and Funk', '665 Old Gate Way');
insert into editora (id_editora, nome, endereco) values (7, 'Rogahn Inc', '200 Lakeland Circle');
insert into editora (id_editora, nome, endereco) values (8, 'Turcotte-Herzog', '9221 Hansons Drive');
insert into editora (id_editora, nome, endereco) values (9, 'Huel, Hettinger and Boehm', '423 Killdeer Court');
insert into editora (id_editora, nome, endereco) values (10, 'Medhurst-Lynch', '625 Veith Trail');
insert into editora (id_editora, nome, endereco) values (11, 'Pfeffer-Cassin', '36804 Michigan Drive');
insert into editora (id_editora, nome, endereco) values (12, 'Yundt-Gulgowski', '29863 Larry Circle');
insert into editora (id_editora, nome, endereco) values (13, 'Waelchi Inc', '066 Oneill Plaza');
insert into editora (id_editora, nome, endereco) values (14, 'Quitzon-Herman', '51034 Norway Maple Avenue');
insert into editora (id_editora, nome, endereco) values (15, 'Batz-Olson', '5671 Sachtjen Court');
insert into editora (id_editora, nome, endereco) values (16, 'Bergstrom Group', '51403 Fieldstone Court');
insert into editora (id_editora, nome, endereco) values (17, 'Heaney, Dooley and Roberts', '8 Elka Alley');
insert into editora (id_editora, nome, endereco) values (18, 'Brakus and Sons', '69814 Onsgard Drive');
insert into editora (id_editora, nome, endereco) values (19, 'Langworth, Leffler and Davis', '83 Buell Junction');
insert into editora (id_editora, nome, endereco) values (20, 'Gutkowski-Nikolaus', '1 Iowa Way');


-- -----------------------------------------------------
-- Populando palavra chave
-- -----------------------------------------------------

insert into palavra_chave (id_palavra, descricao) values (1, 'emulation');
insert into palavra_chave (id_palavra, descricao) values (2, 'system-worthy');
insert into palavra_chave (id_palavra, descricao) values (3, 'directional');
insert into palavra_chave (id_palavra, descricao) values (4, 'Seamless');
insert into palavra_chave (id_palavra, descricao) values (5, 'coherent');
insert into palavra_chave (id_palavra, descricao) values (6, 'Universal');
insert into palavra_chave (id_palavra, descricao) values (7, 'Distributed');
insert into palavra_chave (id_palavra, descricao) values (8, 'multi-state');
insert into palavra_chave (id_palavra, descricao) values (9, 'hierarchy');
insert into palavra_chave (id_palavra, descricao) values (10, 'help-desk');
insert into palavra_chave (id_palavra, descricao) values (11, 'next generation');
insert into palavra_chave (id_palavra, descricao) values (12, 'Stand-alone');
insert into palavra_chave (id_palavra, descricao) values (13, 'challenge');
insert into palavra_chave (id_palavra, descricao) values (14, 'static');
insert into palavra_chave (id_palavra, descricao) values (15, 'holistic');
insert into palavra_chave (id_palavra, descricao) values (16, 'asynchronous');
insert into palavra_chave (id_palavra, descricao) values (17, 'scalable');
insert into palavra_chave (id_palavra, descricao) values (18, 'algorithm');
insert into palavra_chave (id_palavra, descricao) values (19, 'Upgradable');
insert into palavra_chave (id_palavra, descricao) values (20, 'Down-sized');
insert into palavra_chave (id_palavra, descricao) values (21, 'hardware');
insert into palavra_chave (id_palavra, descricao) values (22, 'infrastructure');
insert into palavra_chave (id_palavra, descricao) values (23, 'composite');
insert into palavra_chave (id_palavra, descricao) values (24, 'forecast');
insert into palavra_chave (id_palavra, descricao) values (25, 'systemic');
insert into palavra_chave (id_palavra, descricao) values (26, 'Balanced');
insert into palavra_chave (id_palavra, descricao) values (27, 'secondary');
insert into palavra_chave (id_palavra, descricao) values (28, 'Front-line');
insert into palavra_chave (id_palavra, descricao) values (29, 'scalable');
insert into palavra_chave (id_palavra, descricao) values (30, 'Automated');
insert into palavra_chave (id_palavra, descricao) values (31, 'Exclusive');
insert into palavra_chave (id_palavra, descricao) values (32, 'scalable');
insert into palavra_chave (id_palavra, descricao) values (33, 'Team-oriented');
insert into palavra_chave (id_palavra, descricao) values (34, 'portal');
insert into palavra_chave (id_palavra, descricao) values (35, 'hub');
insert into palavra_chave (id_palavra, descricao) values (36, 'knowledge base');
insert into palavra_chave (id_palavra, descricao) values (37, 'Fundamental');
insert into palavra_chave (id_palavra, descricao) values (38, 'Synchronised');
insert into palavra_chave (id_palavra, descricao) values (39, 'standardization');
insert into palavra_chave (id_palavra, descricao) values (40, 'leverage');
insert into palavra_chave (id_palavra, descricao) values (41, 'Fundamental');
insert into palavra_chave (id_palavra, descricao) values (42, 'Open-source');
insert into palavra_chave (id_palavra, descricao) values (43, 'impactful');
insert into palavra_chave (id_palavra, descricao) values (44, 'zero defect');
insert into palavra_chave (id_palavra, descricao) values (45, 'needs-based');
insert into palavra_chave (id_palavra, descricao) values (46, 'Visionary');
insert into palavra_chave (id_palavra, descricao) values (47, 'uniform');
insert into palavra_chave (id_palavra, descricao) values (48, 'Switchable');
insert into palavra_chave (id_palavra, descricao) values (49, 'heuristic');
insert into palavra_chave (id_palavra, descricao) values (50, 'Secured');
insert into palavra_chave (id_palavra, descricao) values (51, 'firmware');
insert into palavra_chave (id_palavra, descricao) values (52, 'Implemented');
insert into palavra_chave (id_palavra, descricao) values (53, '24 hour');
insert into palavra_chave (id_palavra, descricao) values (54, '4th generation');
insert into palavra_chave (id_palavra, descricao) values (55, 'Configurable');
insert into palavra_chave (id_palavra, descricao) values (56, 'frame');
insert into palavra_chave (id_palavra, descricao) values (57, 'Upgradable');
insert into palavra_chave (id_palavra, descricao) values (58, 'application');
insert into palavra_chave (id_palavra, descricao) values (59, 'Diverse');
insert into palavra_chave (id_palavra, descricao) values (60, 'systemic');
insert into palavra_chave (id_palavra, descricao) values (61, 'capacity');
insert into palavra_chave (id_palavra, descricao) values (62, 'database');
insert into palavra_chave (id_palavra, descricao) values (63, '24/7');
insert into palavra_chave (id_palavra, descricao) values (64, 'database');
insert into palavra_chave (id_palavra, descricao) values (65, 'demand-driven');
insert into palavra_chave (id_palavra, descricao) values (66, 'Digitized');
insert into palavra_chave (id_palavra, descricao) values (67, 'alliance');
insert into palavra_chave (id_palavra, descricao) values (68, 'Innovative');
insert into palavra_chave (id_palavra, descricao) values (69, 'complexity');
insert into palavra_chave (id_palavra, descricao) values (70, 'modular');
insert into palavra_chave (id_palavra, descricao) values (71, 'core');
insert into palavra_chave (id_palavra, descricao) values (72, 'attitude');
insert into palavra_chave (id_palavra, descricao) values (73, 'uniform');
insert into palavra_chave (id_palavra, descricao) values (74, 'moratorium');
insert into palavra_chave (id_palavra, descricao) values (75, 'utilisation');
insert into palavra_chave (id_palavra, descricao) values (76, 'contextually-based');
insert into palavra_chave (id_palavra, descricao) values (77, 'open architecture');
insert into palavra_chave (id_palavra, descricao) values (78, 'open architecture');
insert into palavra_chave (id_palavra, descricao) values (79, 'Multi-channelled');
insert into palavra_chave (id_palavra, descricao) values (80, 'Optional');
insert into palavra_chave (id_palavra, descricao) values (81, 'standardization');
insert into palavra_chave (id_palavra, descricao) values (82, 'structure');
insert into palavra_chave (id_palavra, descricao) values (83, 'time-frame');
insert into palavra_chave (id_palavra, descricao) values (84, 'Persevering');
insert into palavra_chave (id_palavra, descricao) values (85, 'Grass-roots');
insert into palavra_chave (id_palavra, descricao) values (86, 'exuding');
insert into palavra_chave (id_palavra, descricao) values (87, 'Persevering');
insert into palavra_chave (id_palavra, descricao) values (88, 'model');
insert into palavra_chave (id_palavra, descricao) values (89, 'application');
insert into palavra_chave (id_palavra, descricao) values (90, 'focus group');
insert into palavra_chave (id_palavra, descricao) values (91, 'radical');
insert into palavra_chave (id_palavra, descricao) values (92, 'artificial intelligence');
insert into palavra_chave (id_palavra, descricao) values (93, 'high-level');
insert into palavra_chave (id_palavra, descricao) values (94, 'systemic');
insert into palavra_chave (id_palavra, descricao) values (95, 'cohesive');
insert into palavra_chave (id_palavra, descricao) values (96, 'database');
insert into palavra_chave (id_palavra, descricao) values (97, 'Fundamental');
insert into palavra_chave (id_palavra, descricao) values (98, 'approach');
insert into palavra_chave (id_palavra, descricao) values (99, 'Enterprise-wide');
insert into palavra_chave (id_palavra, descricao) values (100, 'Pre-emptive');
insert into palavra_chave (id_palavra, descricao) values (101, 'stable');
insert into palavra_chave (id_palavra, descricao) values (102, 'model');
insert into palavra_chave (id_palavra, descricao) values (103, 'Upgradable');
insert into palavra_chave (id_palavra, descricao) values (104, 'Ameliorated');
insert into palavra_chave (id_palavra, descricao) values (105, 'Multi-lateral');
insert into palavra_chave (id_palavra, descricao) values (106, 'alliance');
insert into palavra_chave (id_palavra, descricao) values (107, 'Virtual');
insert into palavra_chave (id_palavra, descricao) values (108, 'heuristic');
insert into palavra_chave (id_palavra, descricao) values (109, 'Managed');
insert into palavra_chave (id_palavra, descricao) values (110, 'clear-thinking');
insert into palavra_chave (id_palavra, descricao) values (111, 'product');
insert into palavra_chave (id_palavra, descricao) values (112, 'Self-enabling');
insert into palavra_chave (id_palavra, descricao) values (113, 'Networked');
insert into palavra_chave (id_palavra, descricao) values (114, 'Streamlined');
insert into palavra_chave (id_palavra, descricao) values (115, 'website');
insert into palavra_chave (id_palavra, descricao) values (116, 'extranet');
insert into palavra_chave (id_palavra, descricao) values (117, 'time-frame');
insert into palavra_chave (id_palavra, descricao) values (118, 'portal');
insert into palavra_chave (id_palavra, descricao) values (119, 'Centralized');
insert into palavra_chave (id_palavra, descricao) values (120, 'Cross-platform');
insert into palavra_chave (id_palavra, descricao) values (121, 'Reactive');
insert into palavra_chave (id_palavra, descricao) values (122, 'intangible');
insert into palavra_chave (id_palavra, descricao) values (123, 'Polarised');
insert into palavra_chave (id_palavra, descricao) values (124, '3rd generation');
insert into palavra_chave (id_palavra, descricao) values (125, 'optimizing');
insert into palavra_chave (id_palavra, descricao) values (126, 'attitude');
insert into palavra_chave (id_palavra, descricao) values (127, 'intangible');
insert into palavra_chave (id_palavra, descricao) values (128, 'incremental');
insert into palavra_chave (id_palavra, descricao) values (129, 'analyzer');
insert into palavra_chave (id_palavra, descricao) values (130, 'Centralized');
insert into palavra_chave (id_palavra, descricao) values (131, 'Expanded');
insert into palavra_chave (id_palavra, descricao) values (132, 'Ameliorated');
insert into palavra_chave (id_palavra, descricao) values (133, 'service-desk');
insert into palavra_chave (id_palavra, descricao) values (134, 'database');
insert into palavra_chave (id_palavra, descricao) values (135, 'budgetary management');
insert into palavra_chave (id_palavra, descricao) values (136, 'contextually-based');
insert into palavra_chave (id_palavra, descricao) values (137, 'holistic');
insert into palavra_chave (id_palavra, descricao) values (138, 'knowledge user');
insert into palavra_chave (id_palavra, descricao) values (139, '6th generation');
insert into palavra_chave (id_palavra, descricao) values (140, 'Centralized');
insert into palavra_chave (id_palavra, descricao) values (141, 'knowledge base');
insert into palavra_chave (id_palavra, descricao) values (142, 'model');
insert into palavra_chave (id_palavra, descricao) values (143, 'attitude-oriented');
insert into palavra_chave (id_palavra, descricao) values (144, 'Inverse');
insert into palavra_chave (id_palavra, descricao) values (145, 'encoding');
insert into palavra_chave (id_palavra, descricao) values (146, 'definition');
insert into palavra_chave (id_palavra, descricao) values (147, 'projection');
insert into palavra_chave (id_palavra, descricao) values (148, 'infrastructure');
insert into palavra_chave (id_palavra, descricao) values (149, 'Centralized');
insert into palavra_chave (id_palavra, descricao) values (150, 'success');
insert into palavra_chave (id_palavra, descricao) values (151, 'directional');
insert into palavra_chave (id_palavra, descricao) values (152, 'capability');
insert into palavra_chave (id_palavra, descricao) values (153, 'Polarised');
insert into palavra_chave (id_palavra, descricao) values (154, 'Horizontal');
insert into palavra_chave (id_palavra, descricao) values (155, 'Graphical User Interface');
insert into palavra_chave (id_palavra, descricao) values (156, 'empowering');
insert into palavra_chave (id_palavra, descricao) values (157, 'Customizable');
insert into palavra_chave (id_palavra, descricao) values (158, 'Seamless');
insert into palavra_chave (id_palavra, descricao) values (159, 'conglomeration');
insert into palavra_chave (id_palavra, descricao) values (160, 'artificial intelligence');
insert into palavra_chave (id_palavra, descricao) values (161, 'Sharable');
insert into palavra_chave (id_palavra, descricao) values (162, 'local area network');
insert into palavra_chave (id_palavra, descricao) values (163, 'Balanced');
insert into palavra_chave (id_palavra, descricao) values (164, 'capability');
insert into palavra_chave (id_palavra, descricao) values (165, 'multi-state');
insert into palavra_chave (id_palavra, descricao) values (166, 'background');
insert into palavra_chave (id_palavra, descricao) values (167, 'Open-source');
insert into palavra_chave (id_palavra, descricao) values (168, 'frame');
insert into palavra_chave (id_palavra, descricao) values (169, 'Customizable');
insert into palavra_chave (id_palavra, descricao) values (170, 'Configurable');
insert into palavra_chave (id_palavra, descricao) values (171, 'core');
insert into palavra_chave (id_palavra, descricao) values (172, 'instruction set');
insert into palavra_chave (id_palavra, descricao) values (173, 'Assimilated');
insert into palavra_chave (id_palavra, descricao) values (174, 'Advanced');
insert into palavra_chave (id_palavra, descricao) values (175, 'knowledge base');
insert into palavra_chave (id_palavra, descricao) values (176, 'functionalities');
insert into palavra_chave (id_palavra, descricao) values (177, 'optimizing');
insert into palavra_chave (id_palavra, descricao) values (178, 'utilisation');
insert into palavra_chave (id_palavra, descricao) values (179, 'zero administration');
insert into palavra_chave (id_palavra, descricao) values (180, 'Virtual');
insert into palavra_chave (id_palavra, descricao) values (181, 'contextually-based');
insert into palavra_chave (id_palavra, descricao) values (182, 'methodology');
insert into palavra_chave (id_palavra, descricao) values (183, 'maximized');
insert into palavra_chave (id_palavra, descricao) values (184, 'capacity');
insert into palavra_chave (id_palavra, descricao) values (185, 'systematic');
insert into palavra_chave (id_palavra, descricao) values (186, 'static');
insert into palavra_chave (id_palavra, descricao) values (187, 'matrix');
insert into palavra_chave (id_palavra, descricao) values (188, 'Intuitive');
insert into palavra_chave (id_palavra, descricao) values (189, 'contextually-based');
insert into palavra_chave (id_palavra, descricao) values (190, 'multi-tasking');
insert into palavra_chave (id_palavra, descricao) values (191, 'real-time');
insert into palavra_chave (id_palavra, descricao) values (192, 'motivating');
insert into palavra_chave (id_palavra, descricao) values (193, 'Innovative');
insert into palavra_chave (id_palavra, descricao) values (194, 'attitude');
insert into palavra_chave (id_palavra, descricao) values (195, 'attitude');
insert into palavra_chave (id_palavra, descricao) values (196, 'coherent');
insert into palavra_chave (id_palavra, descricao) values (197, 'Stand-alone');
insert into palavra_chave (id_palavra, descricao) values (198, '24 hour');
insert into palavra_chave (id_palavra, descricao) values (199, '24/7');
insert into palavra_chave (id_palavra, descricao) values (200, 'Ergonomic');

