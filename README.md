# Rest_Api_Exercise

Database Creation Query

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(20) CHARACTER SET utf8 NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



HTTP Requests

1. Create User

    POST => "/"

    Body:

        {
            "name" : String,
            "email" : String,
            "birthday" : String,
            "gender": String
        }

        Birthday format: "yyyy-mm-dd"


2. List Users

    GET => "/"


3. Delete User

    DELETE => "/?id={id}"


4. Update User

    PUT => "/"

    Body:

        {
            "id": Int,
            "name" : String,
            "email" : String,
            "birthday" : String,
            "gender": String
        }

        Birthday format: "yyyy-mm-dd"


5. View User

    GET => "/?id={id}"
