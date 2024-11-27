CREATE TABLE "users" (
	"id"	INTEGER NOT NULL,
	"username"	TEXT NOT NULL,
	"password"	TEXT NOT NULL,
	"role" TEXT NOT NULL,
	-- role ('admin', 'siswa', 'dudi', 'admin')
	"token" TEXT,
	"create_at"	TIMESTAMP  DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id")
);