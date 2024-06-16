<?php
// Inclure la bibliothèque PhpSpreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Créer une nouvelle instance de feuille de calcul
$spreadsheet = new Spreadsheet();

// Sélectionner la feuille de calcul active
$sheet = $spreadsheet->getActiveSheet();

// Entêtes de colonnes
$sheet->setCellValue('A1', 'Num');
$sheet->setCellValue('B1', 'MLE');
$sheet->setCellValue('C1', 'Nom');
$sheet->setCellValue('D1', 'PRENOM');
$sheet->setCellValue('E1', 'SEXE');
$sheet->setCellValue('F1', 'CLASSE');
$sheet->setCellValue('G1', 'UNIT ENSEIGNEMENT');
$sheet->setCellValue('H1', 'DATE');
$sheet->setCellValue('I1', 'HEURE');
$sheet->setCellValue('J1', 'JUSTIFICATIF');
$sheet->setCellValue('K1', 'EDITER');

// Remplir les données
$i = 2;
foreach ($rows as $row) {
    $sheet->setCellValue('A' . $i, $i - 1);
    $sheet->setCellValue('B' . $i, $row['MLE']);
    $sheet->setCellValue('C' . $i, $row['NOM']);
    $sheet->setCellValue('D' . $i, $row['PRENOM']);
    $sheet->setCellValue('E' . $i, $row['sexe']);
    $sheet->setCellValue('F' . $i, $row['CODE_CL']);
    $sheet->setCellValue('G' . $i, $row['LIBELLE']);
    $sheet->setCellValue('H' . $i, $row['DATEP']);
    $sheet->setCellValue('I' . $i, $row['HEURE_ABS']);
    $sheet->setCellValue('J' . $i, $row['JUSTIFICATIF']);
    $sheet->setCellValue('K' . $i, 'Ajouter'); // Lien pour éditer
    $sheet->getCell('K' . $i)->getHyperlink()->setUrl('addjustif.php?mle=' . $row['MLE'] . '&id=' . $row['id']);
    $i++;
}

// Créer un écrivain pour Excel (format Xlsx)
$writer = new Xlsx($spreadsheet);

// Sauvegarder le fichier
$writer->save('tableau_excel.xlsx');
