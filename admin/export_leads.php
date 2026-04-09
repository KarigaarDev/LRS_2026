<?php
include 'db.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename=project_leads.csv');

$out = fopen('php://output', 'w');

fputcsv($out, [
 'ID','Name','Business','Email','Phone','Service',
 'Preferred Time','Status','Remarks','Source','IP','Created At'
]);

$q = $conn->query("SELECT * FROM project_leads ORDER BY id DESC");

while($r = $q->fetch_assoc()){
    fputcsv($out, $r);
}
fclose($out);
exit;
