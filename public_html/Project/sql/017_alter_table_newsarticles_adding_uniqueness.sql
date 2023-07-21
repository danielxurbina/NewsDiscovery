ALTER TABLE `NewsArticles` ADD UNIQUE (`content_hash`);
ALTER TABLE `NewsArticles` ADD UNIQUE (`title`);