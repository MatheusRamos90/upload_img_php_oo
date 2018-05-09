<?php
require 'app/User.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP OO - Image upload</title>
    <style>
        body{
            font-family: 'Calibri';
        }
        p, h1, h2, h3, h4, h5, h6{
            color: #333;
        }
    </style>
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- jQuery 3.3.1 -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>

<!-- container -->
<div class="container">

    <!-- register a new user's information -->
    <div class="col-lg-4 col-md-4" style="float: none;margin: auto">
        <h3> - Register a new user's information - </h3>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="name" class="form-control" placeholder="Name">
            <br/>
            <input type="text" name="email" class="form-control" placeholder="E-mail">
            <br/>
            <select name="technology" class="form-control">
                <option value="">Select...</option>
                <option value="PHP">PHP</option>
                <option value="Java">Java</option>
                <option value="Javascript">Javascript</option>
                <option value="C++">C++</option>
                <option value="C#">C#</option>
            </select>
            <br/>
            <p>Search an image that you appreciate:</p>
            <input type="file" name="image" class="form-control">
            <br/>
            <div class="btns">
                <button type="submit" name="btn-save" class="btn btn-success">Save</button>
            </div>
        </form>
        <?php

        $user = new User();

        if(isset($_POST['btn-save'])){

            $name = $_POST['name'];
            $email = $_POST['email'];
            $technology = $_POST['technology'];
            $image = $_FILES['image'];

            if(empty($name) || empty($email) || empty($technology)){

                echo $user->messageError('All fields are required.');

            }else{

                $user->setName($name);
                $user->setEmail($email);
                $user->setTechnology($technology);
                $user->setImage($image);

                if($user->create()){

                    echo $user->messageSuccess('All right, save.');

                }else{

                    echo $user->messageError('There was a problem in requisition.');

                }

            }

        }

        ?>
    </div>

    <hr>

    <!-- register's list -->
    <div class="col-lg-4 col-md-4" style="float: none;margin: auto">
        <h3> - Register's list - </h3>
        <?php if(count($user->getAll()) <= 0): ?>
            <?php echo '<h3 style="border: 1px solid #CCC;background: #EEE;padding: 3px">No match results.</h3>'; ?>
        <?php endif; ?>
        <?php foreach($user->getAll() as $key => $value ): ?>
            <div class="col-register" style="margin: 0 0 20px 0">
                <p><img src="uploads/<?php echo $value->image; ?>" alt=""></p>
                <p><b>Name:</b> <?php echo $value->name; ?></p>
                <p><b>E-mail:</b> <?php echo $value->email; ?></p>
                <p><b>Technology:</b><?php echo $value->technology; ?></p>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $value->id; ?>">
                    <button type="submit" name="btn-del" class="btn btn-danger btn-del">Delete</button>
                </form>
                <hr>
            </div>
        <?php endforeach; ?>
        <div class="response"></div>
        <?php

        if(isset($_POST['btn-del'])){

            $id = $_POST['id'];

            if($user->delete($id)){

                $msg = $user->messageSuccess('User deleted.');

            }else{

                echo $user->messageError('There was a problem in requisition.');

            }

        }

        ?>
    </div>

</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
