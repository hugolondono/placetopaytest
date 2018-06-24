<nav class="navbar navbar-default" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button> 
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li <?php if($page == 'add'){ ?> class="active" <?php } ?>>
                <a <?php if($page != 'add'){ ?> href="payment?page=add" <?php } ?>>Realizar Pago</a>
            </li>
            <li <?php if($page == 'list'){ ?> class="active" <?php } ?>>
                <a <?php if($page != 'list'){ ?> href="payment?page=list" <?php } ?>>Ver Histórico</a>
            </li>
        </ul>
    </div>

</nav>