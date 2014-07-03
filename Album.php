
<?php

$limit_start = 0;
$limit_step = 5;
$images = get_image_list('images');
function get_table( $limit_start ,$limit_step)
{


  // Generate navigation for Previous and Next buttons
  // Code given below

  $output .= '<table class="image_table">';
  $columns = 5;
  foreach ($images as $index => $image)
  {
    // Begin directory listing at item number $limit_start
    if ( $index < $limit_start ) continue;

    // End directory listing at item number $limit_end
    if ( $index >= $limit_start + $limit_step ) continue;

    // Begin column
    if ( $index - $limit_start % $columns == 0 ) {
      $output .= '<tr>';
    }

    // Generate link to blown up image (see below)
    $thumbnail = '<img src="thumbnails/'.$image.'" />';
    $output .= '<td>'.get_image_link($thumbnail,$index).'</td>';

    // Close column
    if ( $index - $limit_start%$columns == $columns - 1 ) {
      $output .= '</tr>';
    }
  }

  $output .= '</table>';

  return $nav.$output;
}
function get_image_list($image_dir )
{
  $d = dir($image_dir);
  $files = array();
  if ( !$d ) return null;

  while (false !== ($file = $d->read()))
  {
    // getimagesize returns true only on valid images
    if ( @getimagesize( $image_dir.'/'.$file ) )
    {
      $files[] = $file;
    }
  }
  $d->close();
  return $files;
}
  // Append navigation
  $output = '<h4>Showing items'.$limit_start.'-'.min($limit_start + $limit_step - 1, count($images)).'of'.count($images).'<br />';

  $prev_start = max(0, $limit_start - $limit_step);
  if ( $limit_start > 0 )
  {
    $output .=get_table_link('<<',0, $limit_step);
    $output .= '|'.get_table_link('Prev',$prev_start, $limit_step);
  } else {
    $output .= '<<|Prev';
  }

  // Append next button
  $next_start = min($limit_start + $limit_step, count($images));
  if ( $limit_start + $limit_step < count($images) ) {
    $output .= '|'.get_table_link('Next',$next_start, $limit_step);
    $output .= '|'.get_table_link('>>',(count($images) - $limit_step), $limit_step);
  } else {
    $output .= '|Next|>>';
  }

  $output .= '</h4>';

function get_table_link ( $title, $start, $step ) {
      $link = "index.php?start=$start&step=$step";
      return '<a href="'.$link.'">'.$title.'</a>';
}

function get_image_link ( $title, $index ) {
      $link = "expand.php?index=$index";
      return '<a href="'.$link.'">'.$title.'</a>';
}

function get_image ( $index ) {
  $images = get_image_list ('images');

  // Generate navigation

  $output .= '<img src="images/'.$images[$index].'" />';
  return $output;

}

 $output .= '<h4>Viewing image'.$index.'of'.count($images).'<br />';

  if ( $index > 0 )
  {
    $output .= get_image_link('<<', 0);
    $output .= '|'. get_image_link('Prev', $index-1);
  } else {
    $output .= '<<| Prev';
  }

  $output .= '|'.get_table_link('Up', $index, 5);

  if ( $index < count($images) ) {
    $output .= '|'.get_image_link('Next', $index+1);
    $output .= '|'.get_image_link('>>', count($images));
  } else {
    $output .= '|Next|>>';
  }

  $output .= '</h4>';

?>

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <title>Creating a simple picture album viewer</title>

  <style type="text/css">
  body { text-align: center }
  table.image_table { margin: 0 auto 0 auto; width: 700px;
  padding:10px; border: 1px solid #ccc; background: #eee; }
  table.image_table td { padding: 5px }
  table.image_table a { display: block; }
  table.image_table img { display: block; width: 120px;
  padding: 2px; border: 1px solid #ccc; }
  </style>

  </head>
  <body>

  <h1>Creating a simple picture album viewer</h1>
  <?php

  $index = isset($_REQUEST['index']) ? $_REQUEST['index'] : 0;
  echo get_image($index);

  ?>
  </body>
  </html>


