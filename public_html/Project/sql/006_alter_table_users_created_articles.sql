ALTER TABLE Users ADD COLUMN created_articles INT;
ALTER TABLE Users ADD CONSTRAINT fk_created_articles FOREIGN KEY (created_articles) REFERENCES NewsArticles(id);