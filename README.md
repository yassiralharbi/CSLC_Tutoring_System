# CSLC_Tutoring_System
The Computer Science learning centre tutoring system of the University of Adelaide 

This system is used for managing the tutoring sessions.

This is a detail-modified version of the project, the link of the original system is https://cs.adelaide.edu.au/users/honours/mciproject/mciproject_2015_a/mciproject/content.php
The authentication of original system is controlled by LDAP protocol, whereas my student ID is expired, so I changed the authentication mechanism of this modified version, where the information is stored in sessions.

Installation:
1. Put the codes into wherever you like.
2. Set the database configuation in shared/db.php
3. Import the database schema CSLC.sql.
4. Two accounts: a1641575 for the student user
                 a1066092 for the admin user.
5. Done
