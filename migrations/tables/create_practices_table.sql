CREATE TABLE "practices" (
	"id"	INTEGER NOT NULL,
	"nis"	INTEGER,
    "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("nis") REFERENCES "students"("id")
);