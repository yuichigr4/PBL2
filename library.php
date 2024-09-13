<?php
/*htmlspecialcharsを短縮 */
function h($value) {
  return htmlspecialchars($value, ENT_QUOTES);
}

/*DBの接続 */
function dbconnect() {
  $db = new mysqli('localhost', 'g128kato', '', 'g128kato4');
  if (!$db) {
    die($db->error);
  }
  return $db;
}
?>
