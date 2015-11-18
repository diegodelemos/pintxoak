<?php
  include_once "../core/Session.php";
  (new Session())->logout();
  header("Location: ..");
