CREATE TABLE user_info(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  technology VARCHAR(50) NOT NULL,
  image VARCHAR(100)
) DEFAULT CHARSET utf8;

SELECT * FROM user_info;