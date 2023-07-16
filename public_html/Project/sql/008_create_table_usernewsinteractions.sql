CREATE TABLE IF NOT EXISTS `UserNewsInteractions`
(
    `id` int auto_increment not null,
    `user_id` int,
    `news_id` int,
    `interaction_type` varchar(20) not null,
    `created` timestamp default current_timestamp,
    `modified` timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES Users(`id`),
    FOREIGN KEY (`news_id`) REFERENCES NewsArticles(`id`),
    UNIQUE KEY (`user_id`, `news_id`)
)