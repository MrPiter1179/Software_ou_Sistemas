<?php
include("session.php");
$update = false;
$del = false;
$expenseamount = "";
$expensedate = date("Y-m-d");
$expensecategory = "Entertainment";
if (isset($_POST['add'])) {
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $despesas = "INSERT INTO despesas (user_id, expense,expensedate,expensecategory) VALUES ('$userid', '$expenseamount','$expensedate','$expensecategory')";
    $result = mysqli_query($con, $despesas) or die("Erro desconhecido!");
    header('location: add_expense.php');
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $sql = "UPDATE despesas SET expense='$expenseamount', expensedate='$expensedate', expensecategory='$expensecategory' WHERE user_id='$userid' AND expense_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "O registro foi actualizado com sucesso.";
    } else {
        echo "ERRO: Não foi possível executar $sql. " . mysqli_error($con);
    }
    header('location: manage_expense.php');
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $sql = "UPDATE despesas SET expense='$expenseamount', expensedate='$expensedate', expensecategory='$expensecategory' WHERE user_id='$userid' AND expense_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "O registro foi actualizado com sucesso.";
    } else {
        echo "ERRO: Não foi possível executar $sql. " . mysqli_error($con);
    }
    header('location: manage_expense.php');
}

if (isset($_POST['delete'])) {
    $id = $_GET['delete'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $sql = "DELETE FROM despesas WHERE user_id='$userid' AND expense_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "O registro foi actualizado com sucesso.";
    } else {
        echo "ERRO: Não foi possível executar $sql. " . mysqli_error($con);
    }
    header('location: manage_expense.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($con, "SELECT * FROM despesas WHERE user_id='$userid' AND expense_id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $expenseamount = $n['expense'];
        $expensedate = $n['expensedate'];
        $expensecategory = $n['expensecategory'];
    } else {
        echo ("AVISO: ERRO DE AUTORIZAÇÃO: Tentando acessar dados não autorizado");
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $del = true;
    $record = mysqli_query($con, "SELECT * FROM despesas WHERE user_id='$userid' AND expense_id=$id");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $expenseamount = $n['expense'];
        $expensedate = $n['expensedate'];
        $expensecategory = $n['expensecategory'];
    } else {
        echo ("AVISO: ERRO DE AUTORIZAÇÃO: Tentando acessar dados não autorizado");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Softkutala">
    <link rel="icon" type="image/x-icon" href="icon/icone.ico">

    <title>Gerenciador de Despesas - Painel Central</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
            <div class="border-right" id="sidebar-wrapper">
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
                <h5><?php echo $username ?></h5>
                <p><?php echo $useremail ?></p>
            </div>
            <div class="sidebar-heading">Gerenciamento</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="home"></span> Painel Central</a>
                <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Adicionar Despesas</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="dollar-sign"></span> Gerenciar Despesas</a>
            </div>
            <div class="sidebar-heading">Configurações </div>
            <div class="list-group list-group-flush">
                <a href="profile.php" class="list-group-item list-group-item-action "><span data-feather="user"></span> Perfil</a>
                <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> Sair</a>
            </div>
            </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.phcol-mdp">Seu Perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Sair</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container">
                <h3 class="mt-4 text-center">Adicione suas despesas diárias</h3>
                <hr>
                <div class="row ">

                    <div class="col-md-3"></div>

                    <div class="col-md" style="margin:0 auto;">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="expenseamount" class="col-sm-6 col-form-label"><b>Insira o valor(kz)</b></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-sm-12" value="<?php echo $expenseamount; ?>" id="expenseamount" name="expenseamount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="expensedate" class="col-sm-6 col-form-label"><b>Data</b></label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-sm-12" value="<?php echo $expensedate; ?>" name="expensedate" id="expensedate" required>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-6 pt-0"><b>Categoria</b></legend>
                                    <div class="col-md">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory4" value="Saúde e Bem-Estar" <?php echo ($expensecategory == 'Saúde e Bem-Estar') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory4">
                                                Saúde e Bem-Estar
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory3" value="Alimentação" <?php echo ($expensecategory == 'Alimentação') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory3">
                                                Alimentação
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory2" value="Casa e Recargas" <?php echo ($expensecategory == 'Casa e Recargas') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory2">
                                                Casa e Recargas
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory1" value="Entretenimento" <?php echo ($expensecategory == 'Entretenimento') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory1">
                                                Entretenimento
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory7" value="Roupas" <?php echo ($expensecategory == 'Roupas') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory7">
                                                Roupas
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory6" value="Transporte" <?php echo ($expensecategory == 'Transporte') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory6">
                                                Transporte
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory8" value="Formação" <?php echo ($expensecategory == 'Formação') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory8">
                                                Formação
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory5" value="Outros" <?php echo ($expensecategory == 'Outros') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory5">
                                                Outros
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <?php if ($update == true) : ?>
                                        <button class="btn btn-lg btn-block btn-warning" style="border-radius: 0%;" type="submit" name="update">Actualizar</button>
                                    <?php elseif ($del == true) : ?>
                                        <button class="btn btn-lg btn-block btn-danger" style="border-radius: 0%;" type="submit" name="delete">Deletar</button>
                                    <?php else : ?>
                                        <button type="submit" name="add" class="btn btn-lg btn-block btn-success" style="border-radius: 0%;">Adicionar Despesa</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-3"></div>
                    
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        feather.replace();
    </script>
    <script>

    </script>
</body>
</html>