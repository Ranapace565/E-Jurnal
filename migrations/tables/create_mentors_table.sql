CREATE TABLE "mentors" (
	"id"	INTEGER NOT NULL,
	"name"	TEXT NOT NULL,
	"signature_id"	INTEGER,
    "user_id" INTEGER,
	"create_at"	TIMESTAMP  DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
    FOREIGN KEY("user_id") REFERENCES "users"(id),
    FOREIGN KEY("signature_id") REFERENCES "signatures"(id)
);