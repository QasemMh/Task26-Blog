<?php $page_title = "blog" ?>

<?php include_once("header.php") ?>



<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
  <section class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-content">
            <h4>Recent Posts</h4>
            <h2>Our Recent Blog Entries</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Banner Ends Here -->

<section class="blog-posts grid-system">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="all-blog-posts">
          <div class="row" id="posts-data">

            <!-- posts -->
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="sidebar">
          <div class="row">
            <div class="col-lg-12">
              <div class="sidebar-item search">
                <form id="search_form" name="gs" method="GET" action="#">
                  <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on" />
                </form>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="sidebar-item recent-posts">
                <div class="sidebar-heading">
                  <h2>Recent Posts</h2>
                </div>
                <div class="content">
                  <ul id="recent-post">

                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="sidebar-item categories">
                <div class="sidebar-heading">
                  <h2>Categories</h2>
                </div>
                <div class="content">
                  <ul id="category-list">
                         
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<?php include_once("footer.php") ?>