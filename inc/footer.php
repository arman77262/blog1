<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h2 class="text-center" style="color:white">Shop 1</h2>
                <?php
                $query = "SELECT * FROM tbl_footer";
                $result = $db->select($query);
                if ($result){
                    while ($row = mysqli_fetch_assoc($result)){
                        ?>
                         <p class="text-center" style="color: white; border-bottom: 1px solid #ffffff">SHOP NAME : <?=$row['sname']?></p>
                        <p class="text-center" style="color: white; border-bottom: 1px solid #ffffff">SHOP ADDRESS : <?=$row['address']?></p>
                        <p class="text-center" style="color: white;">MOBILE : <?=$row['mobile']?></p>

                        <?php
                    }
                }
                ?>
            </div>

            <div class="col-sm-4">
                <h2 class="text-center" style="color: white">Shop 2</h2>
                <?php
                    $query = "SELECT * FROM shop_two";
                    $select = $db->select($query);
                    if ($select){
                        while ($row = mysqli_fetch_assoc($select)){
                            ?>
                            <p class="text-center" style="color: white; border-bottom: 1px solid #ffffff">SHOP NAME : <?=$row['stname']?></p>
                            <p class="text-center" style="color: white; border-bottom: 1px solid #ffffff">SHOP ADDRESS : <?=$row['staddress']?></p>
                            <p class="text-center" style="color: white;">MOBILE : <?=$row['stmobile']?></p>

                            <?php
                        }
                    }
                ?>
            </div>

            <div class="col-sm-4" style="height: 200px">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d458.5277682978464!2d89.22232466409253!3d23.162090943064044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff1181ec25bded%3A0x286386b1883cf39d!2sM%2FS%20RANA%20ENTERPRISE!5e0!3m2!1sen!2sbd!4v1596639873553!5m2!1sen!2sbd" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>        </div>


    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
