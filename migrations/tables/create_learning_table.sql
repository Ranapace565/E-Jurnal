CREATE TABLE "learnings" (
	"id"	INTEGER NOT NULL,
	"objective"	TEXT NOT NULL,
	"score"	INTEGER NOT NULL,
	"description"	TEXT NOT NULL,
	"practice_id"	INTEGER NOT NULL,
    "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("practice_id") REFERENCES "practices"("id")
);