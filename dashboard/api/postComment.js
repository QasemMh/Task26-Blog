$(function () {
  getAll();

  //Index
  function getAll() {
    getApp();

    let posts_list = "";
    fetch("http://localhost:81/task26/api/post")
      .then((res) => res.json())
      .then((data) => {
        for (const item of data) {
          posts_list += `<option value=${item.id}>${item.title}, ${item.name}</option>`;
        }
        return fetch("http://localhost:81/task26/api/comments?limit=1000");
      })
      .then((response) => response.json())
      .then((data) => {
        let tBody = "",
          tHead = "";
        tHead += `<tr>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>createAt</th>
         <th>Action</th>
        </tr>`;
        let i = 1;
        for (const item of data) {
          tBody += `<tr> 
      <td>${i++}</td>
      <td>${item.name}</td>
       <td>${item.email}</td>
       <td>${item.createAt}</td>
       <td>

       <button class="btn btn-sm btn-info view_item" data-postid=${
         item.post_id
       }  data-id=${item.id}>View</button>

      <button class="btn btn-sm btn-danger delete_item" data-id=${
        item.id
      }>Delete</button>
        </td>
      </tr>`;
        }

        //filterByPost
        let filterByPost = `
        <form id="filter_form">
        <label>Filter By Post</label>
        <div class="input-group">
        <select
          class="custom-select"
          id="post_id"
          name="postId"
          required
         >
          <option selected disabled>Choose Post</option>
            ${posts_list}
         </select>
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit">Filter</button>
        </div>
      </div>
      </form>
        `;

        $("#table_head").html(tHead);
        $("#table_body").html(tBody);
        changePageTitle("comments", "comment data");
        $(".card-header").html(filterByPost);

        $("#create_item").hide();
      })
      .catch((err) => {
        console.error(err);
      });
  }

  //view message
  $(document).on("click", ".view_item", function () {
    let id = $(this).attr("data-id");
    let uri = "http://localhost:81/task26/api/comments/details/" + id;
    fetch(uri)
      .then((response) => response.json())
      .then((data) => {
        /*html*/
        let view_item = `
        <dl class="row">
        <dt class="col-sm-3 text-right">name</dt>
        <dd class="col-sm-9 text-left">${data.name}</dd>

        <dt class="col-sm-3 text-right">email</dt>
        <dd class="col-sm-9 text-left">${data.email}</dd>

        <dt class="col-sm-3 text-right">comment</dt>
        <dd class="col-sm-9 text-left"> ${data.content}</dd> 
        
        <dt class="col-sm-3 text-right">create at</dt>
        <dd class="col-sm-9 text-left"> ${data.createAt}</dd>
        </dl>  
        
          <!--item-->
          <div class="form-group w-50">
           <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
          </div>
        `;

        $("#app .card-body").html(view_item);
        changePageTitle("View comment");
        $("#back-btn").on("click", function () {
          getAll();
        });
      });
  });

  //delete
  // will run if the delete button was clicked
  $(document).on("click", ".delete_item", function () {
    let id = $(this).attr("data-id");
    // alert
    Swal.fire({
      title: "Do you want to Delete this?",
      showCancelButton: true,
      confirmButtonText: "Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("http://localhost:81/task26/api/comments/delete/" + id, {
          method: "POST",
        })
          .then((respon) => {
            $(this).parents("tr").fadeOut();
            Swal.fire("Deleted!", "", "success");
          })
          .catch((error) => {
            Swal.fire({
              icon: "error",
              title: "Oops... " + error,
              text: "Something went wrong!",
            });
          });
      }
    });
  });
});

//Filter comments by post on submit:
$(document).on("submit", "#filter_form", function (e) {
  e.preventDefault();
  //get post id
  let postId = $("#filter_form #post_id").val();

  //fetch data
  fetch(
    "http://localhost:81/task26/api/comments/post/" + postId + "?limit=1000"
  )
    .then((response) => response.json())
    .then((data) => {
      let tBody = "",
        tHead = "";
      tHead += `<tr>
  <th>id</th>
  <th>name</th>
  <th>email</th>
  <th>createAt</th>
   <th>Action</th>
  </tr>`;
      let i = 1;
      for (const item of data) {
        tBody += `<tr> 
                <td>${i++}</td>
                <td>${item.name}</td>
                <td>${item.email}</td>
                <td>${item.createAt}</td>
                <td>
 <button class="btn btn-sm btn-info view_item" data-id=${item.id}>View</button>
      <button class="btn btn-sm btn-danger delete_item" data-id=${
        item.id
      }>Delete</button>
  </td>
</tr>`;
      }

      $("#table_head").html(tHead);
      $("#table_body").html(tBody);
      changePageTitle("comments", "comment data");
      $(".card-header").html(
        `<a class="btn btn-outline-primary" href="postComment.php">Back</a>`
      );

      $("#create_item").hide();
    })
    .catch((err) => {
      console.error(err);
    });
});
