<form action="index.php" method='get'class='position-relatvie mt-5' >
    <div class="pagination justify-content-center">
        <?php
            $query->pagination($page);
        ?>
    </div>
</form>