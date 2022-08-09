<?php  
	require('connection.php');
	require('functions.php');
	$categories_id = get_safe_value($con,$_POST['categories_id']);
	$sub_cat_id = get_safe_value($con,$_POST['sub_cat_id']);
	$res=mysqli_query($con,"select * from sub_categories where categories_id='$categories_id' and status='1' ");
	if (mysqli_num_rows($res)>0) {
		$html='';
		while ($row=mysqli_fetch_assoc($res)) {
			if ($row['id']==$sub_cat_id) {
                $html.="<option selected value=".$row['id'].">".$row['sub_categories']."</option>";
            }
            else
            {
                $html.="<option value=".$row['id'].">".$row['sub_categories']."</option>";
            }
		}
		echo $html;
	}
	else
	{
		echo "<option value='1'>Pas de sous catégories dans cette catégorie</option>";
	}
?>