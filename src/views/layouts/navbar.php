<div class="container">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-brand">
                <?php if (isset($breadcrumb)) {
                ?>
                    <nav style="--bs-breadcrumb-divider: '>';">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/" class="text-decoration-none">Trang chủ</a>
                            </li>
                            <?php foreach ($breadcrumb as $each) { ?>
                                <li class="breadcrumb-item">
                                    <a href="<?= $each['url'] ?>" class="text-decoration-none"><?= $each['name'] ?></a>
                                </li>
                            <?php } ?>

                        </ol>
                    </nav>
                <?php
                }
                ?>


            </div>

    </nav>
</div>