use stack;

SET FOREIGN_KEY_CHECKS=0;

delete from Question;
delete from Question2Tag;
delete from Tags;
delete from `User`;
delete from Reply;

SET FOREIGN_KEY_CHECKS=1;
