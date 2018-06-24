<?php
$pagename = 'payment';
$page = isset($_GET['page']) ? htmlspecialchars(stripslashes($_GET['page'])) : '0';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once './includes/views/head.php'; ?>
        <script src="js/payment.js" type="text/javascript"></script>
    </head>
    <body>

        <div class="container-fluid">

            <header>

                <!-- LOGO -->
                <div class="row">
                    <img alt="Bootstrap Image Preview" src="img/logo.png">
                </div>

                <!-- MENU -->
                <div class="row">
                    <?php include_once './includes/views/nav.php'; ?>                
                </div>

            </header>

            <?php
            switch ($page) {
                case 'list': {

                        include_once './includes/templates/' . $pagename . 'list.php';
                        break;
                    }
                case 'add': {

                        include_once './includes/templates/' . $pagename . 'add.php';
                        break;
                    }
                case 'result': {

//                        if (!isset($_SESSION['transactionID']) || $_SESSION['transactionID'] == '') {
//                            header('Location: payment?page=add');
//                        }

                        include_once './includes/templates/' . $pagename . 'result.php';
                        break;
                    }
                default: {
                        include_once './includes/templates/' . $pagename . 'add.php';
                        break;
                    }
            }
            ?>

            <!-- FOOTER COPY -->
            <?php include_once './includes/views/footer.php'; ?>

            <div class="modal fade" id="modal-confirmation-dele-establecimientos" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                Modal title
                            </h4>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn_confir_dele_establecimientos">Eliminar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-confirmation-dele-sucursales" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                Modal title
                            </h4>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn_confir_dele_sucursales">Eliminar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-confirmation-dele-ofertas" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                Modal title
                            </h4>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn_confir_dele_ofertas">Eliminar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </body>
</html>