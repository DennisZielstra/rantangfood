<?php

require_once 'Connections.php'; 

/**
 * Class Openings gets all the openinghours for each day.
 */
class Openings
{
    /**
     * Gets the days, status and openinghours for Hoogezand store.
     * @return null|string
     */
    public function openingsHz() 
    {
        $connections = new Connections();
        $connHoogezand = $connections->connHoogezand();
        
        $sqlHz = "SELECT * FROM OpeningstijdenHoogezand";
        $resultHz = $connHoogezand->query($sqlHz);
        $array = array();

        if ($resultHz->num_rows > 0) {
            while($rowHz = $resultHz->fetch_assoc()) {
                $array[] = 
                    $rowHz["Dag"] . " " . 
                    (
                        $rowHz["Gesloten"] === "J" ?
                        "Gesloten<br/>" : 
                        $rowHz["TijdVan"] . "-" . $rowHz["TijdTot"] . "u<br/>"
                    ); 
            }
        }
        
        return $array;
    }
}
