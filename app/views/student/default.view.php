<?php
?>
<h1>Our Students</h1>
<a href="student\add">Add Student</a>
<table>
<head>
<tr>
<td>ID</td>
<td>Name</td>
</tr>

</head>
<?php
//3ndi variable el students 3shan func el extract in abstract controller 

if(isset($students)){
    foreach($students as $st){
echo '        <tr>
        <td>'.$st->id.'</td>
        <td>'.$st->fname.'</td>
        <td><a href="student\edit\\'.$st->id.'">Edit</a></td>
        <td><a href="student\delete\\'.$st->id.'">Delete</a></td>
        </tr>';
 
 }
   echo '</table>'; 
}else{
    echo 'Sorry, No Students';
}