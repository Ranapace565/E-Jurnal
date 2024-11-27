CREATE TABLE "idukas" (
	"id"	INTEGER NOT NULL,
	"name"	TEXT NOT NULL,
	"address"	TEXT NOT NULL,
    "mentor" TEXT,
	"signature_id"	INTEGER,
	"user_id"	INTEGER NOT NULL,
    "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("signature_id") REFERENCES "signaturs"("id"),
	FOREIGN KEY("user_id") REFERENCES "users"("id")
);