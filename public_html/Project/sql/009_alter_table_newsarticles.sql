ALTER TABLE `NewsArticles` ADD COLUMN `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `NewsArticles` ADD COLUMN `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;