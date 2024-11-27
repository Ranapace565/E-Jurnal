CREATE TABLE "signaturs" (
	"id"	INTEGER NOT NULL,
	"name"	TEXT NOT NULL,
	"file_name" TEXT NOT NULL,
    "file_path" TEXT NOT NULL,
	"create_at"	TIMESTAMP  DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id")
);