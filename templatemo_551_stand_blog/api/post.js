$(function () {
  //fetch

  const options = {
    day: "numeric",
    year: "numeric",
    month: "long",
  };

  const map = new Map();

  //read post id from URL:
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const postId = urlParams.get("postId");

  //if not read postId param return to home
  if (!urlParams.get("postId")) {
    location.href = "index.php";
  }

  //comments count
  fetch("http://localhost:81/task26/api/comments/comments_count")
    .then((res) => res.json())
    .then((data) => {
      for (const item of data) {
        map.set(item.post_id, item.count);
      }

      //fetch post
      return fetch("http://localhost:81/task26/api/post/details/" + postId);
    })
    .then((res) => res.json())
    .then((item) => {
      let postDetails = "";

      //date
      let postDate = new Date(item.createAt).toLocaleDateString(
        "en-US",
        options
      );

      /* **For Post Details** */
      postDetails += `
          <div class="col-lg-12">
          <div class="blog-post">
            <div class="blog-thumb">
            <img
            class="img-fluid"
            style='object-fit: cover;          '
            src=" http://localhost:81/task26/image/${item.path}" 
            alt="post photo">
            </div>
            <div class="down-content">
              <span>${item.category}</span>
              <a href="http://localhost:81/task26/templatemo_551_stand_blog/post-details.php?postId=${postId}">
                <h4>${item.title}</h4>
              </a>
              <ul class="post-info">
                <li><a href="#">${item.name}</a></li>
                <li><a href="#">${postDate}</a></li>
                <li><a href="#">${
                  map.get(item.id) ? map.get(item.id) : "0"
                } Comments</a></li>
              </ul>
              <p> ${item.content.trim()}</p>
            </div>
          </div>
        </div>
          `;

      //add posts details
      $("#post-details").html(postDetails);
      $("#post-title").html(item.title);
      $("#comments").html(
        `${map.get(postId) ? map.get(postId) : "0"} Comments`
      );

      //fetch comments
      return fetch("http://localhost:81/task26/api/comments/post/" + postId);
    })
    .then((res) => res.json())
    .then((data) => {
      let commentsData = "";

      for (const item of data) {
        let commentDate = "";
        commentsData += `
        <li>
        <div class="author-thumb">
          <img src="assets/images/user-profile.jpg" alt="guest image">
        </div>
        <div class="right-content">
          <h4> ${item.name}<span>${commentDate}</span></h4>
          <p>${item.content}</p>
        </div>
       </li>
        `;
      }

      $("#comments-data").html(commentsData);
    });

  //when comment form submit
  // will run if create  form was submitted
  $(document).on("submit", "#comment-form", function (e) {
    e.preventDefault();
    const form = document.getElementById("comment-form");
    const formData = {};
    // Get all input elements inside a form
    // and create key:value pairs inside formData
    form.querySelectorAll("input").forEach((element) => {
      formData[element.name] = element.value;
    });
    form.querySelectorAll("textarea").forEach((element) => {
      formData[element.name] = element.value;
    });

    formData["post_id"] = postId;

    console.log(formData);

    // Send data to backend
    fetch("http://localhost:81/task26/api/comments/create", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    }).then((res) => {
      if (res.ok) {
        form.reset();
        fetchComments();
      } else {
        alert("Error. try again");
      }
    });
  });

  function fetchComments() {
    //fetch comments
    return fetch("http://localhost:81/task26/api/comments/post/" + postId)
      .then((res) => res.json())
      .then((data) => {
        let commentsData = "";

        for (const item of data) {
          let commentDate = "";
          commentsData += `
        <li>
        <div class="author-thumb">
          <img src="assets/images/user-profile.jpg" alt="guest image">
        </div>
        <div class="right-content">
          <h4> ${item.name}<span>${commentDate}</span></h4>
          <p>${item.content}</p>
        </div>
       </li>
        `;
        }

        $("#comments-data").html(commentsData);

        return fetch("http://localhost:81/task26/api/comments/comments_count");
      })
      .then((res) => res.json())
      .then((data) => {
        for (const item of data) {
          map.set(item.post_id, item.count);
        }
        $("#comments").html(
          `${map.get(postId) ? map.get(postId) : "0"} Comments`
        );
      });
  }
});
