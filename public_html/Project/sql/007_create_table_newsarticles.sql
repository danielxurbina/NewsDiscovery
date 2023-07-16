CREATE TABLE IF NOT EXISTS `NewsArticles`
(
    `id` int auto_increment not null,
    `title` varchar(100) not null,
    `link` varchar(100) not null,
    `video_url` varchar(100) not null,
    `description` varchar(100) not null,
    `content` varchar(1000) not null,
    `publish_date` date not null,
    `image_url` varchar(100) not null,
    `source_id` varchar(100) not null,
    `category` varchar(100) not null,
    `country` varchar(100) not null,
    `created_by` int, 
    PRIMARY KEY (`id`),
    FOREIGN KEY (`created_by`) REFERENCES `Users`(`id`)
)