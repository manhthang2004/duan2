<div class="container mb-5 mt-5 pe-5"
    style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
    <div class="row">
        <div class="col-xl-4 p-0">
            <div class="d-flex flex-column flex-shrink-0 p-0 flex-wrap"
                style="width: 280px; border-radius: 5px 0px 0px 5px; background-color: white; border-right: 1px solid gainsboro; box-shadow: 1px 1px 5px black;">

                <img src="./Duan/View/Images/Razer Basilisk V3 Pro.webp" alt=""
                    style="width: 100%; border-radius: 5px 0px 0px 5px;">
                <ul class="nav nav-pills flex-column mb-auto">
                    <?php
                    if ($role == 1) {
                        # code...
                        ?>
                        <li class="nav-item">
                            <a href="index.php?act=admin" class="nav-link link-dark ms-5">
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
            <?php
            if (isset($_SESSION['user_name_login']) && (is_array($_SESSION['user_name_login']))) {
                extract($_SESSION['user_name_login']);
            }
            ?>
            <form>
                <div class="mb-3 mt-3">
                    <label for="exampleInputEmail1" class="form-label">Mật Khẩu Cũ</label>
                    <input type="password" class="form-control" name="pass">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Mật Khẩu Mới</label>
                    <input type="password" class="form-control" name="pass">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mật Khẩu Mới</label>
                    <input type="password" class="form-control" name="pass">
                </div>

                <button type="submit" name="update" class="btn btn-primary">Đổi</button>
            </form>

        </div>
    </div>
</div>