CREATE TABLE "files" (
    "id" INTEGER NOT NULL,
    "user_id" INTEGER,
    "type" TEXT NOT NULL,
    "file_name" TEXT NOT NULL,
    "file_path" TEXT NOT NULL,
    "uploaded_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY ("id"),
    FOREIGN KEY(user_id) REFERENCES users(id)
);
