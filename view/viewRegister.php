
<div class='pt-5 container card' style='max-width:350px; position: relative; top:50%; transform: translateY(-50%);'>
<h2 class='text-center'>Register</h2>
    <?php if(isset($_POST['usern'])) echo "<div class='alert alert-danger'>Refill your form</div>";?>
    <form action="index.php" method='post'>
        <div>Usern</div>
        <input type="text" name='usern' class="form-control"/>
        <div>Password</div>
        <input type="password" name='passw' class="form-control"/>
        <div class="text-center">
        <button class="btn btn-success my-3" name='control' value='register'>
            Register
        </button>
        </div>
    </form>
    </div>