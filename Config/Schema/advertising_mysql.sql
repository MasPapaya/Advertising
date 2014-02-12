-- -----------------------------------------------------
-- Require: users, languages
-- -----------------------------------------------------


-- -----------------------------------------------------
-- Drops
-- -----------------------------------------------------

DROP TABLE IF EXISTS clicks;
DROP TABLE IF EXISTS impressions;
DROP TABLE IF EXISTS blocks_advertisements;
DROP TABLE IF EXISTS advertisements;
DROP TABLE IF EXISTS blocks;


-- -----------------------------------------------------
-- Table advertisements
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS advertisements (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id INT UNSIGNED DEFAULT NULL,
  language_id INT UNSIGNED DEFAULT NULL,
  published DATETIME NOT NULL,
  deleted DATETIME NOT NULL,
  height VARCHAR(45) NOT NULL,
  width VARCHAR(45) NOT NULL,
  target VARCHAR(100) NOT NULL,
  name VARCHAR(100) NOT NULL,
  url TEXT NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

ALTER TABLE advertisements ADD INDEX adv_use_idx (user_id ASC);
ALTER TABLE advertisements ADD INDEX lan_use_idx (language_id ASC);


-- -----------------------------------------------------
-- Table blocks
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS blocks (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  multiple TINYINT(1) NOT NULL,
  is_user TINYINT(1) NOT NULL,
  block_type char(1) NOT NULL DEFAULT '1',
  published DATETIME NOT NULL,
  name VARCHAR(45) NOT NULL,
  alias VARCHAR(45) NOT NULL,
  height VARCHAR(45) NOT NULL,
  width VARCHAR(45) NOT NULL,
  orientation VARCHAR(45) NOT NULL,
  type_animation VARCHAR(45) NOT NULL,
  transition_time VARCHAR(45) NOT NULL,
  ad_number_visible VARCHAR(45) NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table blocks_advertisements
-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS blocks_advertisements (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  block_id INT UNSIGNED NOT NULL,
  advertisement_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

ALTER TABLE blocks_advertisements ADD INDEX bloadv_blo_idx (block_id ASC);
ALTER TABLE blocks_advertisements ADD INDEX bloadv_adv_idx (advertisement_id ASC);


-- -----------------------------------------------------
-- Table clicks
-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS clicks (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  blocks_advertisement_id INT UNSIGNED NOT NULL,
  created DATETIME NOT NULL,
  ip VARCHAR(45) NOT NULL,
  user_agent VARCHAR(200) NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

ALTER TABLE clicks ADD INDEX cli_bloadv_idx (blocks_advertisement_id ASC);


-- -----------------------------------------------------
-- Table impressions
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS impressions (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  blocks_advertisement_id INT UNSIGNED NOT NULL,
  created DATETIME NOT NULL,
  ip VARCHAR(45) NOT NULL,
  user_agent VARCHAR(200) NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

ALTER TABLE clicks ADD INDEX imp_bloadv_idx (blocks_advertisement_id ASC);


-- -----------------------------------------------------
-- Constraints
-- -----------------------------------------------------

ALTER TABLE advertisements
ADD CONSTRAINT adv_use_fk FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT lan_use_fk FOREIGN KEY (language_id) REFERENCES languages (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE blocks_advertisements
ADD CONSTRAINT bloadv_blo_fk FOREIGN KEY (block_id) REFERENCES blocks (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT bloadv_adv_fk FOREIGN KEY (advertisement_id) REFERENCES advertisements (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE clicks
ADD CONSTRAINT cli_bloadv_fk FOREIGN KEY (blocks_advertisement_id) REFERENCES blocks_advertisements (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE impressions
ADD CONSTRAINT imp_bloadv_fk FOREIGN KEY (blocks_advertisement_id) REFERENCES blocks_advertisements (id) ON DELETE NO ACTION ON UPDATE NO ACTION;


-- -----------------------------------------------------
-- Views
-- -----------------------------------------------------

DROP TABLE IF EXISTS view_blocks_advertisements;
CREATE  OR REPLACE VIEW view_blocks_advertisements AS
SELECT
blocks_advertisements.id AS id,
blocks.id AS block_id,
blocks.alias AS block_alias,
blocks.multiple AS block_multiple,
blocks.height AS block_height,
blocks.width AS block_width,
advertisements.id AS advertisement_id,
advertisements.name AS advertisement_name,
advertisements.url AS advertisement_url,
advertisements.target AS advertisement_taget,
advertisements.height AS advertisement_height,
advertisements.width AS advertisement_width,
advertisements.language_id AS language_id
FROM
blocks
LEFT OUTER JOIN blocks_advertisements ON blocks_advertisements.block_id = blocks.id
LEFT JOIN advertisements ON blocks_advertisements.advertisement_id = advertisements.id
WHERE
blocks.published > '0000-00-00 00:00:00' AND
(advertisements.published > '0000-00-00 00:00:00' OR  advertisements.published IS NULL) AND
(advertisements.deleted <= '0000-00-00 00:00:00' OR advertisements.deleted IS NULL);


CREATE  OR REPLACE VIEW view_clicks AS
SELECT
COUNT(*) AS total,
DATE(clicks.created) AS creation_date,
clicks.blocks_advertisement_id
FROM clicks
GROUP BY clicks.blocks_advertisement_id, DATE(clicks.created);


CREATE OR REPLACE VIEW view_impressions AS
SELECT
COUNT(*) AS total,
DATE(impressions.created) AS creation_date,
impressions.blocks_advertisement_id
FROM impressions
GROUP BY impressions.blocks_advertisement_id, DATE(impressions.created);
