<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>details des licences</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>



<body>
   

<!-- View license Modal -->
<div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Voir la licence</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">nom</label>
                    <p id="view_nom" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">date debut</label>
                    <p id="view_dated" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">date fin</label>
                    <p id="view_datef" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">type</label>
                    <p id="view_type" class="form-control"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>details des licences
                       
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                
                                <th>nom</th>
                                <th>date debut</th>
                                <th>date fin</th>
                                <th>type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'config.php';

                            $query = "SELECT * FROM licences";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $licence)
                                {
                                    ?>
                                    <tr>
                                        
                                        <td><?= $licence['nom'] ?></td>
                                        <td><?= $licence['date_debut'] ?></td>
                                        <td><?= $licence['date_fin'] ?></td>
                                        <td><?= $licence['type'] ?></td>
                                        <td>
                                            <button type="button" value="<?=$licence['id'];?>" class="viewStudentBtn btn btn-info btn-sm">Voir</button>
                                           </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
       

        $(document).on('click', '.viewStudentBtn', function () {

            var license_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code.php?license_id=" + license_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#view_nom').text(res.data.nom);
                        $('#view_dated').text(res.data.date_debut);
                        $('#view_datef').text(res.data.date_fin);
                        $('#view_type').text(res.data.type);

                        $('#studentViewModal').modal('show');
                    }
                }
            });
        });

       

    </script>

</body>

</html>