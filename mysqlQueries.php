<?php
  define
  (
    "GET_ADMIN_PASSWORD",
    "SELECT adminPassword
     FROM ADMINS
     WHERE adminUsername = \"%s\""
  );
  
  define
  (
    "CHANGE_ADMIN_PASSWORD",
    "UPDATE ADMINS
     SET adminPassword = \"%s\"
     WHERE adminUsername = \"%s\""
  );

  define
  (
    "FIND_ADMIN_ACCOUNT",
    "SELECT *
     FROM ADMINS
     WHERE adminUsername = \"%s\""
  );

  define
  (
    "ADD_ADMIN_ACCOUNT",
    "INSERT INTO ADMINS(adminUsername, adminPassword)
     VALUES(\"%s\", \"%s\")"
  );

  define
  (
    "GET_LAST_UPDATED_PLAYERS",
    "SELECT playerID, firstName, lastName, dayOfBirth, monthOfBirth, yearOfBirth, gender, country, handicap, lastUpdatedDay, lastUpdatedMonth, lastUpdatedYear
     FROM PLAYERS
     ORDER BY lastUpdatedYear DESC, lastUpdatedMonth DESC, lastUpdatedDay DESC, firstName ASC, lastName ASC
     LIMIT %u"
  );

  define
  (
    "GET_PLAYERS_BY_NAME_SEARCH",
    "SELECT playerID, firstName, lastName, dayOfBirth, monthOfBirth, yearOfBirth, gender, country, handicap, lastUpdatedDay, lastUpdatedMonth, lastUpdatedYear
     FROM PLAYERS
     WHERE LOWER(firstName) LIKE \"%%%s%%\" AND LOWER(lastName) LIKE \"%%%s%%\"
     ORDER BY lastUpdatedYear DESC, lastUpdatedMonth DESC, lastUpdatedDay DESC, firstName ASC, lastName ASC
     LIMIT %u"
  );

  define
  (
    "ADD_PLAYER",
    "INSERT INTO PLAYERS(firstName, lastName, dayOfBirth, monthOfBirth, yearOfBirth, gender, country, email, guardianName, guardianMobileNumber, lastUpdatedDay, lastUpdatedMonth, lastUpdatedYear)
     VALUES(\"%s\", \"%s\", %u, %u, %u, \"%s\", \"%s\", \"%s\", \"%s\", \"%s\", %u, %u, %u)"
  );

  define
  (
    "EDIT_PLAYER_MYKAD",
    "UPDATE PLAYERS
     SET myKadNumber = \"%s\"
     WHERE playerID = %u"
  );

  define
  (
    "EDIT_PLAYER_PASSPORT",
    "UPDATE PLAYERS
     SET passportNumber = \"%s\"
     WHERE playerID = %u"
  );

  define
  (
    "EDIT_PLAYER_ADDRESS",
    "UPDATE PLAYERS
     SET homeAddress = \"%s\"
     WHERE playerID = %u"
  );

  define
  (
    "EDIT_PLAYER_MOBILE",
    "UPDATE PLAYERS
     SET mobileNumber = \"%s\"
     WHERE playerID = %u"
  );

  define
  (
    "EDIT_PLAYER_HANDICAP",
    "UPDATE PLAYERS
     SET handicap = %f, nhsNumber = %u
     WHERE playerID = %u"
  );

  define
  (
    "EDIT_PLAYER_CLUB",
    "UPDATE PLAYERS
     SET homeClub = \"%s\"
     WHERE playerID = %u"
  );

  define
  (
    "EDIT_PLAYER_TSHIRT",
    "UPDATE PLAYERS
     SET tShirtSize = \"%s\", tShirtCut = \"%s\"
     WHERE playerID = %u"
  );

  define
  (
    "GET_LAST_PLAYER_ADDED",
    "SELECT MAX(playerID) AS playerID
     FROM PLAYERS"
  );

  define
  (
    "GET_PLAYER",
    "SELECT *
     FROM PLAYERS
     WHERE playerID = %u"
  );

  define
  (
    "EDIT_PLAYER",
    "UPDATE PLAYERS
     SET firstName = \"%s\", lastName = \"%s\", myKadNumber = NULL, passportNumber = NULL, dayOfBirth = %u, monthOfBirth = %u, yearOfBirth = %u, gender = \"%s\", homeAddress = NULL, country = \"%s\", email = \"%s\", mobileNumber = NULL, handicap = NULL, nhsNumber = NULL, homeClub = NULL, guardianName = \"%s\", guardianMobileNumber = \"%s\", tShirtSize = NULL, tShirtCut = NULL, lastUpdatedDay = %u, lastUpdatedMonth = %u, lastUpdatedYear = %u
     WHERE playerID = %u"
  );

  define
  (
    "DELETE_PLAYER",
    "DELETE FROM PLAYERS
     WHERE playerID = %u"
  );

  define
  (
    "GET_CATEGORIES",
    "SELECT *
     FROM CATEGORIES
     ORDER BY ageGroupCode ASC, minAge ASC, maxAge ASC
     LIMIT %u"
  );

  define
  (
    "GET_ALL_CATEGORIES",
    "SELECT *
     FROM CATEGORIES
     ORDER BY ageGroupCode ASC, minAge ASC, maxAge ASC"
  );

  define
  (
    "GET_CATEGORIES_BY_NAME_SEARCH",
    "SELECT *
     FROM CATEGORIES
     WHERE LOWER(ageGroupCode) LIKE \"%%%s%%\"
     ORDER BY ageGroupCode ASC, minAge ASC, maxAge ASC
     LIMIT %u"
  );

  define
  (
    "ADD_CATEGORY",
    "INSERT INTO CATEGORIES(ageGroupCode, gender, minAge, maxAge)
     VALUES(\"%s\", \"%s\", %u, %u)"
  );

  define
  (
    "GET_LAST_CATEGORY_ADDED",
    "SELECT MAX(categoryID) AS categoryID
     FROM CATEGORIES"
  );

  define
  (
    "GET_CATEGORY",
    "SELECT *
     FROM CATEGORIES
     WHERE categoryID = %u"
  );

  define
  (
    "EDIT_CATEGORY",
    "UPDATE CATEGORIES
     SET ageGroupCode = \"%s\", gender = \"%s\", minAge = %u, maxAge = %u
     WHERE categoryID = %u"
  );

  define
  (
    "DELETE_CATEGORY",
    "DELETE FROM CATEGORIES
     WHERE categoryID = %u"
  );

  define
  (
    "GET_LATEST_TOURNAMENTS",
    "SELECT tournamentID, tournamentName, startDay, startMonth, startYear, endDay, endMonth, endYear, venue, actualNumPlayers, registerOpenDay, registerOpenMonth, registerOpenYear, registerCloseDay, registerCloseMonth, registerCloseYear, paymentCloseDay, paymentCloseMonth, paymentCloseYear
     FROM TOURNAMENTS
     ORDER BY startYear DESC, startMonth DESC, startDay DESC, endYear DESC, endMonth DESC, endDay DESC, tournamentName ASC
     LIMIT %u"
  );

  define
  (
    "GET_TOURNAMENTS_BY_NAME_SEARCH",
    "SELECT tournamentID, tournamentName, startDay, startMonth, startYear, endDay, endMonth, endYear, venue, actualNumPlayers, registerOpenDay, registerOpenMonth, registerOpenYear, registerCloseDay, registerCloseMonth, registerCloseYear, paymentCloseDay, paymentCloseMonth, paymentCloseYear
     FROM TOURNAMENTS
     WHERE LOWER(tournamentName) LIKE \"%%%s%%\"
     ORDER BY startYear DESC, startMonth DESC, startDay DESC, endYear DESC, endMonth DESC, endDay DESC, tournamentName ASC
     LIMIT %u"
  );

  define
  (
    "GET_TOURNAMENT_BY_ID",
    "SELECT tournamentName, startDay, startMonth, startYear, endDay, endMonth, endYear, venue
     FROM TOURNAMENTS
     WHERE tournamentID = %u"
  );

  define
  (
    "GET_PLAYER_SCORES_BY_TOURNAMENT_ID_AND_ROUND_NUMBER",
    "SELECT SCORES.playerID AS playerID, PLAYERS.firstName AS firstName, PLAYERS.lastName AS lastName,
            SCORES.categoryID AS categoryID, CATEGORIES.ageGroupCode AS ageGroupCode, SCORES.handicap AS handicap,
            SCORES.holesPlayed AS holesPlayed, SCORES.noScoreCode AS noScoreCode, SCORES.gross18 AS gross18
     FROM SCORES
      INNER JOIN PLAYERS ON SCORES.playerID = PLAYERS.playerID
      INNER JOIN CATEGORIES ON SCORES.categoryID = CATEGORIES.categoryID
     WHERE SCORES.tournamentID = %u AND SCORES.roundNumber = %u"
  );

  define
  (
    "GET_NUM_ROUNDS_AND_TOTAL_PAR_BY_TOURNAMENT_ID_AND_CATEGORY_ID",
    "SELECT SCORECARDS.numRounds AS numRounds, COURSES.totalPar AS totalPar
     FROM SCORECARDS
      INNER JOIN COURSES ON SCORECARDS.courseID = COURSES.courseID
     WHERE tournamentID = %u AND categoryID = %u"
  );

  define
  (
    "DELETE_TOURNAMENT",
    "DELETE FROM TOURNAMENTS
     WHERE tournamentID = %u"
  );

  define
  (
    "ADD_9HOLE_COURSE",
    "INSERT INTO COURSES(clubName, stateLocation, countryLocation, numHoles, yardageUnits, par1, par2, par3, par4, par5, par6, par7, par8, par9)
     VALUES(\"%s\", \"%s\", \"%s\", 9, \"%s\", %s, %s, %s, %s, %s, %s, %s, %s, %s)"
  );

  define
  (
    "ADD_18HOLE_COURSE",
    "INSERT INTO COURSES(clubName, stateLocation, countryLocation, numHoles, yardageUnits, par1, par2, par3, par4, par5, par6, par7, par8, par9, par10, par11, par12, par13, par14, par15, par16, par17, par18)
     VALUES(\"%s\", \"%s\", \"%s\", 18, \"%s\", %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
  );

  define
  (
    "EDIT_COURSE_COURSENAME",
    "UPDATE COURSES
     SET courseName = \"%s\"
     WHERE courseID = %u"
  );

  define
  (
    "GET_LAST_COURSE_ADDED",
    "SELECT MAX(courseID) AS courseID
     FROM COURSES"
  );

  define
  (
    "ADD_9HOLE_YARDAGE",
    "INSERT INTO YARDAGES(distance1, distance2, distance3, distance4, distance5, distance6, distance7, distance8, distance9)
     VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s)"
  );

  define
  (
    "ADD_18HOLE_YARDAGE",
    "INSERT INTO YARDAGES(distance1, distance2, distance3, distance4, distance5, distance6, distance7, distance8, distance9, distance10, distance11, distance12, distance13, distance14, distance15, distance16, distance17, distance18)
     VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
  );

  define
  (
    "GET_LAST_YARDAGE_ADDED",
    "SELECT MAX(yardageID) AS yardageID
     FROM YARDAGES"
  );

  define
  (
    "ADD_TEEBOX",
    "INSERT INTO TEEBOXES(courseID, yardageID, colour)
     VALUES(%u, %u, \"%s\")"
  );

  define
  (
    "GET_COURSE",
    "SELECT *
     FROM COURSES
     WHERE courseID = %u"
  );

  define
  (
    "GET_TEEBOXES",
    "SELECT *
     FROM TEEBOXES INNER JOIN YARDAGES ON TEEBOXES.yardageID = YARDAGES.yardageID
     WHERE courseID = %u"
  );

  define
  (
    "EDIT_9HOLE_COURSE",
    "UPDATE COURSES
     SET clubName = \"%s\", courseName = NULL, stateLocation = \"%s\", countryLocation = \"%s\", numHoles = 9, yardageUnits = \"%s\", par1 = %s, par2 = %s, par3 = %s, par4 = %s, par5 = %s, par6 = %s, par7 = %s, par8 = %s, par9 = %s
     WHERE courseID = %u"
  );

  define
  (
    "EDIT_18HOLE_COURSE",
    "UPDATE COURSES
     SET clubName = \"%s\", courseName = NULL, stateLocation = \"%s\", countryLocation = \"%s\", numHoles = 18, yardageUnits = \"%s\", par1 = %s, par2 = %s, par3 = %s, par4 = %s, par5 = %s, par6 = %s, par7 = %s, par8 = %s, par9 = %s, par10 = %s, par11 = %s, par12 = %s, par13 = %s, par14 = %s, par15 = %s, par16 = %s, par17 = %s, par18 = %s
     WHERE courseID = %u"
  );

  define
  (
    "GET_YARDAGES",
    "SELECT *
     FROM TEEBOXES
     WHERE courseID = %u"
  );

  define
  (
    "EDIT_9HOLE_YARDAGE",
    "UPDATE YARDAGES
     SET distance1 = %s, distance2 = %s, distance3 = %s, distance4 = %s, distance5 = %s, distance6 = %s, distance7 = %s, distance8 = %s, distance9 = %s
     WHERE yardageID = %u"
  );

  define
  (
    "EDIT_18HOLE_YARDAGE",
    "UPDATE YARDAGES
     SET distance1 = %s, distance2 = %s, distance3 = %s, distance4 = %s, distance5 = %s, distance6 = %s, distance7 = %s, distance8 = %s, distance9 = %s, distance10 = %s, distance11 = %s, distance12 = %s, distance13 = %s, distance14 = %s, distance15 = %s, distance16 = %s, distance17 = %s, distance18 = %s
     WHERE yardageID = %u"
  );

  define
  (
    "EDIT_TEEBOX",
    "UPDATE TEEBOXES
     SET colour = \"%s\"
     WHERE courseID = %u AND yardageID = %u"
  );

  define
  (
    "DELETE_TEEBOX",
    "DELETE FROM TEEBOXES
     WHERE courseID = %u AND yardageID = %u"
  );

  define
  (
    "DELETE_YARDAGE",
    "DELETE FROM YARDAGES
     WHERE yardageID = %u"
  );

  define
  (
    "GET_COURSES",
    "SELECT COURSES.courseID AS courseID, clubName, courseName, stateLocation, countryLocation, numHoles, COUNT(*) AS numTeeBoxes
     FROM COURSES INNER JOIN TEEBOXES ON COURSES.courseID = TEEBOXES.courseID
     GROUP BY COURSES.courseID, courseName, numHoles
     ORDER BY clubName ASC, courseName ASC
     LIMIT %u"
  );

  define
  (
    "GET_ALL_COURSES",
    "SELECT courseID, clubName, courseName
     FROM COURSES
     ORDER BY clubName ASC, courseName ASC"
  );

  define
  (
    "GET_ALL_TEEBOXES",
    "SELECT yardageID, colour
     FROM TEEBOXES
     WHERE courseID = %u"
  );

  define
  (
    "GET_COURSES_BY_NAME_SEARCH",
    "SELECT COURSES.courseID AS courseID, clubName, courseName, stateLocation, countryLocation, numHoles, COUNT(*) AS numTeeBoxes
     FROM COURSES INNER JOIN TEEBOXES ON COURSES.courseID = TEEBOXES.courseID
     WHERE LOWER(clubName) LIKE \"%%%s%%\" AND LOWER(courseName) LIKE \"%%%s%%\"
     GROUP BY COURSES.courseID
     ORDER BY clubName ASC, courseName ASC
     LIMIT %u"
  );

  define
  (
    "DELETE_YARDAGES",
    "DELETE FROM YARDAGES
     WHERE yardageID IN (SELECT yardageID
                         FROM TEEBOXES
                         WHERE courseID = %u)"
  );

  define
  (
    "DELETE_TEEBOXES",
    "DELETE FROM TEEBOXES
     WHERE courseID = %u"
  );

  define
  (
    "DELETE_COURSE",
    "DELETE FROM COURSES
     WHERE courseID = %u"
  );
?>