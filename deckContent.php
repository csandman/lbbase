<?php

var_dump(parse_url($url));
$boardName = $path_parts['filename'];
$query = 'SELECT fldBrand,pmkBoard,fldBoardName,fldLength,fldWidth,fldMinWhlBase,fldMaxWhlBase,fldShape,fldConstruction,fldVideo
                FROM tblBoards
                WHERE pmkBoard = "' . $boardName . '"';

$deckInfo = $thisDatabaseReader->select($query, "", 1, 0, 2, 0, false, false);

foreach ($deckInfo as $info) {
    $image = new Imagick( 'images/' . $info[1] . '.png');
    $image->thumbnailImage( 0, 550);
    $newFileName = 'medium/' . $info[1] . 'Medium.png';
    $image->writeImage($newFileName);

    print'<h2>' . $info[0] .' '. $info[2] . '</h2>';
    print'<div class="deckBody">';
    print'<div class="column1">';
    print'<figure>';
    print'<img src="medium/' . $info[1] . 'Medium.png" alt="' . $info[0] . ' ' . $info[2] . '">';
    print'</figure>';
    print'</div>';
    print'<div class="column2">';
    print'<div class="video-container">';
    print ''.$info[9].'';
    print'</div>';
    print'<h3>Specs</h3>';
    print'<table>';
    print'<tr>';
    print'<td>Deck Shape:</td>';
    print'<td>' . $info[7] . '</td>';
    print'</tr>';
    print'<tr>';
    print'<td>Length:</td>';
    print'<td>' . (float) $info[3] . '"</td>';
    print'</tr>';
    print'<tr>';
    print'<td>Width:</td>';
    print'<td>' . (float) $info[4] . '"</td>';
    print'</tr>';
    print'<tr>';
    print'<td>Wheelbase Options:</td>';
    if ($info[5] == $info[6]) {
        print'<td>' . (float) $info[5] . '"</td>';
    } else {
        print'<td>' . (float) $info[5] . '" - ' . (float) $info[6] . '"</td>';
    }
    print'</tr>';
    print'<tr>';
    print'<td>Construction:</td>';
    print'<td>';
    if ($info[8] == "") {
        print 'Unknown';
    } else {
        print $info[8] . '</td>';
    }
    print'</tr>';
    print'</table>';



    print'</div>';
    print'</div>';
}
?>
