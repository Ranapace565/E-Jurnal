CREATE TABLE "groups" (
	"id"	INTEGER NOT NULL,
	"date_start"	TEXT NOT NULL,
	"date_finish"	TEXT NOT NULL,
	"nip"	INTEGER,
	"iduka_id"	INTEGER,
    "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("iduka_id") REFERENCES "idukas"("id"),
	FOREIGN KEY("nip") REFERENCES "mentors"("id")
);


