<?php
$connect = new PDO('mysql:host=localhost;dbname=chart', 'root', '');
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'insert') {
        $data = array(
            ':language' => $_POST['lang']
        );
        $query = 'INSERT INTO chart (language) VALUES (:language)';
        $stmt = $connect->prepare($query);
        $stmt->execute($data);
        echo "done";
    }
    if($_POST['action'] == 'fetch'){
        $query='SELECT language,COUNT(survey_id) AS Total FROM chart GROUP BY language';
        $result=$connect->query($query);
        $data=array();
        foreach($result as $row){
            $data[]=array(
                'language'=>$row['language'],
                'total'=> $row['Total'],
                'color' => "#".rand(100000,999999).'',
            );

        }
        echo json_encode($data);
    }
}
