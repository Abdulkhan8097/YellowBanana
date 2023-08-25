<?php 

$conn = mysql_connect("localhost","fusionme_lrg","(h$5!cfoEIPW");
if ($conn)
{
 $adminArray = [];
	mysql_select_db("fusionme_lowers_risk_group");
	
	//echo 'Vinesh';

       $adminSQL = "select * from users where site_admin =1 ";
	$resultAdmin = mysql_query($adminSQL );
	
	if (mysql_num_rows($resultAdmin) > 0 )
	{
		while($rowAdmin = mysql_fetch_array($resultAdmin))
		{
                   $adminArray[] = $rowAdmin['id'];
                }
        }

    if (count($adminArray) >0){
     foreach($adminArray AS $adminId){
     echo "<hr>Admin id:".$adminId;

	$sql = "select distinct(id) from users where id != $adminId";
	
	$result = mysql_query($sql);
	
	if (mysql_num_rows($result) > 0 )
	{
		while($row = mysql_fetch_array($result))
		{
			$userId = $row['id'];
			
			$checkSql = "select COUNT(*) AS COUNT from friends where (user_id = $adminId and friend_id = $userId ) OR (user_id = $userId and friend_id = $adminId )";
		
			$result1 = mysql_query($checkSql);
			
			if (mysql_num_rows($result1) > 0 )
			{
				$data = mysql_fetch_array($result1);
				$count = $data['COUNT'];
				if ($count == 0){
					//insert Query
					$sql1 = "insert into friends set user_id = $userId , friend_id = $adminId";
					$sql2 = "insert into friends set user_id = $adminId , friend_id = $userId";
					
					mysql_query($sql1);
					mysql_query($sql2);
					
					echo "done for $userId";
					echo "<br>";
				}
				
			}
			
		}	
		
	}
   }}
}

?>