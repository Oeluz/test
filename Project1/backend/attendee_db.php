<?php
    class Attendee_DB {

        private $dbh;
    
        function __construct(){
            try{
                $this->dbh = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}",
                $_SERVER['DB_USER'],
                $_SERVER['DB_PASSWORD']);
    
            } catch (PDOException $pe) {
                echo $pe->getMessage();
                die("Bad Database");
            } //catch
        } //construct

        function getAllAttendees(){

            try {
                $data = array();
    
                $stmt = $this->dbh->prepare("SELECT * FROM attendee");
                $stmt->execute();
                
    
                while ($row = $stmt->fetch()) {
                    $data[] = $row;
                }
    
                return $data;
    
            } catch (PDOException $pe) {
                echo $pe->getMessage();
                return $data;
            }
    
        } //getPerson

        function getEventForAttendee($id){
            try {
                $data = array();
    
                $query = "SELECT * FROM event\n
                        INNER JOIN attendee_event ae1 ON event.idevent = ae1.event\n
                        INNER JOIN attendee_event ae2 ON ae2.attendee = :id";

                $stmt = $this->dbh->prepare($query);
                
                $stmt->bindParam(":id", intval($id), PDO::PARAM_INT);
                $stmt->execute();
                
                while ($row = $stmt->fetch()) {
                    $data[] = $row;
                }
    
                return $data;
    
            } catch (PDOException $pe) {
                echo $pe->getMessage();
                return $data;
            }
        }

        function addAttendee($name, $password, $role) {
            try {
                $query = "INSERT INTO attendee (name, password, role)
                            VALUES (:name, :password, :role)";
                
                $stmt = $this->dbh->prepare($query);

                $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                $stmt->bindParam(":password", hash("sha256", $password), PDO::PARAM_STR);
                $stmt->bindParam(":role", $role, PDO::PARAM_INT);
    
                $stmt->execute();
                
                return $this->dbh->lastInsertId();
            } catch (PDOException $pe) {
                echo $pe->getMessage();
                return 0;
            }
        }

        function updateAttendeePassword($id, $password) {
            try {
                $query = "UPDATE attendee
                            SET password = :password
                            WHERE idattendee = :id";
                $stmt = $this->dbh->prepare($query);

                $stmt->bindParam(":password", hash("sha256", $password), PDO::PARAM_STR);
                $stmt->bindParam(":id", intval($id), PDO::PARAM_INT);

                $stmt->execute();
                
                return $stmt->rowCount();
            } catch (PDOException $pe) {
                echo $pe->getMessage();
                return 0;
            }
        }

        function deleteAttendee($id) {
            try {
                $query = "DELETE FROM attendee WHERE idattendee = :id";
                $stmt = $this->dbh->prepare($query);

                $stmt->bindParam(":id", intval($id), PDO::PARAM_INT);
                $stmt->execute();

                return $stmt->rowCount();
            } catch (PDOException $pe) {
                echo $pe->getMessage();
                return 0;
            }
        }
    }
?>