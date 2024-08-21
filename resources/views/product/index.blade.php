@extends('layouts.app')

@section('content')


    <title>MT Store - Trang Chủ</title>

    <div class="container mt-3 mb-5 p-0">
        <div class="row g-0">
            @if($banners->isNotEmpty())
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($banners as $index => $banner)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" 
                    class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : '' }}" 
                    aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($banners as $index => $banner)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url($banner->image) }}" class="d-block w-100" alt="Slide {{ $index + 1 }}">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Trước</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Sau</span>
        </button>
    </div>
@else
    <p>Không có banner nào được kích hoạt.</p>
@endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myCarousel = new bootstrap.Carousel(document.getElementById('carouselExampleIndicators'), {
                interval: 3000,
                wrap: true
            });
    
            function toggleBanners() {
                var carouselRect = carousel.getBoundingClientRect();
                var isCarouselVisible = (
                    carouselRect.top < window.innerHeight &&
                    carouselRect.bottom >= 0
                );
    
            }
    
            window.addEventListener('scroll', toggleBanners);
    
            toggleBanners();
        });
    </script>
    


    <div id="sale" class="container pb-3 my-5"
        style="background-image: linear-gradient(to right, #0E2241 , #ff7300); border-radius: 10px; box-shadow: 0px 0px 5px gray;">
        <div class="row p-0">
            <div class="d-flex justify-content-start">
                <h2 class="title-product m-0"
                    style="background-color: white; color: orangered; mix-blend-mode: luminosity;">SIÊU
                    KHUYẾN MÃI </h2>
            </div>
            @foreach ($topDiscountedProducts as $product)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 mt-4">
                    <div class="card border-0" style="width: 100%;">
                        <div class="collection-img position-relative">
                            <a href="{{ route('product.show', $product->id) }}">
                                <img src="{{ Storage::url($product->img) }}" class="card-img-top" alt="">

                            </a>
                            @if ($product->discount > 0)
                                <span
                                    class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center">
                                    -{{ ceil($product->discount / ($product->price / 100)) }}%
                                </span>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="product-title">
                                <a href="{{ route('product.show', $product->id) }}">
                                    {{ $product->pro_name }}
                                </a>
                            </div>
                            <div>
                                @if ($product->discount != 0)
                                    <del class="old-price">{{ number_format($product->price, 0, '.', '.') }}đ</del>
                                    <span class="new-price">
                                        {{ number_format($product->price - $product->discount, 0, '.', '.') }}đ
                                    </span>
                                @else
                                    <span class="new-price">
                                        {{ number_format($product->price, 0, '.', '.') }}đ
                                    </span>
                                @endif
                            </div>
                            <div>
                                <span class="rate">5.0 </span><i class="star-rate fa-solid fa-star"></i>
                                <span class="rate-quantity">(10 đánh giá)</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-3 m-0">
                <li class="page-item disabled">
                    <a class="page-link">Trước</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Sau</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Danh mục Laptop -->
    <div id="products" class="container pb-3"
        style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
        <div class="row p-0">
            <div class="d-flex justify-content-start">
                <h2 class="title-product m-0"><i class="fa-solid fa-laptop"></i> | Laptop </h2>
            </div>
            @foreach ($laptops as $laptop)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 mt-4">
                    <div class="card" style="width: 100%;">
                        <div class="collection-img position-relative">
                            <a href="{{ route('product.show', $laptop->id) }}">
                                <img src="{{ Storage::url($laptop->img) }}" class="card-img-top" alt="">

                            </a>
                            @if ($laptop->discount > 0)
                                <span
                                    class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center">
                                    -{{ ceil($laptop->discount / ($laptop->price / 100)) }}%
                                </span>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="product-title">
                                <a href="{{ route('product.show', $laptop->id) }}">
                                    {{ $laptop->pro_name }}
                                </a>
                            </div>
                            <div>
                                @if ($laptop->discount != 0)
                                    <del class="old-price">{{ number_format($laptop->price, 0, '.', '.') }}đ</del>
                                    <span class="new-price">
                                        {{ number_format($laptop->price - $laptop->discount, 0, '.', '.') }}đ
                                    </span>
                                @else
                                    <span class="new-price">
                                        {{ number_format($laptop->price, 0, '.', '.') }}đ
                                    </span>
                                @endif
                            </div>
                            <div>
                                <span class="rate">5.0 </span><i class="star-rate fa-solid fa-star"></i>
                                <span class="rate-quantity">(30 đánh giá)</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-3 m-0">
                <li class="page-item disabled">
                    <a class="page-link">Trước</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Sau</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Danh mục Chuột Gaming -->
    <div id="products" class="container pb-3 my-5"
        style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
        <div class="row p-0">
            <div class="d-flex justify-content-start">
                <h2 class="title-product m-0"><i class="fa-solid fa-computer-mouse"></i> | Chuột Gaming</h2>
            </div>
            @foreach ($gamingMice as $mouse)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 mt-4">
                    <div class="card" style="width: 100%;">
                        <div class="collection-img position-relative">
                            <a href="{{ route('product.show', $mouse->id) }}">
                                <img src="{{ Storage::url($mouse->img) }}" class="card-img-top" alt="">

                            </a>
                            @if ($mouse->discount > 0)
                                <span
                                    class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center">
                                    -{{ ceil($mouse->discount / ($mouse->price / 100)) }}%
                                </span>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="product-title">
                                <a href="{{ route('product.show', $mouse->id) }}">
                                    {{ $mouse->pro_name }}
                                </a>
                            </div>
                            <div>
                                @if ($mouse->discount != 0)
                                    <del class="old-price">{{ number_format($mouse->price, 0, '.', '.') }}đ</del>
                                    <span class="new-price">
                                        {{ number_format($mouse->price - $mouse->discount, 0, '.', '.') }}đ
                                    </span>
                                @else
                                    <span class="new-price">
                                        {{ number_format($mouse->price, 0, '.', '.') }}đ
                                    </span>
                                @endif
                            </div>
                            <div>
                                <span class="rate">5.0 </span><i class="star-rate fa-solid fa-star"></i>
                                <span class="rate-quantity">(30 đánh giá)</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-3 m-0">
                <li class="page-item disabled">
                    <a class="page-link">Trước</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Sau</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Danh mục Bàn Phím Gaming -->
    <div id="products" class="container pb-3 my-5"
        style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
        <div class="row p-0">
            <div class="d-flex justify-content-start">
                <h2 class="title-product m-0"><i class="fa-solid fa-keyboard"></i> | Bàn Phím Gaming</h2>
            </div>
            @foreach ($gamingKeyboards as $keyboard)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 mt-4">
                    <div class="card" style="width: 100%;">
                        <div class="collection-img position-relative">
                            <a href="{{ route('product.show', $keyboard->id) }}">
                                <img src="{{ Storage::url($keyboard->img) }}" class="card-img-top" alt="">

                            </a>
                            @if ($keyboard->discount > 0)
                                <span
                                    class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center">
                                    -{{ ceil($keyboard->discount / ($keyboard->price / 100)) }}%
                                </span>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="product-title">
                                <a href="{{ route('product.show', $keyboard->id) }}">
                                    {{ $keyboard->pro_name }}
                                </a>
                            </div>
                            <div>
                                @if ($keyboard->discount != 0)
                                    <del class="old-price">{{ number_format($keyboard->price, 0, '.', '.') }}đ</del>
                                    <span class="new-price">
                                        {{ number_format($keyboard->price - $keyboard->discount, 0, '.', '.') }}đ
                                    </span>
                                @else
                                    <span class="new-price">
                                        {{ number_format($keyboard->price, 0, '.', '.') }}đ
                                    </span>
                                @endif
                            </div>
                            <div>
                                <span class="rate">5.0 </span><i class="star-rate fa-solid fa-star"></i>
                                <span class="rate-quantity">(30 đánh giá)</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-3 m-0">
                <li class="page-item disabled">
                    <a class="page-link">Trước</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Sau</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Danh mục Tai Nghe -->
    <div id="products" class="container pb-3 my-5"
        style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
        <div class="row p-0">
            <div class="d-flex justify-content-start">
                <h2 class="title-product m-0"><i class="fa-solid fa-headphones"></i> | Tai Nghe</h2>
            </div>
            @foreach ($headphones as $headphone)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 mt-4">
                    <div class="card" style="width: 100%;">
                        <div class="collection-img position-relative">
                            <a href="{{ route('product.show', $headphone->id) }}">
                                <img src="{{ Storage::url($headphone->img) }}" class="card-img-top" alt="">

                            </a>
                            @if ($headphone->discount > 0)
                                <span
                                    class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center">
                                    -{{ ceil($headphone->discount / ($headphone->price / 100)) }}%
                                </span>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="product-title">
                                <a href="{{ route('product.show', $headphone->id) }}">
                                    {{ $headphone->pro_name }}
                                </a>
                            </div>
                            <div>
                                @if ($headphone->discount != 0)
                                    <del class="old-price">{{ number_format($headphone->price, 0, '.', '.') }}đ</del>
                                    <span class="new-price">
                                        {{ number_format($headphone->price - $headphone->discount, 0, '.', '.') }}đ
                                    </span>
                                @else
                                    <span class="new-price">
                                        {{ number_format($headphone->price, 0, '.', '.') }}đ
                                    </span>
                                @endif
                            </div>
                            <div>
                                <span class="rate">5.0 </span><i class="star-rate fa-solid fa-star"></i>
                                <span class="rate-quantity">(30 đánh giá)</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-3 m-0">
                <li class="page-item disabled">
                    <a class="page-link">Trước</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Sau</a>
                </li>
            </ul>
        </nav>
    </div>


    <!-- ------------------------------------------------------------------------------------------------------------------------- Banner Quảng Cáo ------------ -->
    <section id="offers" class="py-5">
        <div class="container">
            <div
                class="row d-flex align-items-center justify-content-center text-center justify-content-lg-start text-lg-start">
                <div class="offers-content">
                    <span class="text-white">Siêu Khuyến Mãi!</span>
                    <h2 class="mt-2 mb-4 text-white">Giảm Giá Tới 50%</h2>
                    <a href="#sale" class="btn">Mua Ngay</a>
                </div>
            </div>
        </div>
    </section>

    <!-- blogs -->
    <div class="container my-5" style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
        <section id="blogs">
            <div class="container">
                <div class="title text-center py-5">
                    <h2 class="position-relative d-inline-block">Tin Công Nghệ</h2>
                </div>

                <div class="row g-3">
                    <div class="card border-0 col-md-6 col-lg-4 bg-transparent my-3">
                        <img src="{{ asset('img/sanpham/intel.jpg') }}" alt="" />
                        <div class="card-body px-0">
                            <h4 class="card-title">
                                Intel tiếp tục có một quý kinh doanh thua lỗ, sa thải hàng chục ngàn nhân viên, chi tiêu “thắt lưng buộc bụng”
                            </h4>
                            <p class="card-text mt-3 text-muted">
                                Mới đây Intel đã công bố kết quả kinh doanh quý 2/2024, công ty tiếp tục thua lỗ
                                 hơn 1.6 tỷ USD. Tất cả các kết quả đều không được như kỳ vọng đặt ra trước đó.

                                Để vượt qua những khó khăn trước mắt, Intel đã lên kế hoạch cho một đợt sa thải
                                 lớn cũng như cắt giảm tất cả các khoản chi tiêu không cần thiết. Tuy vậy những khoản thua lỗ 
                                hiện tại có thể chỉ là tạm thời tạo tiền đề để công ty bứt phá cho vài năm tới.
                            </p>
                            
                            <a href="#" class="btn">Đọc Thêm</a>
                        </div>
                    </div>

                    <div class="card border-0 col-md-6 col-lg-4 bg-transparent my-3">
                        <img src="{{ asset('img/sanpham/Có nên mua laptop cho trẻ.jpg') }}" alt="" />
                        <div class="card-body px-0">
                            <h4 class="card-title">
                                Vì sao nên mua laptop cho trẻ để phục vụ học tập, phát triển kỹ năng từ sớm?
                            </h4>
                            <p class="card-text mt-3 text-muted">
                                Trong thời đại công nghệ số hiện nay, việc trang bị laptop cho học sinh không 
                                còn là điều xa xỉ, mà đã trở thành một nhu cầu thiết yếu, một khoản đầu tư thông
                                minh cho tương lai của con em chúng ta. Vì sao nên mua laptop cho trẻ để phục vụ
                                học tập, phát triển kỹ năng từ sớm?
                            </p>
                           
                            <a href="#" class="btn">Đọc Thêm</a>
                        </div>
                    </div>

                    <div class="card border-0 col-md-6 col-lg-4 bg-transparent my-3">
                        <img src="{{ asset('img/sanpham/MSI14.jpg') }}" alt="" />
                        <div class="card-body px-0">
                            <h4 class="card-title">
                                MSI Stealth 18 & Stealth 16 Mercedes AMG Motorsport 2024 ra mắt tại Việt Nam
                            </h4>
                            <p class="card-text mt-3 text-muted">
                                MSI mới đây đã cho ra mắt bộ đôi sản phẩm bản giới hạn mới nhất -chiếc MSI Stealth
                                18 Mercedes-AMG Motorsport và MSI Stealth 16 Mercedes-AMG Motorsport (mẫu cập nhật 2024). 
                                Hai mẫu laptop mới là sự kết hợp giữa hiệu năng mạnh mẽ cùng thiết kế sang trọng, hứa hẹn
                                mang lại trải nghiệm gaming cao cấp cho người dùng.
                            </p>
                           
                            <a href="#" class="btn">Đọc Thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- end of blogs -->

    <!-- ------------------------------------------------------------------------------------------------------------------------------- Giới Thiệu ------------ -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row gy-lg-5 align-items-center">
                <div class="col-lg-6 order-lg-1 text-center text-lg-start">
                    <div class="title pt-3 pb-4">
                        <h2 class="position-relative d-inline-block ms-4 text-white">GIỚI THIỆU</h2>
                    </div>
                    <p class="lead text-white">
                        MT Store - Một sàn thương mại điện tử về công nghệ
                    </p>
                    <p class="text-white">
                        Với mong muốn cung cấp những sản phẩm công nghệ uy tín và chất lượng nhất đến cho mọi người, chúng
                        tôi
                        luôn không ngừng học hỏi và cải tiến từ những phản hồi góp ý từ các bạn.
                    </p>
                </div>
                <div class="col-lg-6 order-lg-0">
                    <a href="#"><img src="{{ asset('img/sanpham/banner_gioithieu.png') }}"
                            class=" img-fluid" /></a>
                </div>
            </div>
        </div>
    </section>



 

    <a href="#" class="to-top" onclick="scrollToTop();"><i class="fa-solid fa-angle-up"></i></a>
    <!-- End Scroll To Top -->
    <script type="text/javascript">
        window.addEventListener("scroll", function() {
            var scroll = document.querySelector(".to-top");
            scroll.classList.toggle("active", window.scrollY > 500);
        });

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        }
    </script>
@endsection
