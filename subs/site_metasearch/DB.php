<?php
include_once("config.php");
class DB
{
    //PDO
    private static $conn;
    public static function getConn()
    {
        try {
            if (!isset(self::$conn)) {
                self::$conn = new PDO('mysql:host=' . HOSTNAME . ';charset=utf8mb4;port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            }
            return self::$conn;
        } catch (PDOException $e) {
            echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
        }
    }

    public function getImovel($id)
    {
        $conn = self::getConn();
        try {
            $stmt = $conn->prepare("SELECT * FROM current_properties WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
        }
    }
    public function getTypes()
    {
        $conn = self::getConn();

        $stmt = $conn->prepare("SELECT DISTINCT type FROM current_properties");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getImoveis($areaMin, $areaMax, $tipo, $precoMin, $precoMax, $quartos, $banheiros, $freguesia, $distrito, $cidade, $limit, $offset)
    {
        try {
            $conn = self::getConn();

            // Apply filters dynamically
            $sql = "SELECT * FROM current_properties WHERE sold = 0";

            if ($areaMin != null) {
                $sql .= " AND gross_area >= " . $areaMin;
            }
            if ($areaMax != null) {
                $sql .= " AND gross_area <= " . $areaMax;
            }
            if ($tipo != null && $tipo != "none") {
                $sql .= " AND type like '" . $tipo . "'";
            }
            if ($precoMin != null) {
                $sql .= " AND price >= " . $precoMin;
            }
            if ($precoMax != null) {
                $sql .= " AND price <= " . $precoMax;
            }
            if ($quartos != null) {
                $sql .= " AND bedroom_number = " . $quartos;
            }
            if ($banheiros != null) {
                $sql .= " AND bathroom_number = " . $banheiros;
            }
            if ($freguesia != null && $freguesia != "none") {
                $sql .= " AND freguesia LIKE '%" . $freguesia . "%' COLLATE utf8mb4_unicode_ci ";
            }
            if ($cidade != null && $cidade != "none") {
                $sql .= " AND cidade LIKE '%" . $cidade . "%' COLLATE utf8mb4_unicode_ci ";
            } else if ($distrito != null && $distrito != "none") {
                $sql .= " AND distrito LIKE '%" . $distrito . "%' COLLATE utf8mb4_unicode_ci ";
            }

            // Append LIMIT and OFFSET directly (casting to int for safety)
            $limit = (int) $limit;
            $offset = (int) $offset;
            $sql .= " ORDER BY price ASC LIMIT {$limit} OFFSET {$offset}";

            $stmt = $conn->prepare($sql);

            $params = array_values(array_filter([
                $areaMin,
                $areaMax,
                $tipo,
                $precoMin,
                $precoMax,
                $quartos,
                $banheiros,
                $freguesia,
                $distrito,
                $cidade
            ], function ($value) {
                return !is_null($value); }));

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function getTotalImoveis($areaMin, $areaMax, $tipo, $precoMin, $precoMax, $quartos, $banheiros, $freguesia, $distrito, $cidade, $limit, $offset)
    {
        $conn = self::getConn();

        $sql = "SELECT count(*) FROM current_properties WHERE sold=0 AND price > 0";
        if ($areaMin != null) {
            $sql .= " AND gross_area >= " . $areaMin;
        }
        if ($areaMax != null) {
            $sql .= " AND gross_area <= " . $areaMax;
        }
        if ($tipo != null && $tipo != "none") {
            $sql .= " AND type like '" . $tipo . "'";
        }
        if ($precoMin != null) {
            $sql .= " AND price >= " . $precoMin;

        }
        if ($precoMax != null) {
            $sql .= " AND price <= " . $precoMax;

        }
        if ($quartos != null) {
            $sql .= " AND bedroom_number = " . $quartos;

        }
        if ($banheiros != null) {
            $sql .= " AND bathroom_number = " . $banheiros;

        }
        if ($freguesia != null && $freguesia != "none") {
            $sql .= " AND (freguesia) COLLATE utf8mb4_unicode_ci LIKE ('%" . $freguesia . "%')";

        }
        if ($distrito != null && $distrito != "none") {
            if ($distrito == "Ilha da Madeira") {
                $distrito = "madeira";
            }


            $sql .= " AND LOWER(distrito) COLLATE utf8mb4_unicode_ci like LOWER('%" . $distrito . "%')";

        }
        if ($cidade != null && $cidade != "none") {
            $sql .= " AND LOWER(cidade) COLLATE utf8mb4_unicode_ci = LOWER('" . $cidade . "')";

        }


        $stmt = $conn->query($sql);
        return $stmt->fetchColumn();
    }



}
?>