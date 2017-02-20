DROP TABLE IF EXISTS  `sources`;

CREATE TABLE IF NOT EXISTS `sources` (
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  `title` VARCHAR(64) NOT NULL,
  `url` VARCHAR(255) DEFAULT NULL,
  `actual` BOOLEAN DEFAULT TRUE
);

DROP TABLE IF EXISTS `rules`;

CREATE TABLE IF NOT EXISTS  `rules` (
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  `source_id` INT NOT NULL,
  `title` VARCHAR(64) NOT NULL,
  `url` VARCHAR(255) DEFAULT NULL,
  `regexp` VARCHAR(255) DEFAULT NULL,
  `actual` BOOLEAN DEFAULT TRUE
);

DROP TABLE IF EXISTS  `getched`;

CREATE TABLE IF NOT EXISTS `fetched` (
  `id` INT NOT NULL  AUTO_INCREMENT,
  PRIMARY KEY  (`id`),
  `rule_id` INT NOT NULL,
  `value` VARCHAR(255),
  `fetch_date` DATETIME NOT NULL,
  `actual` BOOLEAN DEFAULT TRUE
);


