CREATE TABLE "expertises" (
	"id"	INTEGER NOT NULL,
	"expertise"	TEXT,
	"competence" TEXT,
    "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("user_id") REFERENCES "users"("id")
);