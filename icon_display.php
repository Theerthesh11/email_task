<?php
$file_name = $display_result['attachment_name'];
$file_ext = explode('.', $file_name);
$file_actual_ext = end($file_ext);

if ($file_actual_ext == "txt") {
    echo '<img src="icons/txt.png" alt="txt">';
} elseif ($file_actual_ext == "pdf") {
    echo '<img src="icons/pdf.jpg" alt="pdf">';
} elseif ($file_actual_ext == "docx") {
    echo '<img src="icons/docx.png" alt="docx">';
} elseif ($file_actual_ext == "jpeg") {
    echo '<img src="icons/jpeg.png" alt="jpeg">';
} elseif ($file_actual_ext == "png") {
    echo '<img src="icons/png.png" alt="png">';
} elseif ($file_actual_ext == "jpg") {
    echo '<img src="icons/jpg.png" alt="jpg">';
}
