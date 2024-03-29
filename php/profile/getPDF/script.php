<?php

include "../../database/connection.php";
require('../../../../fpdf/fpdf.php');

if (isset($_POST['del-title'])) {
    $ARTICLE_ID = $_POST['del-title'];

    $articlePDF = new FPDF();
    $articlePDF->AddPage();

    $query = "SELECT * FROM articles WHERE ARTICLE_ID = '" . $ARTICLE_ID . "'";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_assoc($result);

    // Article Title

    $articlePDF->SetFont('Arial', 'B', 50);
    $titleChunks = str_split($data['ARTICLE_TITLE'], 20);

    foreach ($titleChunks as $titleChunk) {
        $articlePDF->Cell(0, 18, $titleChunk, 0, 2, 'l');
    }

    // Spacing

    for ($i = 0; $i < count($titleChunks); $i++) {
        $articlePDF->Cell(0, 2, "", 0, 2, 'l');
    }

    // Paragraph A

    $articlePDF->SetFont('Arial', '', 15);

    $paraPartsA = str_split($data['ARTICLE_PARA_A'], 75);
    $imgAGap = (count($paraPartsA) * 16) / 2;
    foreach ($paraPartsA as $partA) {
        $articlePDF->Cell(0, 7, $partA, 0, 2, 'l');
    }

    for ($i = 0; $i < count($paraPartsA); $i++) {
        $articlePDF->Cell(0, 2, "", 0, 2, 'l');
    }

    // Image A

    $tempImagePathA = '../../../images/pdf/temp_imageA.jpg';
    $imageData = base64_decode($data['ARTICLE_IMG_A']);
    if (file_put_contents($tempImagePathA, $imageData) !== false) {
        $articlePDF->Image($tempImagePathA, 10, count($paraPartsA) + 85, 190);
    } else {
        echo "Failed to create image file.";
    }

    // Spacing

    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');

    // Paragraph B

    $paraPartsB = str_split($data['ARTICLE_PARA_B'], 75);
    foreach ($paraPartsB as $partB) {
        $articlePDF->Cell(0, 5, $partB, 0, 2, 'l');
    }

    $articlePDF->Cell(0, 10, "", 0, 2, 'l');

    // Paragraph C

    $paraPartsC = str_split($data['ARTICLE_PARA_C'], 75);
    foreach ($paraPartsC as $partC) {
        $articlePDF->Cell(0, 5, $partC, 0, 2, 'l');
    }

    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');

    // Image B

    $tempImagePathB = '../../../images/pdf/temp_imageB.jpg';
    $imageData = base64_decode($data['ARTICLE_IMG_B']);
    if (file_put_contents($tempImagePathB, $imageData) !== false) {
        $articlePDF->Image($tempImagePathB, 10, count($paraPartsC) + 45, 190);
    } else {
        echo "Failed to create image file.";
    }

    // Spacing

    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');
    $articlePDF->Cell(0, 10, "", 0, 2, 'l');

    // Paragraph D

    $paraPartsD = str_split($data['ARTICLE_PARA_D'], 75);
    foreach ($paraPartsD as $partD) {
        $articlePDF->Cell(0, 5, $partD, 0, 2, 'l');
    }

    $articlePDF->Cell(0, 10, "", 0, 2, 'l');

    $articlePDF->SetFont('Arial', '', 10);

    // Article Details

    $author_query = "SELECT * FROM users WHERE USER_ID = '" . $data['AUTHOR_ID'] . "'";
    $author_result = mysqli_query($connection, $author_query);
    $author_data = mysqli_fetch_assoc($author_result);

    $articlePDF->Cell(0, 5, "Author: " . $author_data['USER_NAME'], 0, 2, 'l');
    $articlePDF->Cell(0, 5, "Article ID: " . $data['ARTICLE_ID'], 0, 2, 'l');

    $articlePDF->Output();
}