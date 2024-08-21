var $grid = $(".collection-list").isotope({
    // options
  });
  // filter items on button click
  $(".filter-button-group").on("click", "button", function () {
    var filterValue = $(this).attr("data-filter");
    resetFilterBtns();
    $(this).addClass("active-filter-btn");
    $grid.isotope({ filter: filterValue });
  });
  
  var filterBtns = $(".filter-button-group").find("button");
  function resetFilterBtns() {
    filterBtns.each(function () {
      $(this).removeClass("active-filter-btn");
    });
  }
  
  $(document).ready(function () {
    // Check if the searchBox is visible on page load
    var isSearchBoxVisible = $("#searchBox").is(":visible");
  
    $("#toggleThis").click(function () {
      $("#searchBox").slideToggle("fast");
    });
  
    // Hide the searchBox if it was visible on page load
    if (isSearchBoxVisible) {
      $("#searchBox").hide();
    }
  });

  
  document.addEventListener('scroll', function() {
    var sideBanner1 = document.querySelector('.side_banner1');
    var sideBanner2 = document.querySelector('.side_banner2');
    
    // Kiểm tra vị trí cuộn trang
    if (window.scrollY > 200) { // Hiển thị banner khi cuộn qua 200px
      sideBanner1.style.display = 'block';
      sideBanner2.style.display = 'block';
    } else {
      sideBanner1.style.display = 'none';
      sideBanner2.style.display = 'none';
    }
  });
