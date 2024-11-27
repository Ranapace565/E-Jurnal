CREATE TABLE "admins" (
	"id"	INTEGER NOT NULL,
	"name"	TEXT NOT NULL,
	"expert_id"	INTEGER NOT NULL,
	"user_id"	INTEGER NOT NULL,
    "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("user_id") REFERENCES "users"("id"),
	FOREIGN KEY("expert_id") REFERENCES "experts"("id")
);