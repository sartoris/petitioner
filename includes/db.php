<?php

require_once 'site.cfg';
$connection = new mysqli($hostname, $username, $password, $databaseName);

function getStates ($state) {
    global $connection;
    if($state == 'NA')
        $list = "<option selected>NA</option>";
    else
        $list = "<option>NA</option>";
    $query = "SELECT LongName FROM `State`";
    $result = $connection->query($query);
    if($result === FALSE) { 
        $list = "ERROR: " . $connection->error;
    }
    else {
        while($row = mysqli_fetch_array($result))
        {
            if ($row[0] == $state)
                $list = $list."<option selected>$row[0]</option>";
            else
                $list = $list."<option>$row[0]</option>";
        }
    }
    return $list;
}

function getCounties ($county) {
    global $connection;
    if($county == '')
        $list = "<option selected value=''>--</option>";
    else
        $list = "<option value=''>--</option>";
    $query = "SELECT * FROM `County`";
    $result = $connection->query($query);
    if($result === FALSE) { 
        $list = "ERROR: " . $connection->error;
    }
    else {
        while($row = mysqli_fetch_array($result))
        {
            if ($row[0] == $county)
                $list = $list."<option selected>$row[0]</option>";
            else
                $list = $list."<option>$row[0]</option>";
        }
    }
    return $list;
}

function getOrganizations ($organization) {
    global $connection;
    if($organization == 0)
        $list = "<option value=0 selected>--</option>";
    else
        $list = "<option value=0>--</option>"; 
    $query = "SELECT ID, Name FROM `Organization` ORDER BY Name";
    $result = $connection->query($query);
    if($result === FALSE) { 
        $list = "ERROR: " . $connection->error;
    }
    else {
        while($row = mysqli_fetch_array($result))
        {
            if ($row[0] == $organization)
                $list = $list."<option value=$row[0] selected>$row[1]</option>";
            else
                $list = $list."<option value=$row[0]>$row[1]</option>";
        }
    }
    return $list;
}

function getDepots ($depot) {
    global $connection;
    if($depot == 0)
        $list = "<option value=0 selected>--</option>";
    else
        $list = "<option value=0>--</option>"; 
    $query = "SELECT ID, Name FROM `Depot` ORDER BY Name";
    $result = $connection->query($query);
    if($result === FALSE) { 
        $list = "ERROR: " . $connection->error;
    }
    else {
        while($row = mysqli_fetch_array($result))
        {
            if ($row[0] == $depot)
                $list = $list."<option value=$row[0] selected>$row[1]</option>";
            else
                $list = $list."<option value=$row[0]>$row[1]</option>";
        }
    }
    return $list;
}

function getContacts ($contact) {
    global $connection;
    if($contact == 0)
        $list = "<option value=0 selected>--</option>";
    else
        $list = "<option value=0 >--</option>";
    $query = "SELECT ID, LastName, FirstName FROM `Person` WHERE isPending=0 ORDER BY LastName, FirstName";
    $result = $connection->query($query);
    if($result === FALSE) { 
        $list = "ERROR: " . $connection->error;
    }
    else {
        while($row = mysqli_fetch_array($result))
        {
            if ($row[0] == $contact)
                $list = $list."<option value=$row[0] selected>$row[1]".", "."$row[2]</option>";
            else
                $list = $list."<option value=$row[0]>$row[1]".", "."$row[2]</option>";
        }
    }
    return $list;
}

function getPendingContacts ($contact) {
    global $connection;
    $list = "";
    if($contact == 0)
        $list = "<option value=0 selected>--</option>";
    else
        $list = "<option value=0 >--</option>";
    $query = "SELECT ID, LastName, FirstName FROM `Person` WHERE isPending=1 ORDER BY LastName, FirstName";
    $result = $connection->query($query);
    if($result === FALSE) { 
        $list = "ERROR: " . $connection->error;
    }
    else {
        while($row = mysqli_fetch_array($result))
        {
            if ($row[0] == $contact) {
                $list = $list."<option value=$row[0] selected>$row[1]".", "."$row[2]</option>";
            }
            else
                $list = $list."<option value=$row[0]>$row[1]".", "."$row[2]</option>";
        }
    }
    return $list;
}

function getCoordinators () {
    global $connection;
    $list = "<option value=0 selected>--</option>";
    $query = "SELECT ID, LastName, FirstName FROM `Person` WHERE isPending=0 AND isCoordinator=1 ORDER BY LastName, FirstName";
    $result = $connection->query($query);
    if($result === FALSE) { 
        $list = "ERROR: " . $connection->error;
    }
    else {
        while($row = mysqli_fetch_array($result))
        {
            $list = $list."<option value=$row[0]>$row[1]".", "."$row[2]</option>";
        }
    }
    return $list;
}

function getCirculators () {
    global $connection;
    $list = "<option value=0 selected>--</option>";
    $query = "SELECT ID, LastName, FirstName FROM `Person` WHERE isPending=0 AND isPetitioner=1 ORDER BY LastName, FirstName";
    $result = $connection->query($query);
    if($result === FALSE) { 
        $list = "ERROR: " . $connection->error;
    }
    else {
        while($row = mysqli_fetch_array($result))
        {
            $list = $list."<option value=$row[0]>$row[1]".", "."$row[2]</option>";
        }
    }
    return $list;
}

function getAmbassadors () {
    global $connection;
    $list = "<option value=0 selected>--</option>";
    $query = "SELECT ID, LastName, FirstName FROM `Person` WHERE isPending=0 AND isAmbassador=1 ORDER BY LastName, FirstName";
    $result = $connection->query($query);
    if($result === FALSE) { 
        $list = "ERROR: " . $connection->error;
    }
    else {
        while($row = mysqli_fetch_array($result))
        {
            $list = $list."<option value=$row[0]>$row[1]".", "."$row[2]</option>";
        }
    }
    return $list;
}

function getUsers ($user) {
    global $connection;
    if($user == 0)
        $list = "<option value=0 selected>--</option>";
    else
        $list = "<option value=0 >--</option>";
    $query = "SELECT ID, Name FROM `User` ORDER BY Name";
    $result = $connection->query($query);
    if($result === FALSE) { 
        $list = "ERROR: " . $connection->error;
    }
    else {
        while($row = mysqli_fetch_array($result))
        {
            if ($row[0] == $user)
                $list = $list."<option value=$row[0] selected>$row[1]</option>";
            else
                $list = $list."<option value=$row[0]>$row[1]</option>";
        }
    }
    return $list;
}

function getNextBatchLetter() {
    global $connection;
    $statement = $connection->prepare("SELECT MAX(Batch) FROM `Petition`");
    $statement->execute();
    $result = $statement->bind_result($batch);
    if ($result == false)
        return 400;
    else {
        if ($statement->fetch()) {
            if ($batch == '')
                $batch = "A";
            else
                $batch++;
            return $batch;
        }
        else
            return 500;
    }
    $statement->close();
}

function getBatches () {
    global $connection;
    $list = "<option value=0 selected>--</option>";
    $query = "SELECT DISTINCT Batch FROM `Petition` ORDER BY Batch";
    $result = $connection->query($query);
    if($result === FALSE) { 
        $list = "ERROR: " . $connection->error;
    }
    else {
        while($row = mysqli_fetch_array($result))
        {
            $list = $list."<option value=$row[0]>$row[0]</option>";
        }
    }
    return $list;
}

?>
