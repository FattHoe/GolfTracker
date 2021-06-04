CREATE TABLE PLAYERS
(
  playerID INT AUTO_INCREMENT,
  firstName VARCHAR(255) NOT NULL,
  lastName VARCHAR(255) NOT NULL,
  myKadNumber VARCHAR(80),
  passportNumber VARCHAR(80),
  dayOfBirth INT NOT NULL,
  monthOfBirth INT NOT NULL,
  yearOfBirth INT NOT NULL,
  gender VARCHAR(1) NOT NULL,
  homeAddress VARCHAR(255),
  country VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  mobileNumber VARCHAR(20),
  handicap FLOAT,
  nhsNumber INT,
  homeClub VARCHAR(255),
  guardianName VARCHAR(255) NOT NULL,
  guardianMobileNumber VARCHAR(20) NOT NULL,
  tShirtSize VARCHAR(5),
  tShirtCut VARCHAR(1),
  lastUpdatedDay INT NOT NULL,
  lastUpdatedMonth INT NOT NULL,
  lastUpdatedYear INT NOT NULL,
  PRIMARY KEY(playerID)
);

ALTER TABLE PLAYERS AUTO_INCREMENT=10001;

CREATE TABLE TOURNAMENTS
(
  tournamentID INT AUTO_INCREMENT,
  tournamentName VARCHAR(255) NOT NULL,
  startDay INT NOT NULL,
  startMonth INT NOT NULL,
  startYear INT NOT NULL,
  endDay INT NOT NULL,
  endMonth INT NOT NULL,
  endYear INT NOT NULL,
  venue VARCHAR(255) NOT NULL,
  planNumPlayers INT,
  actualNumPlayers INT NOT NULL,
  registerOpenDay INT,
  registerOpenMonth INT,
  registerOpenYear INT,
  registerCloseDay INT,
  registerCloseMonth INT,
  registerCloseYear INT,
  paymentCloseDay INT,
  paymentCloseMonth INT,
  paymentCloseYear INT,
  PRIMARY KEY(tournamentID)
);

ALTER TABLE TOURNAMENTS AUTO_INCREMENT=20001;

CREATE TABLE CATEGORIES
(
  categoryID INT AUTO_INCREMENT,
  ageGroupCode VARCHAR(20) NOT NULL,
  gender VARCHAR(1) NOT NULL,
  minAge INT NOT NULL,
  maxAge INT NOT NULL,
  PRIMARY KEY(categoryID)
);

CREATE TABLE COURSES
(
  courseID INT AUTO_INCREMENT,
  clubName VARCHAR(255) NOT NULL,
  courseName VARCHAR(255),
  stateLocation VARCHAR(255) NOT NULL,
  countryLocation VARCHAR(255) NOT NULL,
  numHoles INT NOT NULL,
  yardageUnits VARCHAR(20) NOT NULL,
  par1 INT NOT NULL,
  par2 INT NOT NULL,
  par3 INT NOT NULL,
  par4 INT NOT NULL,
  par5 INT NOT NULL,
  par6 INT NOT NULL,
  par7 INT NOT NULL,
  par8 INT NOT NULL,
  par9 INT NOT NULL,
  par10 INT,
  par11 INT,
  par12 INT,
  par13 INT,
  par14 INT,
  par15 INT,
  par16 INT,
  par17 INT,
  par18 INT,
  PRIMARY KEY(courseID)
);

ALTER TABLE COURSES AUTO_INCREMENT=30001;

CREATE TABLE YARDAGES
(
  yardageID INT AUTO_INCREMENT,
  distance1 INT NOT NULL,
  distance2 INT NOT NULL,
  distance3 INT NOT NULL,
  distance4 INT NOT NULL,
  distance5 INT NOT NULL,
  distance6 INT NOT NULL,
  distance7 INT NOT NULL,
  distance8 INT NOT NULL,
  distance9 INT NOT NULL,
  distance10 INT,
  distance11 INT,
  distance12 INT,
  distance13 INT,
  distance14 INT,
  distance15 INT,
  distance16 INT,
  distance17 INT,
  distance18 INT,
  PRIMARY KEY(yardageID)
);

ALTER TABLE YARDAGES AUTO_INCREMENT=40001;

CREATE TABLE SCORES
(
  playerID INT,
  tournamentID INT,
  roundNumber INT,
  categoryID INT NOT NULL,
  handicap INT NOT NULL,
  holesPlayed INT NOT NULL,
  noScoreCode VARCHAR(20),
  front9 INT,
  back9 INT,
  gross18 INT,
  nett18 INT,
  hole1 INT,
  hole2 INT,
  hole3 INT,
  hole4 INT,
  hole5 INT,
  hole6 INT,
  hole7 INT,
  hole8 INT,
  hole9 INT,
  hole10 INT,
  hole11 INT,
  hole12 INT,
  hole13 INT,
  hole14 INT,
  hole15 INT,
  hole16 INT,
  hole17 INT,
  hole18 INT,
  PRIMARY KEY(playerID, tournamentID, roundNumber),
  FOREIGN KEY(playerID) REFERENCES PLAYERS(playerID),
  FOREIGN KEY(tournamentID) REFERENCES TOURNAMENTS(tournamentID),
  FOREIGN KEY(categoryID) REFERENCES CATEGORIES(categoryID)
);

CREATE TABLE SCORECARDS
(
  tournamentID INT,
  categoryID INT,
  courseID INT NOT NULL,
  yardageID INT NOT NULL,
  PRIMARY KEY(tournamentID, categoryID),
  FOREIGN KEY(tournamentID) REFERENCES TOURNAMENTS(tournamentID),
  FOREIGN KEY(categoryID) REFERENCES CATEGORIES(categoryID),
  FOREIGN KEY(courseID) REFERENCES COURSES(courseID),
  FOREIGN KEY(yardageID) REFERENCES YARDAGES(yardageID)
);

CREATE TABLE TEEBOXES
(
  courseID INT,
  yardageID INT,
  colour VARCHAR(255) NOT NULL,
  PRIMARY KEY(courseID, yardageID),
  FOREIGN KEY(courseID) REFERENCES COURSES(courseID),
  FOREIGN KEY(yardageID) REFERENCES YARDAGES(yardageID)
);

CREATE TABLE ADMINS
(
  adminUsername VARCHAR(80),
  adminPassword VARCHAR(80) NOT NULL,
  PRIMARY KEY(adminUsername)
);