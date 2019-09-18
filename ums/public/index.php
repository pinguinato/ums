<?php

require_once 'functions.php';

const ORDER_BY = 'orderBy';
$pageUrl = $_SERVER['PHP_SELF'];
$orderBy = getParam(ORDER_BY, 'id');
$orderDir = getParam('orderDir', 'DESC');
$orderByColumns = getConfig('orderByColumns', ['id', 'name', 'email', 'fiscalcode', 'age']);
$recordsPerPage = getParam('recordsPerPage', getConfig('recordsPerPage'));
$recordsPerPageOptions = getConfig('recordsPerPageOptions', [5, 10, 20, 30, 50]);
$search = getParam('search', '');
$page = getParam('page', 1);
require_once 'views/top.php';
require_once 'views/navbar.php';


?>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">USER MANAGEMENT SYSTEM</h1>
        <?php
        $action = getParam('action');

        switch ($action) {

            case 'insert':
                break;

            default:

                if (!in_array($orderBy, getConfig('orderByColumns'))) {
                    $orderBy = 'id';
                }

                $params = [
                    'orderBy' => $orderBy,
                    'orderDir' => $orderDir,
                    'recordsPerPage' => $recordsPerPage,
                    'search' => $search,
                    'page' => $page,
                ];
                $totalUsers = countUsers($params);
                $numPages = ceil($totalUsers/$recordsPerPage);
                $users = getUsers($params);
                require_once 'views/usersList.php';
        }
        ?>
    </div>
</main>

<? require_once 'views/footer.php'; ?>

