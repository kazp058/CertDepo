<?php
if (isset($_SESSION["userId"])) {

            echo '<p class="login-status">You are loggedin!</p>';
         } else {
            echo '<p class="login-status">Yoaau are logged out!</p>';
         }
         ?>