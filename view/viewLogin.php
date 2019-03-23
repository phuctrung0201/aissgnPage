


    <div class='pt-5 container card' style='max-width:350px; position: relative; top:50%; transform: translateY(-50%);'>
        <h1 class='text-center' >Login</h1>
        <?php
            if(isset($_POST['login'])){
                echo "<div class='alert alert-danger'>Username or password is invalid</div>";
            }
        ?>
        <form action="index.php" method="post">
        <label for="username">Username</label>
        <input type="text" class='form-control mb-2' name="usern" id="username"/>
        <label for="password">Password</label>
        <input type="password" class='form-control mb-2' name="passw" id="password"/>
        <div class='text-center'>
        <input type="submit" value="login" name='login' class='btn btn-outline-success btn-lg'/>
        </div>
        </form>
        <form class='text-center' method='post'>
        <button class="btn text-success" name='control' value='register'>Register</button>
        </form>

    </div>

