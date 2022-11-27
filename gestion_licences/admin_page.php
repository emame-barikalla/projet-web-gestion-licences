<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
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

    <title>gestion des licences</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!-- add licence -->
<div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ajouter une licence</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveStudent">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">nom</label>
                    <input type="text" name="nom" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">date debut</label>
                    <input type="date" name="date_debut" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">date fin</label>
                    <input type="date" name="date_fin" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">type</label>
                     <select name="type" class="form-control">
                        <option value="plateforme">plateforme</option>
                        <option value="certificat">certificat</option>
                        <option value="software">software</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
                <button type="submit" class="btn btn-primary">enregistrer la licence</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit license Modal -->
<div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">modifer la licence</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateStudent">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="license_id" id="license_id" >

                <div class="mb-3">
                    <label for="">nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">date debut</label>
                    <input type="text" name="date_debut" id="date_debut" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">date fin</label>
                    <input type="text" name="date_fin" id="date_fin" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="plateforme">plateforme</option>
                        <option value="certificat">certificat</option>
                        <option value="software">software</option>
                    </select>
                  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
                <button type="submit" class="btn btn-primary">mettre a jour </button>
            </div>
        </form>
        </div>
    </div>
</div>

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
                    <h4>gestion des licences
                        
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#studentAddModal">
                            ajouter une licence
                        </button>
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
                                            <button type="button" value="<?=$licence['id'];?>" class="editStudentBtn btn btn-success btn-sm">modifier</button>
                                            <button type="button" value="<?=$licence['id'];?>" class="deleteStudentBtn btn btn-danger btn-sm">supprimer</button>
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
        $(document).on('submit', '#saveStudent', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_student", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#studentAddModal').modal('hide');
                        $('#saveStudent')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editStudentBtn', function () {

            var license_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code.php?license_id=" + license_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#license_id').val(res.data.id);
                        $('#nom').val(res.data.nom);
                        $('#date_debut').val(res.data.date_debut);
                        $('#date_fin').val(res.data.date_fin);
                        $('#type').val(res.data.type);

                        $('#studentEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateStudent', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_student", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                        $('#studentEditModal').modal('hide');
                        $('#updateStudent')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

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

        $(document).on('click', '.deleteStudentBtn', function (e) {
            e.preventDefault();

            if(confirm('Êtes-vous sûr de vouloir supprimer ces données ?'))
            {
                var license_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_student': true,
                        'license_id': license_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable').load(location.href + " #myTable");
                        }
                    }
                });
            }
        });

    </script>

</body>
</html>