CREATE TABLE user (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  email TEXT UNIQUE NOT NULL,
  password TEXT NOT NULL
);

CREATE TABLE content (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  comment TEXT,
  user_id INTEGER,
  FOREIGN KEY (user_id) REFERENCES user (id)
);