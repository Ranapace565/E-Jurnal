CREATE TABLE "activitys" (
	"id"	INTEGER NOT NULL,
	"date"	TEXT NOT NULL,
	"activity"	TEXT NOT NULL,
	"description"	TEXT NOT NULL,
	"approve"	INTEGER,
	"week"	INTEGER NOT NULL,
	"nis"	INTEGER NOT NULL,
    "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("nis") REFERENCES "students"("id")
);