CREATE TABLE "presences" (
	"id"	INTEGER NOT NULL,
	"sick"	INTEGER,
	"permission"	INTEGER,
	"practice_id"	INTEGER NOT NULL,
    "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("practice_id") REFERENCES "practices"("id")
);