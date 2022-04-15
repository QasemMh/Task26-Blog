<?php $page_title = "post" ?>

<?php include_once("header.php") ?>






<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
  <section class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-content">
            <h4>Post Details</h4>
            <h2 id="post-title">Single blog post</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>




<section class="blog-posts grid-system">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="all-blog-posts">
          <div class="row">
            <div class="col-lg-12" id="post-details">
              <!-- post here -->
            </div>

            <div class="col-lg-12">
              <div class="sidebar-item comments">
                <div class="sidebar-heading">
                  <h2 id="comments">4 comments</h2>
                </div>
                <div class="content">
                  <ul id="comments-data">
                    <!-- data here -->
                  </ul>
                </div>
              </div>
            </div>


            <!--  -->
            <div class="col-lg-12">
              <div class="sidebar-item submit-comment">
                <div class="sidebar-heading">
                  <h2>Your comment</h2>
                </div>
                <div class="content">
                  <form id="comment-form">
                    <div class="row">
                      <div class="col-md-6 col-sm-12">
                        <fieldset>
                          <input name="name" type="text" id="name" placeholder="Your name" required="">
                        </fieldset>
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <fieldset>
                          <input name="email" type="text" id="email" placeholder="Your email" required="">
                        </fieldset>
                      </div>

                      <div class="col-lg-12">
                        <fieldset>
                          <textarea name="content" rows="6" id="content" placeholder="Type your comment" required=""></textarea>
                        </fieldset>
                      </div>
                      <div class="col-lg-12">
                        <fieldset>
                          <button type="submit" id="form-submit" class="main-button">Submit</button>
                        </fieldset>
                      </div>
                    </div>
                  </form>
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