CREATE TABLE "profiles" (
	"id"	INTEGER NOT NULL,
	"file_name"	TEXT NOT NULL,
	"file_path"	INTEGER NOT NULL,
	"user_id"	INTEGER NOT NULL,
    "uploaded_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
    FOREIGN KEY("user_id") REFERENCES "users"("id")
);