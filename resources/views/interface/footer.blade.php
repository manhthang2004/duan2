
<!-- footer -->
<footer class="py-5">
    <div class="container">
      <div class="row text-white g-4">
        <div class="col-md-6 col-lg-3">
          <a class="text-uppercase text-decoration-none brand text-white" href="index.html">MT Store</a>
          <p class="text-white mt-3">
            Là một thương hiệu cung cấp những sản phẩm công nghệ uy tín và chất lượng nhất
            đến cho mọi người, chúng tôi luôn không ngừng học hỏi và cải tiến từ những
            phản hồi góp ý từ các bạn.
          </p>
        </div>
  
        <div class="col-md-6 col-lg-3">
          <h5 class="fw-light mb-3">Liên Hệ</h5>
          <div class="d-flex justify-content-start align-items-start my-2">
            <span class="me-3">
              <i class="fas fa-map-marked-alt"></i>
            </span>
            <a href="https://www.google.com/maps/dir//Trường+Cao+đẳng+FPT+Polytechnic,+Km12+Đ.+Cầu+Diễn,+Phúc+Diễn,+Bắc+Từ+Liêm,+Hà+Nội/@21.045226,105.7049666,13z/data=!4m9!4m8!1m0!1m5!1m1!1s0x313455b3f6710da1:0x240105831b77a1a2!2m2!1d105.746252!2d21.0451509!3e0?entry=ttu"
              class="text-white text-decoration-none">
              FPT Polytechnic - Hà Nội
            </a>
          </div>
          <div class="d-flex justify-content-start align-items-start my-2">
            <span class="me-3">
              <i class="fas fa-envelope"></i>
            </span>
            <span class="fw-light"> tranmanhthang30@gmail.com </span>
          </div>
          <div class="d-flex justify-content-start align-items-start my-2">
            <span class="me-3">
              <i class="fas fa-phone-alt"></i>
            </span>
            <span class="fw-light"> 096 534 2896 </span>
          </div>
        </div>
  
        <div class="col-md-6 col-lg-3">
          <h5 class="fw-light">Liên Kết</h5>
          <ul class="list-unstyled">
            <li class="my-3">
              <a href="{{route('product.index')}}" class="text-white text-decoration-none">
                <i class="fas fa-chevron-right me-1"></i> Trang Chủ
              </a>
            </li>
            <li class="my-3">
              <a href="{{route('product.list')}}" class="text-white text-decoration-none">
                <i class="fas fa-chevron-right me-1"></i> Sản Phẩm
              </a>
            </li>
            <li class="my-3">
              <a href="index.php#blogs" class="text-white text-decoration-none">
                <i class="fas fa-chevron-right me-1"></i> Blogs
              </a>
            </li>
            <li class="my-3">
              <a href="index.php#about" class="text-white text-decoration-none">
                <i class="fas fa-chevron-right me-1"></i> Giới Thiệu
              </a>
            </li>
          </ul>
        </div>
  
        <div class="col-md-6 col-lg-3">
          <h5 class="fw-light mb-3">Mạng Xã Hội</h5>
          <div>
            <ul class="list-unstyled d-flex">
              <li>
                <a href="#" class="text-white text-decoration-none fs-4 me-4">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li>
                <a href="#" class="text-white text-decoration-none fs-4 me-4">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li>
                <a href="#" class="text-white text-decoration-none fs-4 me-4">
                  <i class="fab fa-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  </body>
  <!-- end of footer -->
  
  <!-- Messenger Plugin chat Code -->
  <div id="fb-root"></div>
  
  <!-- Your Plugin chat code -->
  <div id="fb-customer-chat" class="fb-customerchat">
  </div>
  
  <script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "117080114779838");
    chatbox.setAttribute("attribution", "biz_inbox");
  </script>
  
  <!-- Your SDK code -->
  <script>
    window.fbAsyncInit = function () {
      FB.init({
        xfbml: true,
        version: 'v18.0'
      });
    };
  
    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <!-- jquery -->
  <script src="{{ asset('js/script.js') }}"></script>
  <script src="{{ asset('js/jqery_3.7.1.js') }}"></script>
   
  <!-- isotope js -->
  <script src="{{ asset('https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js')}}"></script>
  <!-- bootstrap js -->
  <script src=" {{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js')}}"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- custom js -->
  <!-- fontawesome cdn -->
  <script src="{{ asset('https://kit.fontawesome.com/9cc1e5b793.js')}}" crossorigin="anonymous"></script>
  
  </html>