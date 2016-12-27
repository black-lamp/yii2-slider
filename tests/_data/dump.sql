PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: slider
DROP TABLE IF EXISTS slider;
CREATE TABLE slider (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	"key" STRING (255) NOT NULL UNIQUE,
	entity_id INTEGER,
	entity_name STRING (500)
);

-- Table: slider_content
DROP TABLE IF EXISTS slider_content;
CREATE TABLE slider_content (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	slider_id INTEGER NOT NULL
	CONSTRAINT "slider_content-slider-FK" REFERENCES slider (id)
	ON DELETE CASCADE ON UPDATE CASCADE, content TEXT NOT NULL,
	params STRING,
	position INTEGER NOT NULL,
	is_image BOOLEAN NOT NULL DEFAULT true,
	alt STRING (255) NOT NULL DEFAULT ''
);

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
