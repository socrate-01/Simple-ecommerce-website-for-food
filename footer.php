<?php  
	$cat_res=mysqli_query($con, "select * from categories where status=1 order by categories asc");
    $cat_arr=array(); 
    while ($row=mysqli_fetch_assoc($cat_res)) {
         $cat_arr[]=$row;
    }
?>
 
<footer class="footer-area bg-f">
        
        
    </footer>
    <!-- End Footer -->
    
    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>