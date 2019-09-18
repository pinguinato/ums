<?php
$pageUrl = $_SERVER['PHP_SELF'];
?>
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/">
            <em class="fa fa-user fa-2x"></em>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php stripos($_SERVER['PHP_SELF'], 'index') ? 'active' : ''; ?>">
                    <a class="nav-link" href="/">
                        <em class="fas fa-users"></em> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <em class="fas fa-user-plus"></em> New Users
                    </a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0" action="<?php echo $pageUrl ?>" id="searchForm" method="get">
                <div class="formGroup">
                    <label for="recordsPerPage">ORDER BY</label>
                    <select name="orderBy" id="orderBy" onchange="document.forms.searchForm.submit()">
                        <option value="">SELECT</option>
                        <?php
                        foreach ($orderByColumns as $val) {
                            ?>
                            <option <?= $orderBy == $val ? 'selected' : '' ?> value="<?= $val ?>"><?= $val ?></option>
                        <?php } ?>
                    </select>
                </div>&nbsp;
                <div class="formGroup">
                    <label for="orderDir">ORDER</label>
                    <select name="orderDir" id="orderDir" onchange="document.forms.searchForm.submit()">
                        <option <?= $orderDir == 'ASC' ? 'selected' : '' ?> value="ASC">ASC</option>
                        <option <?= $orderDir == 'DESC' ? 'selected' : '' ?> value="DESC">DESC</option>
                    </select>
                </div>&nbsp;
                <div class="formGroup">
                    <label for="recordsPerPage">RECORDS PER PAGE</label>
                    <select name="recordsPerPage" id="recordsPerPage" onchange="document.forms.searchForm.submit()">
                        <option value="">SELECT</option>
                        <?php
                        foreach ($recordsPerPageOptions as $val) {
                            ?>
                            <option <?= $recordsPerPage == $val ? 'selected' : '' ?>
                                    value="<?= $val ?>"><?= $val ?></option>
                        <?php } ?>
                    </select>
                </div>&nbsp;
                <input class="form-control mr-sm-2" type="text"
                       placeholder="Search" aria-label="Search" name="search" id="search"
                       value="<?php echo $search; ?>">&nbsp;
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>&nbsp;
                <button class="btn btn-outline-warning my-2 my-sm-0" type="button"
                        onclick="location.href='<?= $pageUrl ?>'">RESET
                </button>
            </form>
        </div>
    </nav>
</header>
