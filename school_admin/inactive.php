<table border="2" class="table table-striped">
<tr><center>
<td colspan="10"><h1>Inactive Branches</h1></td></center>
</tr>
<th> </th>
<th> Edit </th>
<th> Name </th>
<th> Address[City] </th>
<th> Branch Code </th>
<th> Phone Number </th>
<th> Head NAme </th>
<th> Password </th>
<th> Code </th>

<?php
include_once("connect.php");
$ccode = $_SESSION['center_code'];
$qry = mysql_query("select * from disable_branch where code = '$ccode'",$link);
$i = 1;
while($row = mysql_fetch_array($qry))
{
	
		$del = $row['bcode'];
		
		$name=$row['bname'];
		$address=$row['baddress'];
		$bcode=$row['bcode'];
		$phone=$row['bphone'];
		$headname=$row['bheadname'];
		$password=$row['bpassword'];
		$code=$row['code'];
		

?>
<tr>
	<td><input type="checkbox" name="d<?php echo $i;?>" value ="<?php echo $del; ?>"/> </td>
    <td><a href="edit.php?id=<?php echo $del; ?>">EDIT</a></td>
    <td><?php echo $name; ?></td>
    <td><?php echo $address; ?></td>
    <td><?php echo $del;?></td>
    <td><?php echo $phone; ?></td>
    <td><?php echo $headname;?></td>
    <td><?php echo $password;?></td>
    <td><?php echo $code; ?></td>
</tr>
<?php $i++;}?>

<!--	echo "<tr>";
	echo "<td rowspan='4'><input type='checkbox' name='d$n' value ='$del'/> </td>";

	echo "<td rowspan='4'><a href='edit.php?id=$del'>EDIT</a></td>";
       echo "<th> Branch Name </th>";
	echo "<td>".$row['bname']."</td>";
	echo "<td></td>";
	echo "<th> </th>";
	echo "<td> </td>";
	echo "<td></td>";
	echo "<th>Branch Address</th>";
	echo "<td>".$row['baddress']."</td>";
 	echo "</tr>";
	
	
	echo "<tr>";
	echo "<th> </th>";
	echo "<td> </td>";
	echo "<td></td>";
	echo "<th>Branch Headname</th>";
	echo "<td>".$row['bheadname']."</td>";
	echo "<td></td>";
	echo "<th> </th>";
	echo "<td> </td>";
 	echo "</tr>";
	
	echo "<tr>";
	echo "<th>Branch Code[Username]</th>";
	echo "<td>".$row['bcode']."</td>";
	echo "<td></td>";
	echo "<th></th>";
	echo "<td></td>";
	echo "<td></td>";
	echo "<th>Password</th>";
	echo "<td>".$row['bpassword']."</td>";
 	echo "</tr>";

	echo "<tr>";
	echo "<th>Branch Contact Number</th>";
	echo "<td>".$row['bphone']."</td>";
	echo "<td></td>";
	echo "<th></th>";
	echo "<td></td>";
	echo "<td></td>";
	echo "<th>Center Code</th>";
	echo "<td>".$row['code']."</td>";
 	echo "</tr>";
	
-->
<?php
if(isset($_POST['delete_disable']))
{	
	$total = $_POST['total_disable'];
	
	$i=0;
	for($i=1;$i<$total;$i++)
	{
		$abc=$_POST["d$i"];	
		if(isset($_POST["d$i"]))
		{	
			mysql_query("delete from disable_branch where bcode='$abc'",$link);
			header("Location:company_detail.php");
				}
	}	
}
if(isset($_POST['enable']))
{
	$total = $_POST['total_disable'];
	$i=0;
	for($i=1;$i<$total;$i++)
	{
		$abc=$_POST["d$i"];	
		if(isset($_POST["d$i"]))
		{	
		$qry = mysql_query("select * from disable_branch where bcode='$abc'",$link);
			while($row = mysql_fetch_array($qry))
				{
				$bcode = $row['bcode'];
				$bname= $row['bname'];
				$baddress = $row['baddress'];
				$center = $row['code'];
				$bpass = $row['bpassword'];
				$bhname = $row['bheadname'];
				$bphone = $row['bphone'];
				mysql_query("insert into branch values('$bname','$baddress','$bcode','$bphone','$bhname','$bpass','$ccode')",$link);
				mysql_query("insert into branch_admin values('$bcode','$bpass','$ccode')",$link);
					}
				mysql_query("delete from disable_branch where bcode='$abc'",$link);
			header("Location:company_detail.php");
		}
	}
}
?>
<tr> 
<td colspan="9"><input type="submit" class="btn btn-danger pull-right" name="delete_disable" id="delete_disable" value="Delete"/><input class="btn btn-success pull-right" type="submit" name="enable" id="enable" value="Enable"/><input type = "hidden" name="total_disable" value="<?php echo @$i; ?>"/> 
</td>
</tr></table>
