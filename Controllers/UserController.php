<?php

require_once  './config.php';

class UserController
{
    function Select()
    {
        $db = new Connect;
        $users = array();
        $sql = "SELECT * FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        while ($db_data = $stmt->fetch()) {
            $users[$db_data['id']] = array(
                'id'       => $db_data['id'],
                'name'     => $db_data['name'],
                'email'    => $db_data['email'],
                'birthday' => $db_data['birthday'],
                'gender'   => $db_data['gender']
            );
        }
        return json_encode($users);
    }

    function SelectById($id)
    {
        $db = new Connect;
        $sql = "SELECT * FROM users WHERE id = :Id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':Id', $id);
        $stmt->execute();
        $user = $stmt->fetch();

        return json_encode($user);
    }

    function Create($user)
    {
        $db = new Connect;
        $sql = "INSERT INTO users (name, email, birthday, gender) VALUES(:Name, :Email, :Birthday, :Gender)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':Name', $user->name);
        $stmt->bindValue(':Email', $user->email);
        $stmt->bindValue(':Birthday', $user->birthday);
        $stmt->bindValue(':Gender', $user->gender);

        if ($stmt->execute()) {
            return http_response_code(200);
        } else {
            return http_response_code(400);
        }
    }

    function Update($user)
    {
        $db = new Connect;
        $sql = "UPDATE users SET name = :Name, email =:Email, birthday = :Birthday, gender = :Gender WHERE id = :Id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':Id', $user->id);
        $stmt->bindValue(':Name', $user->name);
        $stmt->bindValue(':Email', $user->email);
        $stmt->bindValue(':Birthday', $user->birthday);
        $stmt->bindValue(':Gender', $user->gender);

        if ($stmt->execute()) {
            return http_response_code(200);
        } else {
            return http_response_code(400);
        }
    }

    function Delete($id)
    {
        $db = new Connect;
        $sql = "DELETE FROM users WHERE id = :Id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':Id', $id);

        if ($stmt->execute()) {
            return http_response_code(200);
        } else {
            return http_response_code(400);
        }
    }
}

?>