ALTER TABLE ipaddress ADD COLUMN used TINYINT(2), ADD KEY `used`;

UPDATE ipaddress SET `used`=1;

