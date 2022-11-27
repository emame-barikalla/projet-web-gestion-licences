<?php

require 'config.php';

if(isset($_POST['save_student']))
{
    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $date_debut = mysqli_real_escape_string($con, $_POST['date_debut']);
    $date_fin = mysqli_real_escape_string($con, $_POST['date_fin']);
    $type = mysqli_real_escape_string($con, $_POST['type']);

    if($nom == NULL || $date_debut == NULL || $date_fin == NULL || $type == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Tous les champs sont obligatoires'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO licences (nom,date_debut,date_fin,type) VALUES ('$nom','$date_debut','$date_fin','$type')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'licence crée avec succès'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'licence No crée'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_student']))
{
    $license_id = mysqli_real_escape_string($con, $_POST['license_id']);

    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $date_debut = mysqli_real_escape_string($con, $_POST['date_debut']);
    $date_fin = mysqli_real_escape_string($con, $_POST['date_fin']);
    $type = mysqli_real_escape_string($con, $_POST['type']);

    if($nom == NULL || $date_debut == NULL || $date_fin == NULL || $type == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Tous les champs sont obligatoires'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE licences SET nom='$nom', date_debut='$date_debut', date_fin='$date_fin', type='$type' 
                WHERE id='$license_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'licence mise à jour avec succès'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'license Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['license_id']))
{
    $license_id = mysqli_real_escape_string($con, $_GET['license_id']);

    $query = "SELECT * FROM licences WHERE id='$license_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $license = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'license Fetch Successfully by id',
            'data' => $license
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'license Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_student']))
{
    $license_id = mysqli_real_escape_string($con, $_POST['license_id']);

    $query = "DELETE FROM licences WHERE id='$license_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'licence supprimée avec succès'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'licence No supprimée'
        ];
        echo json_encode($res);
        return;
    }
}

?>
