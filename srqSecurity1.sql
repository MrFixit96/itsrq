# phpMyAdmin SQL Dump
# version 2.5.7-pl1
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Nov 05, 2007 at 12:44 PM
# Server version: 4.0.20
# PHP Version: 4.3.9
# 
# Database : `service_requests`
# 

# --------------------------------------------------------# --------------------------------------------------------

#
# Table structure for table `security`
#

CREATE TABLE `security` (
  `Name` varchar(50) NOT NULL default '',
  `Password` varchar(25) NOT NULL default '',
  `Maintenance` char(2) default NULL,
  `ITServices` char(2) default NULL
) TYPE=MyISAM;

#
# Dumping data for table `security`
#

INSERT INTO `security` VALUES ('bf', 'besafe', NULL, '1');
INSERT INTO `security` VALUES ('rminner', 'wlj4o', '1', NULL);
INSERT INTO `security` VALUES ('jcaa', 'j19a96', '1', '1');
INSERT INTO `security` VALUES ('shutton', '9waye', '1', '1');
INSERT INTO `security` VALUES ('maintenance', 'organize', '1', NULL);
INSERT INTO `security` VALUES ('kforsberg', 'kf123', '1', NULL);
INSERT INTO `security` VALUES ('jmiller', 'g5r6q', '1', '1');
INSERT INTO `security` VALUES ('llane', 'sted4', '1', NULL);
INSERT INTO `security` VALUES ('bbridges', 'corvette98', '1', NULL);
INSERT INTO `security` VALUES ('kabel', 't4es6', NULL, 'NULL');
INSERT INTO `security` VALUES ('sackerman', 'se5he', NULL, 'NULL');
INSERT INTO `security` VALUES ('admissions', 'ya7ub', NULL, 'NULL');
INSERT INTO `security` VALUES ('jcaa', 'jNULL9a96', NULL, 'NULL');
INSERT INTO `security` VALUES ('jcar', '3wemu', NULL, 'NULL');
INSERT INTO `security` VALUES ('gbachman', '9aweg', NULL, 'NULL');
INSERT INTO `security` VALUES ('dbailey', '8egac', NULL, 'NULL');
INSERT INTO `security` VALUES ('sberger', 'jadr8', NULL, 'NULL');
INSERT INTO `security` VALUES ('mbosma', '83axu', NULL, 'NULL');
INSERT INTO `security` VALUES ('jbruer', '2aste', NULL, 'NULL');
INSERT INTO `security` VALUES ('bclaxton', 'yech4', NULL, 'NULL');
INSERT INTO `security` VALUES ('ddavison', 'ce72r', NULL, 'NULL');
INSERT INTO `security` VALUES ('sdougherty', 'ju52c', NULL, 'NULL');
INSERT INTO `security` VALUES ('bgardner', 'qac4u', NULL, 'NULL');
INSERT INTO `security` VALUES ('dhill', 'wev28', NULL, 'NULL');
INSERT INTO `security` VALUES ('khutchins', '8wa9e', NULL, 'NULL');
INSERT INTO `security` VALUES ('shutton', 'c9phu', NULL, 'NULL');
INSERT INTO `security` VALUES ('dkratz', 'druv5', NULL, 'NULL');
INSERT INTO `security` VALUES ('blindstrom', 'f3qab', NULL, 'NULL');
INSERT INTO `security` VALUES ('jmiller', '3uswu', NULL, 'NULL');
INSERT INTO `security` VALUES ('rminner', '5e7wa', NULL, 'NULL');
INSERT INTO `security` VALUES ('jmosier', 'sta2e', NULL, 'NULL');
INSERT INTO `security` VALUES ('pcsmail', 'th9ru', NULL, 'NULL');
INSERT INTO `security` VALUES ('nrugaard', 'ne6ha', NULL, 'NULL');
INSERT INTO `security` VALUES ('lsalzer', 'pru2a', NULL, 'NULL');
INSERT INTO `security` VALUES ('tschlich', 'naph5', NULL, 'NULL');
INSERT INTO `security` VALUES ('msinger', 'tra5u', NULL, 'NULL');
INSERT INTO `security` VALUES ('jtolson', 'yuqu3', NULL, 'NULL');
INSERT INTO `security` VALUES ('ttriphan', '7ufr7', NULL, 'NULL');
INSERT INTO `security` VALUES ('cweaver', '4apew', NULL, 'NULL');
INSERT INTO `security` VALUES ('pwerking', 's6efr', NULL, 'NULL');
INSERT INTO `security` VALUES ('jahlrich', 'tru9r', NULL, 'NULL');
INSERT INTO `security` VALUES ('manderson', 'kac8e', NULL, 'NULL');
INSERT INTO `security` VALUES ('bbackstrom', '8tast', NULL, 'NULL');
INSERT INTO `security` VALUES ('lbaker', 'f9j4c', NULL, 'NULL');
INSERT INTO `security` VALUES ('jbennington', 'n6spe', NULL, 'NULL');
INSERT INTO `security` VALUES ('kbordeaux', 'h5che', NULL, 'NULL');
INSERT INTO `security` VALUES ('sbowers2', '6uq9r', NULL, 'NULL');
INSERT INTO `security` VALUES ('sbowers', 'tr7st', NULL, 'NULL');
INSERT INTO `security` VALUES ('cboyer', '7ucra', NULL, 'NULL');
INSERT INTO `security` VALUES ('bbrawley', 'w9wre', NULL, 'NULL');
INSERT INTO `security` VALUES ('bbridges', 'gu3r9', NULL, 'NULL');
INSERT INTO `security` VALUES ('sburnet', 'dr32e', NULL, 'NULL');
INSERT INTO `security` VALUES ('kcarroll', 'p2e4q', NULL, 'NULL');
INSERT INTO `security` VALUES ('dclose', 'b3eja', NULL, 'NULL');
INSERT INTO `security` VALUES ('kcordes', 'sp4va', NULL, 'NULL');
INSERT INTO `security` VALUES ('lcrawford', 't8rur', NULL, 'NULL');
INSERT INTO `security` VALUES ('kdeal', '4rac7', NULL, 'NULL');
INSERT INTO `security` VALUES ('cdoades', 'h3f9v', NULL, 'NULL');
INSERT INTO `security` VALUES ('mduez', 'vucr2', NULL, 'NULL');
INSERT INTO `security` VALUES ('lelliott', 'wr3ga', NULL, 'NULL');
INSERT INTO `security` VALUES ('celliott', '8afra', NULL, 'NULL');
INSERT INTO `security` VALUES ('jfay', 'ra2ha', NULL, 'NULL');
INSERT INTO `security` VALUES ('bfisk', 'x5h8k', NULL, 'NULL');
INSERT INTO `security` VALUES ('kforsberg', 'tuc9u', NULL, 'NULL');
INSERT INTO `security` VALUES ('ffox', '9r7st', NULL, 'NULL');
INSERT INTO `security` VALUES ('sfritz', 'suf6u', NULL, 'NULL');
INSERT INTO `security` VALUES ('rfurston', 'cru9u', NULL, 'NULL');
INSERT INTO `security` VALUES ('mgarcia', 'swu62', NULL, 'NULL');
INSERT INTO `security` VALUES ('cgerard', 'dr3mu', NULL, 'NULL');
INSERT INTO `security` VALUES ('jgray', '3usaf', NULL, 'NULL');
INSERT INTO `security` VALUES ('dgray', 'b8na5', NULL, 'NULL');
INSERT INTO `security` VALUES ('ahatfield', 'yuth2', NULL, 'NULL');
INSERT INTO `security` VALUES ('thauter', 'wez3b', NULL, 'NULL');
INSERT INTO `security` VALUES ('cherrmann', 'pr3z3', NULL, 'NULL');
INSERT INTO `security` VALUES ('khodge', 'q7w6r', NULL, 'NULL');
INSERT INTO `security` VALUES ('ahoffmann', '4ruku', NULL, 'NULL');
INSERT INTO `security` VALUES ('showard', 't77th', NULL, 'NULL');
INSERT INTO `security` VALUES ('chynek', 've5ap', NULL, 'NULL');
INSERT INTO `security` VALUES ('tjudd', 'swa8p', NULL, 'NULL');
INSERT INTO `security` VALUES ('tkieft', '7e5we', NULL, 'NULL');
INSERT INTO `security` VALUES ('mlanderdahl', '4r5wu', NULL, 'NULL');
INSERT INTO `security` VALUES ('llane', '3ru8e', NULL, 'NULL');
INSERT INTO `security` VALUES ('alyons', 'kab7e', NULL, 'NULL');
INSERT INTO `security` VALUES ('jlyons', 'qenu7', NULL, 'NULL');
INSERT INTO `security` VALUES ('tmcginnis', 'swe63', NULL, 'NULL');
INSERT INTO `security` VALUES ('kmescher', 'k9t2z', NULL, 'NULL');
INSERT INTO `security` VALUES ('jmiller2', 'j5t7r', NULL, 'NULL');
INSERT INTO `security` VALUES ('kmoser', 'st2ha', NULL, 'NULL');
INSERT INTO `security` VALUES ('bnielson', 'ch2ta', NULL, 'NULL');
INSERT INTO `security` VALUES ('jparis', 'k5cr8', NULL, 'NULL');
INSERT INTO `security` VALUES ('jpittman', 'q93dt', NULL, 'NULL');
INSERT INTO `security` VALUES ('mproehl', 'sp8sw', NULL, 'NULL');
INSERT INTO `security` VALUES ('jringenberg2', '5uha7', NULL, 'NULL');
INSERT INTO `security` VALUES ('drohrer', 'h3th2', NULL, 'NULL');
INSERT INTO `security` VALUES ('crumba', 'jaq2g', NULL, 'NULL');
INSERT INTO `security` VALUES ('ssaatkamp', 'm3k6v', NULL, 'NULL');
INSERT INTO `security` VALUES ('lschenck', 'g48es', NULL, 'NULL');
INSERT INTO `security` VALUES ('tschoon', 'qudu2', NULL, 'NULL');
INSERT INTO `security` VALUES ('sshobert', 'p5ju8', NULL, 'NULL');
INSERT INTO `security` VALUES ('rshobert', 'm4bub', NULL, 'NULL');
INSERT INTO `security` VALUES ('jsmith', '7efar', NULL, 'NULL');
INSERT INTO `security` VALUES ('astreenz', 'duw9u', NULL, 'NULL');
INSERT INTO `security` VALUES ('ataylor', 'fra38', NULL, 'NULL');
INSERT INTO `security` VALUES ('dtracy', 'f3kab', NULL, 'NULL');
INSERT INTO `security` VALUES ('eurban', 'vufu3', NULL, 'NULL');
INSERT INTO `security` VALUES ('bvarner', '66asa', NULL, 'NULL');
INSERT INTO `security` VALUES ('jwalker', 'wetr6', NULL, 'NULL');
INSERT INTO `security` VALUES ('jweyer', 'swu3u', NULL, 'NULL');
INSERT INTO `security` VALUES ('awhite', 'suh5w', NULL, 'NULL');
INSERT INTO `security` VALUES ('swiele', 'x5kep', NULL, 'NULL');
INSERT INTO `security` VALUES ('kmiller', 'b22ra', NULL, 'NULL');
