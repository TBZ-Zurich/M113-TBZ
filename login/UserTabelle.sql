CREATE TABLE benutzerdaten (
  Id Int(11) NOT NULL auto_increment,
  Nickname VarChar(50) NOT NULL default '',
  Kennwort VarChar(50) NOT NULL default '',
  Nachname VarChar(50) NOT NULL default '',
  Vorname VarChar(50) NOT NULL default '',
  PRIMARY KEY (Id)
) 