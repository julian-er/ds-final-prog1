<?php
session_start();
session_destroy();
header('Location: index.php?message=Session ends correctly');
