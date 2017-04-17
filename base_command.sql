--Табличка где купить?
CREATE TABLE IF NOT EXISTS `ecola`.`where_buy` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` TEXT NULL,
  `city` TEXT NULL,
  `address` TEXT NULL,
  `contact` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM;