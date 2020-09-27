DROP DATABASE IF EXISTS tradeslink;
create database tradeslink;

use tradeslink;

CREATE USER 'webuser'@'localhost' 
  IDENTIFIED BY 'secretpassword';

GRANT ALL ON tradeslink.* TO 'webuser'@'localhost';

DROP TABLE IF EXISTS `users`;
CREATE TABLE users
(
    id INT(11) NOT NULL
    AUTO_INCREMENT,
    first_name VARCHAR
    (255),
    last_name VARCHAR
    (255),
    phone_number VARCHAR
    (255),
    email VARCHAR
    (255),
    hashed_password  VARCHAR
    (255),
	street VARCHAR
    (255),
	city VARCHAR
    (255),
	province VARCHAR
    (255),
    postal_code VARCHAR
    (7),
   
    PRIMARY KEY
    (id)   
);

    ALTER TABLE users ADD INDEX index_email (email);

    CREATE TABLE providers
    (
        id INT(11) NOT NULL
        AUTO_INCREMENT,
    first_name VARCHAR
        (255),
    last_name VARCHAR
        (255),
    phone_number VARCHAR
        (255),
    email VARCHAR
        (255),
    hashed_password  VARCHAR
        (255),
    business_name VARCHAR
        (255),
	street VARCHAR
        (255),
	city VARCHAR
        (255),
	province VARCHAR
        (255),
    postal_code VARCHAR
        (7),
    profession VARCHAR
        (255),
    preferred_area VARCHAR
        (255),
    available VARCHAR
        (20),
    price_per_hour INT DEFAULT NULL,

    PRIMARY KEY
        (id)
);

        ALTER TABLE providers ADD INDEX index_email (email);


            DROP TABLE IF EXISTS `bookings`;
            CREATE TABLE `bookings`
            (
  `id` int
            (11) NOT NULL AUTO_INCREMENT,
  `user_id` int
            (11) DEFAULT NULL,
    `provider_id` int
            (11) DEFAULT NULL,
  `date` varchar
            (30) DEFAULT NULL,
  `time` varchar
            (30) DEFAULT NULL,
  PRIMARY KEY
            (`id`),
  KEY `fk_user_id`
            (`user_id`),
            KEY `fk_provider_id`
            (`provider_id`)
);

            -- ------------------Tables Filled------------------
            INSERT INTO users
                (first_name ,last_name, phone_number, email, hashed_password, street, city, province, postal_code)
            VALUES
                ('Gurinder'  , 'G'  , '778-321-1086', 'gurinderg@hotmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', '1280 Homer Street', 'Langley'  , 'B.C.', 'V9N 9E1'),
                ('Ripandeep', 'Mann' , '778-864-4738', 'ripanmann@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', '1280 Homer Street', 'Langley'  , 'B.C.', 'V9N 9E1'),
                ('Asees', 'Singh' , '778-864-4738', 'asees@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', '1280 Homer Street', 'Langley'  , 'B.C.', 'V9N 9E1'),
                ('Sahil' , 'B', '778-620-6984', 'sahilb@hotmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', '1280 Homer Street', 'Langley'  , 'B.C.', 'V9N 9E1');


            INSERT INTO providers
                (first_name ,last_name, phone_number, email, hashed_password, business_name, street, city, province, postal_code, profession, preferred_area, available, price_per_hour)
            VALUES
                ('Arjun', 'Sahota', '778-111-1086', 'arjunsahota@hotmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'TradesLink', '1280 Homer Street', 'Langley'  , 'B.C.', 'V9N 9E1', 'Plumber', 'Vancouer', 'Availabile', 112),
                ('Andy', 'James', '778-525-9463', 'andyjames@outlook.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Harman Painting', ' 123 Robson St.', 'Vancouver', 'B.C.', 'V7E 1P3', 'Painter', 'Vancouver', 'Busy', 122),
                ('Billy', 'White', '778-321-8585', 'billywhite@hotmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'JTH Finishing Carpentry ', '9277 Scott Rd.' , 'Surrey'  , 'B.C.', 'V5N 0S9', 'Carpenter', 'Surrey', 'Call', 143),
                ('Ronnie', 'Kang', '778-741-9853', 'ronniang@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'React Fast Plumbing & Heating', 'King George Hwy.', 'Langley'  , 'B.C.', 'V1W 0R4', 'Electrician' , 'Langley', 'Available', 25),
                ('Kyle', 'Wang', '778-741-8756', 'kylewang@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Save More Roofing', '14328 84 A Ave', 'Surrey'  , 'B.C.', 'V3W 0Z9', 'Roofer' , 'Surrey', 'Busy', 42),
                ('Sarah', 'Smith', '778-784-9632', 'sarahsmith@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Accolade Plumbing and Heating', '12592 102 Ave', 'Surrey'  , 'B.C.', 'V3V 3E4', 'Plumber' , 'Surrey', 'Call', 52),
                ('Priya', 'Kang', '778-146-9516', 'priyakang@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Milani Plumbing, Heating & Air Conditioning', '10581 King George Blvd', 'Surrey'  , 'B.C.', 'V3T 2X5', 'Plumber' , 'Surrey', 'Available', 43),
                ('Jeevan', 'Singh', '778-563-4589', 'jeevansingh@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Impact Electric Ltd', '1473 Blackwood St', 'White Rock'  , 'B.C.', 'V4B 3V6', 'Electrician' , 'White Rock', 'Call', 60 ),
                ('Dan', 'Hills', '778-741-9856', 'danhills@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Hilltop Plumbing & Heating Ltd.', '1341 Johnston Rd', 'White Rock'  , 'B.C.', 'V4B 3Z3', 'Plumber' , 'White Rock', 'Available', 43),
                ('Bill', 'Garrett', '778-741-9853', 'billgarrett@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Bills Electrical Services Ltd', '8042 Coopershawk', 'Surrey'  , 'B.C.', 'V3W 0V1', 'Electrician' , 'Surrey', 'Busy', 35),
                ('Ronnie', 'Kang', '778-741-9853', 'ronniekang@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Wire-Man Electric LTD Surrey', '13809 78a Ave', 'Surrey'  , 'B.C.', 'V3W 2Y4', 'Electrician' , 'Surrey', 'Available', 54),
                ('Andy', 'Wu', '778-741-9853', 'andywu@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Langley Home Plumbing & Heating', '20821 Fraser Hwy', 'Langley'  , 'B.C.', 'V3A 0B6', 'Plumber' , 'Langley', 'Call', 62),
                ('Harpreet', 'Kang', '778-741-9853', 'harpreetkang@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Good Guys Heating Cooling & Plumbing', '12981 80 Ave', 'Surrey'  , 'B.C.', 'V3W 3B1', 'Plumber' , 'Surrey', 'Available', 56),
                ('Jasmine', 'Kaur', '778-741-9853', 'jasminekaur@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Langley Plumbing Company', '20420 Douglas Crescent', 'Langley'  , 'B.C.', 'V3A 4B6', 'Plumber' , 'Langley', 'Call', 49),
                ('Bill', 'Smith', '778-875-1753', 'billsmith@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Accurate Roofing Ltd', '2818 Main St', 'Vancouver'  , 'B.C.', 'V5T 0C1', 'Roofer' , 'Vancouver', 'Busy', 33),
                ('Amari', 'Cooper', '778-324-9455', 'amaricooper@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Cooper Roofing Vancouver', '285 W Broadway,', 'Vancouver'  , 'B.C.', 'V6H 3X8', 'Roofer' , 'Vancouver', 'Available', 69),
                ('Kevin', 'Wang', '778-741-9853', 'kevinwang@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Papa Plumbing Heating & Drainage Ltd', '14665 64 Ave', 'Surrey'  , 'B.C.', 'V3S 1X6', 'Plumber' , 'Surrey', 'Call', 43),
                ('Devin', 'Bender', '778-741-9853', 'devinbender@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Bender Painting & Decorating Ltd', '12837 76 Ave', 'Surrey'  , 'B.C.', 'V3W 2V3', 'Painter' , 'Surrey', 'Busy', 46),
                ('June', 'McDaniels', '778-741-9853', 'junemcdaniels@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Pink Painters Ltd', '4550 206 St', 'Langley'  , 'B.C.', 'V3A 2B7', 'Painter' , 'Langley', 'Available', 52),
                ('Ron', 'Parker', '778-555-7892', 'ripanman@gmail.com', '$2y$10$1L7TmItGJ.mKwd/0pzPQm.mteCdSKUAW9U6WDUTF1D7aLhgkpNU9y', 'Nightingale Electrical Ltd', '11121 Horseshoe Way', 'Richmond'  , 'B.C.', 'V7A 5G7', 'Electrician' , 'Richmond', 'Call', 48);
