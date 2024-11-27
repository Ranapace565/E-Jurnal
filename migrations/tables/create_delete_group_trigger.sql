CREATE TRIGGER after_group_delete
AFTER DELETE ON groups
FOR EACH ROW
BEGIN
    UPDATE students
    SET group_id = NULL
    WHERE group_id = OLD.id;
END;