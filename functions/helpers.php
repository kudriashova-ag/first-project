<?php
function clear($str){
  return strip_tags(trim($str));
}

function dump($arr){
  echo '<pre>' . print_r($arr, true) . '</pre>';
}

function redirect($page){
  header('Location: index.php?page=' . $page);
  die();
}


function translit_file($filename)
{
  $converter = array(
    'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
    'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
    'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
    'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
    'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
    'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
    'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

    'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
    'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
    'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
    'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
    'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
    'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
    'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
  );

  $new = '';

  $file = pathinfo(trim($filename));
  if (!empty($file['dirname']) && @$file['dirname'] != '.') {
    $new .= rtrim($file['dirname'], '/') . '/';
  }

  if (!empty($file['filename'])) {
    $file['filename'] = str_replace(array(' ', ','), '-', $file['filename']);
    $file['filename'] = strtr($file['filename'], $converter);
    $file['filename'] = mb_ereg_replace('[-]+', '-', $file['filename']);
    $file['filename'] = trim($file['filename'], '-');
    $new .= $file['filename'];
  }

  if (!empty($file['extension'])) {
    $new .= '.' . $file['extension'];
  }

  return $new;
}
