<?php

//get the width and the height parameters
$width = $_GET["p"];
$height = $_GET["q"];

//set the min x and y values to start drawing
$xin = $width*0.1;
$yin = $height*0.1;

//set the max height and width values (so data does not overflow)
$width *= 0.9;
$height *= 0.8;

//the data in these arrays will be obtained from the DB in the future
//$moodscores = [3.3, 2.5, 3, 4.5, 5, 4 ,1.2];
$moodscores = [0.5, 1.5, 3.5, 5, 3.5, 1.5 ,0.5];
$dates = ["18/02/2020", "19/02/2020", "20/02/2020", "21/02/2020", "22/02/2020", "23/02/2020", "24/02/2020"];

//generate the SVG
$responsesvg = "";
$responsesvg .= ' <svg version="1.2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="stressgraph" class="graph" role="img">';
$responsesvg .= genbasegridlines($yin, $xin, $height, $width);
$responsesvg .= genxlabels($dates, $xin, $height, $width);
$responsesvg .= genylabels( $yin, $xin, $height, $width);
//$responsesvg .= genpolyline($moodscores, $yin, $xin, $height, $width);
$responsesvg .= genbars($moodscores, $dates, $yin, $xin, $height, $width);
$responsesvg .= gentabcontents($dates, $moodscores);

$responsesvg .= "</svg>";
echo $responsesvg;

function genbasegridlines($yin, $xin, $height, $width)
{
   $str = '<g class="grid x-grid" id="xGrid" >';
   $str .= '  <line class="path" x1="'.$xin.'" x2="'.$width.'" y1="'.$height.'" y2="'. ($height)
        .  '"></line> </g> <g class="grid y-grid" id="yGrid"> <line x1="'.$xin.'" x2="'
        .  $xin .'" y1="'. $yin .'" y2="'.$height .'"></line> </g>';
   return $str;
}

function genxlabels(array $xlabels, $xin, $height, $width)
{
   $xstep = (($width -$xin)+ ($width*0.5))/10;
   $str = "";
   $str .= '<g class="labels x-labels">';
   for($i = 1; $i < 8; $i++)
   {
      $str .= '<text x="'. ($xstep*$i) .'" y="'.($height*1.07).'" transform="rotate(75 '. ($xstep*$i) .','.($height*1.07).')">'.$xlabels[$i-1].'</text>';
   }
   $str .=' <text x="'.($width*1.02).'" y="'.($height).'" class="label-title">Date</text>' .'</g>';
   
   return $str;
}

function genylabels( $yin, $xin, $height, $width)
{
   $xstep = ($width-$xin)/7;
   $ystep = ($height-$yin)/6;
   $str = "";
   $str .= '<g class="labels y-labels">';
   $str .= '  <text x="'.($xstep*0.8).'" y="'.($height-($ystep*5)).'">5</text>';
   $str .= '<line x1="'.$xin.'" y1="'.($height-($ystep*5)).'" x2="'.$width.'" y2="'.($height-($ystep*5)).'" stroke="black"
          stroke-dasharray="4" stroke-opacity="0.3"/>';
   $str .= '  <text x="'.($xstep*0.8).'" y="'.($height-($ystep*4)).'">4</text>';
   $str .= '<line x1="'.$xin.'" y1="'.($height-($ystep*4)).'" x2="'.$width.'" y2="'.($height-($ystep*4)).'" stroke="black"
          stroke-dasharray="4" stroke-opacity="0.3"/>';
   $str .= '  <text x="'.($xstep*0.8).'" y="'.($height-($ystep*3)).'">3</text>';
   $str .= '<line x1="'.$xin.'" y1="'.($height-($ystep*3)).'" x2="'.$width.'" y2="'.($height-($ystep*3)).'" stroke="black"
          stroke-dasharray="4" stroke-opacity="0.3"/>';
      $str .= '  <text x="'.($xstep*0.8).'" y="'.($height-($ystep*2)).'">2</text>';
   $str .= '<line x1="'.$xin.'" y1="'.($height-($ystep*2)).'" x2="'.$width.'" y2="'.($height-($ystep*2)).'" stroke="black"
          stroke-dasharray="4" stroke-opacity="0.3"/>';
      $str .= '  <text x="'.($xstep*0.8).'" y="'.($height-($ystep*1)).'">1</text>';
   $str .= '<line x1="'.$xin.'" y1="'.($height-($ystep*1)).'" x2="'.$width.'" y2="'.($height-$ystep).'" stroke="black"
          stroke-dasharray="4" stroke-opacity="0.3"/>';
         $str .= '  <text x="'.($xstep*0.8).'" y="'.($height).'">0</text>';
         
   $str .= '<text x="'.($xin-$xin*0.4).'" y="'.($height*0.5).'" transform="rotate(270 '.($xin-$xin*0.4).','.($height*0.5).')" class="label-title" >score</text>';
   $str .= '</g>';
   
   return $str;
}

function gentabcontents(array $dates, array $scores)
{
   $str = "";
   for($i = 0; $i < 7; $i++)
   {
      $str .= '<div id="'.$dates[$i].'" class="graphtabcontent" style="display:none;">';
      $str .= '<h3>'.$dates[$i].'</h3>';
      $str .= '  <p>Mood Score: '.$scores[$i].'</p> </div>';
   }
   return $str;
}

function genbars(array $scores, $dates, $yin, $xin, $height, $width)
{
   $ystep = ($height-$yin)/6;
   //$xstep = ($width-$xin)/7;
   $xstep = (($width -$xin)+ ($width*0.5))/10;
   $str = '<g class="data" data-setname="graphbars">  ';
   
   for($i=0; $i < 7; $i++)
   {
       $str .=   '<rect class="rectbar" width="'.($xstep*0.3).'" height="'.($ystep*($scores[$i])).'" y="'.($height-$ystep*($scores[$i])).'" x="'.($xstep*($i+0.9))
                 .'" onclick="openPoint(event, '."'".$dates[$i] ."'".')" ></rect>';
   }
       
        
    // y="'.($height). ' x="'.$xstep.'" transform="rotate(90 '.($xstep).','.($height).')"
   //transform="rotate(180 '.($xstep+($xstep*0.05)).','.($height).')"
   return $str;
}