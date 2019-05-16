<?php
$conn = mysqli_connect("localhost", "root", "", "student");

if (isset($_POST["submit1"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                //$student_id   = $column[0];
                $student_name  = $column[1];
                $subject  = $column[2];
                $mark = $column[3];
            $sqlInsert = "INSERT into student_details (student_name,subject,mark)
                   values ('" .$student_name. "','" .$subject."','" .$mark. "')";
            $result = mysqli_query($conn, $sqlInsert);
            
            if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
$sqlSelect = "SELECT * FROM student_details";
$result = mysqli_query($conn, $sqlSelect);
            
if (mysqli_num_rows($result) > 0) {
?>
<table id='studentdetails'>
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Subject</th>
            <th>Mark</th>

        </tr>
    </thead>
    <?php
	while ($row = mysqli_fetch_array($result)) {
    ?>

    <tbody>
        <tr>
            <td><?php  echo $row['student_id']; ?></td>
            <td><?php  echo $row['student_name']; ?></td>
            <td><?php  echo $row['subject']; ?></td>
            <td><?php  echo $row['mark']; ?></td>
        </tr>
     <?php
     }
     ?>
    </tbody>
</table>
<?php }
?>
