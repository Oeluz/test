<?php
    class Event_DB {

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

        function getAllEvents(){

            try {
                $data = array();
    
                $stmt = $this->dbh->prepare("SELECT * FROM events");
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

        function getSessionsForEvent($id){
            try {
                $data = array();
    
                $query = "SELECT * FROM session WHERE event = :id";

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

        function addEvent($name, $dateStart, $dateEnd, $numberAllowed, $venue) {
            try {
                $query = "INSERT INTO event (name, datestart, dateend, numberallowed, venue)
                            VALUES(:name, :datestart, :dateend, :numberallowed, :venue";
                
                $stmt = $this->dbh->prepare($query);

                $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                $stmt->bindParam(":datestart", $dateStart, PDO::PARAM_STR);
                $stmt->bindParam(":dateend", $dateEnd, PDO::PARAM_STR);
                $stmt->bindParam(":numberallowed", intval($numberAllowed), PDO::PARAM_INT);
                $stmt->bindParam(":venu", intval($venue), PDO::PARAM_INT);
    
                $stmt->execute();
                
                return $this->dbh->lastInsertId();
            } catch (PDOException $pe) {
                echo $pe->getMessage();
                return 0;
            }
        }

        function updateEvent($id, $name, $dateStart, $dateEnd, $numberAllowed) {
            try {
                $query = "UPDATE event
                            SET name = :name, dateStart = :datestart, dateEnd = :dateEnd, numberAllowed = :numberallowed
                            WHERE idevent = :id";
                $stmt = $this->dbh->prepare($query);

                $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                $stmt->bindParam(":datestart", $dateStart, PDO::PARAM_STR);
                $stmt->bindParam(":dateend", $dateEnd, PDO::PARAM_STR);
                $stmt->bindParam(":numberallowed", intval($numberAllowed), PDO::PARAM_INT);
                $stmt->bindParam(":id", intval($id), PDO::PARAM_INT);

                $stmt->execute();
                
                return $stmt->rowCount();
            } catch (PDOException $pe) {
                echo $pe->getMessage();
                return 0;
            }
        }

        function deleteEvent($id) {
            try {
                $query = "DELETE FROM event WHERE idattendee = :id";
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