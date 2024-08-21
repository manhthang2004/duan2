<div class="container mb-5 mt-5"
    style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
    <div class="row">
        <div class="col-xl-4 p-0">
            <div class="d-flex flex-column flex-shrink-0 p-0 flex-wrap"
                style="width: 280px; border-radius: 5px 0px 0px 5px; background-color: white; border-right: 1px solid gainsboro; box-shadow: 1px 1px 5px black;">

                <img src="duan/image_user/<?=$avatar?>" alt=""
                    style="width: 100%; border-radius: 5px 0px 0px 5px;">
                <ul class="nav nav-pills flex-column mb-auto">

                    <?php
                    if ($role > 0) {
                        # code...
                        ?>

                        <li class="nav-item">
                            <a href="./Duan/admin/index.php" class="nav-link link-dark ms-5">
                                Truy Cập Trang Admin
                            </a>
                        </li>

                        <?php
                    }
                    ?>
                    <li>
                        <a href="index.php?act=account_details" class="nav-link link-dark ms-5">
                            Thông Tin Tài Khoản
                        </a>
                    </li>
                    <li>
                        <a href="index.php?act=update_account" class="nav-link link-dark ms-5">
                            Chỉnh Sửa Thông Tin
                        </a>
                    </li>
                    <li>
                        <a href="index.php?act=change_password" class="nav-link link-dark ms-5">
                            Đổi Mật Khẩu
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark ms-5">
                            Sản Phẩm Đã Thích
                        </a>
                    </li>
                    <hr class="m-0">
                    <li>
                        <a href="index.php?act=log_out" class="nav-link link-dark ms-5">
                            Đăng Xuất
                        </a>
                    </li>
                </ul>

            </div>
        </div>

        <div class="col-xl-8">
            <h2 class="mt-5">Xin Chào
                <span style="color: red;">
                    <?= $user_name ?>
                </span>
            </h2>
            <h2 class="mt-5">Email:
                <span style="color: red;">
                    <?= $email ?>
                </span>
            </h2>
            <h2>Số Điện Thoại:
                <span style="color: red;">
                    <?= $tel ?>
                </span>
            </h2>
            <h2>Địa Chỉ:
                <span style="color: red;">
                    <?= $address ?>
                </span>
            </h2>
        </div>
    </div>
</div>