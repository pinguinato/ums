<?php
$pageUrl = $_SERVER['PHP_SELF'];
?>
<table class="table table-striped">
    <thead>
    <tr><th>TOTAL USERS <?php echo $totalUsers; ?> numPages <?php echo $numPages ?></th></tr>
    <tr>
        <th><a href="<?php echo $pageUrl; ?>?orderBy=id">ID</a></th>
        <th><a href="<?php echo $pageUrl; ?>?orderBy=username">NAME</a></th>
        <th><a href="<?php echo $pageUrl; ?>?orderBy=fiscalcode">FISCAL CODE</a></th>
        <th><a href="<?php echo $pageUrl; ?>?orderBy=email">EMAIL</a></th>
        <th><a href="<?php echo $pageUrl; ?>?orderBy=age">AGE</a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    // se abbiamo un elenco di utenti...
    if ($users){
    foreach ($users as $user) { ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['fiscalcode']; ?></td>
            <td><a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a></td>
            <td><?php echo $user['age']; ?></td>
        </tr>
        <?php
    } ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">
            <?php
            require_once 'navigation.php';
            echo '</td></tr></tfoot>';
            } else {
                echo '<tr><td colspan="5"><h2 style="text-align: center;">No records found!</h2></td></tr>';
            }
            ?>
</table>


