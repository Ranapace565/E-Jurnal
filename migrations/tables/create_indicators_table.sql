CREATE TABLE "indicators" (
	"id"	INTEGER NOT NULL,
	-- "objective"	TEXT NOT NULL,
	"indicator"	TEXT ,
	"achievement"	INTEGER NOT NULL,
	"description"	TEXT ,
	"observation_id"	INTEGER NOT NULL,
    "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("observation_id") REFERENCES "observations"("id")
);
CREATE TABLE "indicatories" (
	"id"	INTEGER NOT NULL,
	"objective"	TEXT NOT NULL,
	"achievement"	INTEGER NOT NULL,
	-- "description"	TEXT ,
	"indicators_id"	INTEGER NOT NULL,
    "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("indicators_id") REFERENCES "indicators"("id")
);

CREATE TABLE "notes" (
	"id"	INTEGER NOT NULL,
	"objective"	TEXT NOT NULL,
	"description"	TEXT ,
	"observation_id"	INTEGER NOT NULL,
    "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id"),
	FOREIGN KEY("observation_id") REFERENCES "observations"("id")
);

-- CREATE TABLE "notes" (
-- 	"id"	INTEGER NOT NULL,
-- 	"objective"	TEXT NOT NULL,
-- 	"description"	TEXT ,
-- 	"observation_id"	INTEGER NOT NULL,
--     "create_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
-- 	PRIMARY KEY("id"),
-- 	FOREIGN KEY("observation_id") REFERENCES "observations"("id")
-- );

-- observasi