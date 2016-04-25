CREATE TABLE `Account` (
  `email` CHAR(60) NOT NULL,
  `f_name` CHAR(35),
  `s_name` CHAR(35),
  `password` CHAR(35),
  `balance` INT,
  `sec_question` CHAR(60),
  `sec_answer` CHAR(60),
  PRIMARY KEY  (`email`)
);

CREATE TABLE `Transaction` (
  `trans_id` INT NOT NULL AUTO_INCREMENT,
  `email` CHAR(60),
  `date` DATETIME,
  `amount` INT,
  `account_number` CHAR(20),
  `type` CHAR(1),
  PRIMARY KEY  (`trans_id`)
);

CREATE TABLE `Bill` (
  `bill_id` INT NOT NULL AUTO_INCREMENT,
  `send_email` CHAR(60),
  `rec_email` CHAR(60),
  `amount` INT,
  `note` CHAR(15),
  `date_issued` DATETIME,
  `date_paid` DATETIME,
  PRIMARY KEY  (`bill_id`)
);


ALTER TABLE `Transaction` ADD CONSTRAINT `Transaction_fk1` FOREIGN KEY (`email`) REFERENCES Account(`email`);
ALTER TABLE `Bill` ADD CONSTRAINT `Bill_fk1` FOREIGN KEY (`send_email`) REFERENCES Account(`email`);
ALTER TABLE `Bill` ADD CONSTRAINT `Bill_fk2` FOREIGN KEY (`rec_email`) REFERENCES Account(`email`);