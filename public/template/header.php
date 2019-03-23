<nav class="navbar navbar-dark bg-dark justify-content-between">
        <div class="navbar-brand">
        Your Tasks
        </div>
        <div class='d-flex'>
            <?php if($_SESSION['control'] == 'admin') echo "<button class='btn btn-outline-warning mx-3' data-toggle='modal' data-target='#newTask'>New task...</button>"; ?>
            <form action="index.php" method='post'>
                <button class='btn btn-warning ' type="submit" name='control' value='logout'>Logout</button>
            </form>
        </div>
</nav>
