ALTER TABLE `UserNewsInteractions` ADD COLUMN `interaction_details` varchar(255) null default null;
ALTER TABLE `UserNewsInteractions` ADD COLUMN `interaction_rating` int(11) null default null;
ALTER TABLE `UserNewsInteractions` ADD COLUMN `interaction_timestamp` timestamp not null default current_timestamp;