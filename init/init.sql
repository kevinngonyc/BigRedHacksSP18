CREATE TABLE `pictures` (
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`file_name` TEXT NOT NULL UNIQUE,
	`file_ext` TEXT NOT NULL,
	`description` TEXT
);

INSERT INTO pictures (id, file_name, file_ext, description) VALUES (1, '1.png', 'png', 'Dutch National Flag');
