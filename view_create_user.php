<?php
require_once __DIR__.'/_x.php';

$_title = 'Create user';
require_once __DIR__.'/comp_header.php';
?>

<main>
  <h1>
    Create user
  </h1>

  <form onsubmit="validate(create_user); return false">
    <div>
      <label for="">
        User name min <?= _USER_NAME_MIN_LEN ?> max <?= _USER_NAME_MAX_LEN ?> characters
      </label>
      <input type="text">
    </div>
    <button>
      Create user
    </button>
  </form>



</main>


<?php
require_once __DIR__.'/comp_footer.php';
?>

