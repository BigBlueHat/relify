<?php
define('API_KEY', '');
define('API_SECRET', '');
define('COUCH', 'https://yourveryown.cloudant.com/relify/');
// define('COUCH', 'http://localhost:5984/relify/');

// catch LINK & UNLINK requests
if ($_SERVER['REQUEST_METHOD'] == 'LINK') {
  // respond early
  header('HTTP/1.1 202 Accepted');
  $header = $_SERVER['HTTP_LINK'];
  $links = explode(', ', trim($header));

  // MIT licensed link header parser from https://github.com/indieweb/link-rel-parser-php/blob/master/src/IndieWeb/link_rel_parser.php#L14-L47
  $rels = array();
  foreach ($links as $link) {
    $hrefandrel = explode('; ', $link);
    $href = trim($hrefandrel[0], '<>');
    $relarray = '';
    foreach ($hrefandrel as $p) {
      if (!strncmp($p, 'rel=', 4)) {
        $relarray = explode(' ', trim(substr($p, 4), '"\''));
        break;
      }
    }
    if ($relarray !== '') { // ignore Link: headers without rel
      foreach ($relarray as $rel) {
        $rel = strtolower(trim($rel));
        if ($rel != '') {
          if (!array_key_exists($rel, $rels)) {
            $rels[$rel] = array();
          }
          if (!in_array($href, $rels[$rel])) {
            $rels[$rel][] = $href;
          }
        }
      }
    }
  }


  // create the JSON document
  $doc = str_replace('\\/', '/', json_encode(array(
    'method' => $_SERVER['REQUEST_METHOD'],
    'url' => 'http' . (!empty($_SERVER['HTTPS']) ? 's://' : '://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
    'links' => $rels,
    'created' => time(),
    'raw' => apache_request_headers()
  )));

  // send it to CouchDB
  $response = http_post_data(COUCH, $doc, array(
    'httpauthtype'=> HTTP_AUTH_BASIC,
    'httpauth' => "$api_key:$api_secret",
    'headers' => array(
      'Content-Type' => 'application/json')));
  exit;
}
