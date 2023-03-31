<?php
spl_autoload_register(function ($class) {
    require __DIR__ . "/../COMMON/$class.php";
});

set_exception_handler("errorHandler::handleException");
set_error_handler("errorHandler::handleError");

class Certification
{
    private PDO $conn;
    private Connect $db;

    public function __construct() //Si connette al DB.
    {
        $this->db = new Connect;
        $this->conn = $this->db->getConnection();
    }

    public function getArchiveCertification() //Ritorna tutte le certificazioni.
    {
        $query = "SELECT id, acronym, name
        from certification c";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
