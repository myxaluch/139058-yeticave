CREATE DATABASE yeti_cave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE yeti_cave;

CREATE TABLE categories(
  id INT AUTO_INCREMENT PRIMARY KEY,
  title CHAR(128)
);

CREATE TABLE lots(
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT,
  winner_id INT,
  author_id INT,
  title CHAR(128),
  description TEXT,
  image_url CHAR(128),
  start_rate INT NOT NULL DEFAULT 0,
  rate_step INT NOT NULL DEFAULT 0,
  created_at DATE,
  finished_at DATE
);

CREATE TABLE rates(
  id INT AUTO_INCREMENT PRIMARY KEY,
  lot_id INT,
  author_id INT,
  amount INT NOT NULL DEFAULT 0,
  created_at DATE
);

CREATE TABLE users(
  id INT AUTO_INCREMENT PRIMARY KEY,
  email CHAR(128) NOT NULL,
  name CHAR(128) NOT NULL DEFAULT '',
  password CHAR(64),
  avatar_url CHAR(128),
  contact_info TEXT,
  created_at DATE
);

CREATE UNIQUE INDEX index_title_on_categories ON categories(title);
CREATE UNIQUE INDEX index_email_on_users ON users(email);

# Indexes for search by lots
CREATE INDEX index_title_on_lots ON lots(title);
CREATE INDEX index_description_on_lots ON lots(description(255));


