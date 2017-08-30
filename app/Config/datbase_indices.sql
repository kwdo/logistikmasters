ALTER TABLE `users_years`  ADD `deleted` TINYINT(1) NOT NULL DEFAULT '0',  ADD `deleted_date` DATETIME NULL;
ALTER TABLE users_years ADD UNIQUE u_y (user_id,year_id);
ALTER TABLE `user_catalogs`  ADD `deleted` TINYINT(1) NOT NULL DEFAULT '0',  ADD `deleted_date` DATETIME NULL;
ALTER TABLE user_catalogs ADD UNIQUE u_y (user_id,year);
ALTER TABLE `user_points`  ADD `deleted` TINYINT(1) NOT NULL DEFAULT '0',  ADD `deleted_date` DATETIME NULL;
ALTER TABLE user_points ADD UNIQUE u_y (user_id,year);
ALTER TABLE `user_profiles`  ADD `deleted` TINYINT(1) NOT NULL DEFAULT '0',  ADD `deleted_date` DATETIME NULL;
ALTER TABLE user_profiles ADD UNIQUE u_d (user_id,deleted);
ALTER TABLE `users`  ADD `deleted` TINYINT(1) NOT NULL DEFAULT '0',  ADD `deleted_date` DATETIME NULL;