CREATE TABLE "students" (
	"id"	INTEGER NOT NULL,
	"name"	TEXT,
	"born_place"	TEXT,
	"born_date"	TEXT,
	"sex"	TEXT,
	"blood_type"	TEXT,
	"address"	TEXT,
	"telp"	TEXT,
	"health_note"	TEXT,
	"parent_name"	TEXT,
	"parent_telp"	TEXT,
	"parent_address"	TEXT,
	"expertise"	TEXT,
	"competence"	TEXT,
	"nisn"	TEXT,
	"group_id"	INTEGER,
	"user_id"	INTEGER,
    "created_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("group_id") REFERENCES "groups"("id"),
	FOREIGN KEY("user_id") REFERENCES "users"("id")
);