<?php include('getData/connectDB.php'); ?>

<?php

// $paramSite = Страница
// $paramPage = Ключ

function getParamDocuments($paramPage, $paramSite, $collectionGame, $collectionArchive) {
    if ($paramSite == 'game') { // Для этих страниц нужны еще данные
        $filter     = array('key' => $paramPage);
        $cursor = $collectionGame->find($filter);
        foreach ($cursor as $document) {
            $theDocument['SportNameRus']     = $document['SportNameRus'];
            $theDocument['SportNameEng']     = $document['SportNameEng'];
            $theDocument['Team1Rus']         = $document['Team1Rus'];
            $theDocument['Team2Rus']         = $document['Team2Rus'];
            $theDocument['Team1Eng']         = $document['Team1Eng'];
            $theDocument['Team2Eng']         = $document['Team2Eng'];
            $theDocument['ChampRus']         = $document['ChampRus'];
            $theDocument['ChampEng']         = $document['ChampEng'];
            $theDocument['Date']             = date("d/m", strtotime($document['Date']));
        }
    }
    if ($paramSite == 'game-archive') { // Для этих страниц нужны еще данные
        $filter     = array('key' => $paramPage);
        $cursor = $collectionArchive->find($filter);
        foreach ($cursor as $document) {
            $theDocument['SportNameRus']     = $document['SportNameRus'];
            $theDocument['SportNameEng']     = $document['SportNameEng'];
            $theDocument['Team1Rus']         = $document['Team1Rus'];
            $theDocument['Team2Rus']         = $document['Team2Rus'];
            $theDocument['Team1Eng']         = $document['Team1Eng'];
            $theDocument['Team2Eng']         = $document['Team2Eng'];
            $theDocument['ChampRus']         = $document['ChampRus'];
            $theDocument['ChampEng']         = $document['ChampEng'];
            $theDocument['bkRobotResult']    = $document['bkRobotResult'];
            $theDocument['Date']             = date("d/m", strtotime($document['Date']));
        }
    }
    return $theDocument;
}

if ( $paramSite == '' ) {
    $paramSite = 'main';
}

$filter = array('page' => $paramSite);
$cursor = $collectionTages->find($filter);
foreach ($cursor as $document) {
    $theTag['title'] = $document['title'];
    $theTag['description'] = $document['description'];
}

if ($paramSite == 'articles-item') {
    $filter = array('link' => $paramPage);
    $cursor = $collectionArticles->find($filter);
    foreach ($cursor as $document) {
        $theTag['title'] = $document['title'];
        $theTag['description'] = $document['description'];
    }
}

if ($paramSite == 'news-item') {
    $filter = array('link' => $paramPage);
    $cursor = $collectionNews->find($filter);
    foreach ($cursor as $document) {
        $theTag['title'] = $document['title'];
        $theTag['description'] = $document['description'];
    }
}

if ($paramSite == 'office-review') {
    $filter = array('nameEng' => $paramPage);
    $cursor = $collectionBk->find($filter);
    foreach ($cursor as $document) {
        $theTag['title'] = $document['title'];
        $theTag['description'] = $document['description'];
    }
}

$countTitleBlocks = count($theTag['title']);
$countDescriptionBlocks = count($theTag['description']);
$titleString = '';
$descriptionString = '';
$space = ' ';

if ( $paramSite == 'archive-list' ) {
   for ( $h=0; $h<$countTitleBlocks; $h++ ) {
       if($document['title'][$h]['sportName'] == $paramPage) {
           $titleString        = $document['title'][$h]['text'];
           $descriptionString  = $document['description'][$h]['text'];
       }
   }
}

if ( $paramSite == 'game' || $paramSite == 'game-archive' ) {

    $theDocument = getParamDocuments($paramPage, $paramSite, $collectionGame, $collectionArchive);

    for ( $i=0; $i<$countTitleBlocks; $i++ )    { // TITLE
        if ( $theTag['title'][$i]['type'] == 'text' ) {
            $titleString = $titleString.$theTag['title'][$i]['content'];
        } else {
            switch ($theTag['title'][$i]['content'])   {
                case 'SportNameRus' :
                    $titleString = $titleString.$theDocument['SportNameRus'];
                    break;
                case 'SportNameEng' :
                    $titleString = $titleString.$theDocument['SportNameEng'];
                    break;
                case 'Team1Rus' :
                    $titleString = $titleString.$theDocument['Team1Rus'];
                    break;
                case 'Team2Rus' :
                    $titleString = $titleString.$theDocument['Team2Rus'];
                    break;
                case 'Team1Eng' :
                    $titleString = $titleString.$theDocument['Team1Eng'];
                    break;
                case 'Team2Eng' :
                    $titleString = $titleString.$theDocument['Team2Eng'];
                    break;
                case 'ChampRus' :
                    $titleString = $titleString.$theDocument['ChampRus'];
                    break;
                case 'ChampEng' :
                    $titleString = $titleString.$theDocument['ChampEng'];
                    break;
                case 'bkRobotResult' :
                    if ($theDocument['bkRobotResult'] == '3') {
                        $titleString = $titleString . 'который полностью совпал';
                    } else {
                        $titleString = substr($titleString, 0, -1);
                    }
                    break;
                case 'Date' :
                    $titleString = $titleString.$theDocument['Date'];
                    break;
                case 'title' :
                    $titleString = $titleString.$theDocument['title'];
                    break;
                case 'textPreview' :
                    $titleString = $titleString.$theDocument['textPreview'];
                    break;
                case 'nameRus' :
                    $titleString = $titleString.$theDocument['nameRus'];
                    break;
                case 'nameEng' :
                    $titleString = $titleString.$theDocument['nameEng'];
                    break;
            }
        }
        $titleString = $titleString.$space;
    }
    $titleString = substr($titleString, 0, -1);

    for ( $j=0; $j<$countDescriptionBlocks; $j++ )    { // TITLE
        if ( $theTag['description'][$j]['type'] == 'text' ) {
            $descriptionString = $descriptionString.$theTag['description'][$j]['content'];
        } else {
            switch ($theTag['description'][$j]['content'])   {
                case 'SportNameRus' :
                    $descriptionString = $descriptionString.$theDocument['SportNameRus'];
                    break;
                case 'SportNameEng' :
                    $descriptionString = $descriptionString.$theDocument['SportNameEng'];
                    break;
                case 'Team1Rus' :
                    $descriptionString = $descriptionString.$theDocument['Team1Rus'];
                    break;
                case 'Team2Rus' :
                    $descriptionString = $descriptionString.$theDocument['Team2Rus'];
                    break;
                case 'Team1Eng' :
                    $descriptionString = $descriptionString.$theDocument['Team1Eng'];
                    break;
                case 'Team2Eng' :
                    $descriptionString = $descriptionString.$theDocument['Team2Eng'];
                    break;
                case 'ChampRus' :
                    $descriptionString = $descriptionString.$theDocument['ChampRus'];
                    break;
                case 'ChampEng' :
                    $descriptionString = $descriptionString.$theDocument['ChampEng'];
                    break;
                case 'bkRobotResult' :
                    if ($theDocument['bkRobotResult'] == '3') {
                        $descriptionString = $descriptionString . 'который полностью совпал';
                    } else {
                        $descriptionString = substr($descriptionString, 0, -1);
                    }
                    break;
                case 'Date' :
                    $descriptionString = $descriptionString.$theDocument['Date'];
                    break;
                case 'title' :
                    $descriptionString = $descriptionString.$theDocument['title'];
                    break;
                case 'textPreview' :
                    $descriptionString = $descriptionString.$theDocument['description'];
                    break;
                case 'nameRus' :
                    $descriptionString = $descriptionString.$theDocument['nameRus'];
                    break;
                case 'nameEng' :
                    $descriptionString = $descriptionString.$theDocument['nameEng'];
                    break;
            }
        }
        $descriptionString = $descriptionString.$space;
    }
    $descriptionString = substr($descriptionString, 0, -1);
}
switch ($paramSite) {
    case 'game':
    case 'game-archive':
    case 'archive-list':
    echo '<title>'.$titleString.'</title>
	      <meta name="description" content="'.$descriptionString.'">';
        break;

    case 'articles-item':
    case 'news-item':
    case 'office-review':
    echo '<title>'.$theTag['title'].'</title>
	      <meta name="description" content="'.$theTag['description'].'">';
        break;

    default :
        echo '<title>'.$theTag['title'][0]['content'].'</title>
	          <meta name="description" content="'.$theTag['description'][0]['content'].'">';
        break;
}
?>