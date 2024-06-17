<?php 
require_once MODEL . 'Connect.php';
class Sql extends Connect {

    private static $connect;
    public static function findAll() {
        self::$connect = self::connect();
        $sql = "SELECT * FROM users ORDER BY id DESC";
        try {
            $stmt = self::$connect->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            return "Erro: ". $err;
        }
    }

    public static function findOne($find) {    
        self::$connect = self::connect();

        $sql = "SELECT * FROM users WHERE id = :id";
        try {
            $stmt = self::$connect->prepare($sql);
            $stmt->bindValue(":id", $find);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            return "Erro: ". $err;
        }
    }

    public static function destroy($id) {
        self::$connect = self::connect();
        $sql = "DELETE * FROM users WHERE id = :id";
        try {
            $stmt = self::$connect->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return "Usuario deletado com sucesso!";
        } catch (PDOException $err) {
            return "Erro: ". $err;
        }
    }

    public static function create($data) {
        self::$connect = self::connect();
        $keys = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO users ($keys) VALUES ($placeholders)";
    
        try {
            $stmt = self::$connect->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return "Usuário criado com sucesso";
            } else {
                return "Erro: Nenhum registro foi inserido";
            }
        } catch (PDOException $err) {
            // Captura e trata erros PDO
            return "Erro: " . $err->getMessage();
        }
    }

    public static function update($id, $data) {
        $update_fields = [];
        foreach ($data as $key => $value) {
            $update_fields[] = "$key = :$key";
        }
        $set_clause = implode(', ', $update_fields);
        $sql = "UPDATE users SET $set_clause WHERE id = :id";
        try {
            self::$connect = self::connect();
            $stmt = self::$connect->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
            return "Usuario atualizado com sucesso";
        } catch (PDOException $err) {
            return "Erro: ". $err;
        }
    }

}

?>