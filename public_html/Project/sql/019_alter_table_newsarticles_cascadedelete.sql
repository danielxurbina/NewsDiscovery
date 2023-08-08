ALTER TABLE `UserNewsInteractions`
DROP FOREIGN KEY `UserNewsInteractions_ibfk_2`,
ADD CONSTRAINT `FK_UserNewsInteractions_NewsArticles`
    FOREIGN KEY (`news_id`)
    REFERENCES `NewsArticles` (`id`)
    ON DELETE CASCADE; 
COMMENT 'To ensure that the likes associated with an article are deleted when the article is deleted.'