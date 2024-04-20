CREATE TABLE `softexpert`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT NOW(),
  `updated_at` DATETIME NOT NULL DEFAULT NOW(),
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE);

CREATE TABLE `softexpert`.`tipos_produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT NOW(),
  `updated_at` DATETIME NOT NULL DEFAULT NOW(),
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC) VISIBLE);

CREATE TABLE `softexpert`.`percentuais_imposto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `valor` INT NOT NULL,
  `tipo_produto_id` INT NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT NOW(),
  `updated_at` DATETIME NOT NULL DEFAULT NOW(),
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC) VISIBLE,
  INDEX `FKID_tipo_produto_idx` (`tipo_produto_id` ASC) VISIBLE,
  CONSTRAINT `FKID_tipo_produto`
    FOREIGN KEY (`tipo_produto_id`)
    REFERENCES `softexpert`.`tipos_produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE `softexpert`.`produtos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `quantidade` INT NOT NULL DEFAULT 0,
  `valor` FLOAT NOT NULL DEFAULT 0,
  `tipo_produto_id` INT NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT NOW(),
  `updated_at` DATETIME NOT NULL DEFAULT NOW(),
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `FKID_tipo_produto_idx_idx` (`tipo_produto_id` ASC) VISIBLE,
  CONSTRAINT `FKID_tipo_produto_idx`
    FOREIGN KEY (`tipo_produto_id`)
    REFERENCES `softexpert`.`tipos_produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE `softexpert`.`vendas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cliente` VARCHAR(255) NOT NULL,
  `status` VARCHAR(255) NOT NULL DEFAULT 'pendente',
  `created_at` DATETIME NOT NULL DEFAULT NOW(),
  `updated_at` DATETIME NOT NULL DEFAULT NOW(),
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `softexpert`.`venda_produtos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `venda_id` INT NOT NULL,
  `produto_id` INT NOT NULL,
  `quantidade` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT NOW(),
  `updated_at` DATETIME NOT NULL DEFAULT NOW(),
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `FKID_venda_idx` (`venda_id` ASC) VISIBLE,
  INDEX `FKID_produto_idx` (`produto_id` ASC) VISIBLE,
  CONSTRAINT `FKID_produto_idx`
    FOREIGN KEY (`produto_id`)
    REFERENCES `softexpert`.`produtos` (`id`),
  CONSTRAINT `FKID_venda_idx`
    FOREIGN KEY (`venda_id`)
    REFERENCES `softexpert`.`vendas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);