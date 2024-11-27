
CREATE TABLE "observations" (
	"id"	INTEGER NOT NULL,
	"job"	TEXT ,
	"nis"	INTEGER NOT NULL,
    "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("nis") REFERENCES "students"("id")
);