$(function () {
  getAll();

  //Index
  function getAll() {
    getApp();

    fetch("http://localhost:81/task26/api/about")
      .then((response) => response.json())
      .then((item) => {
        let tBody = "",
          tHead = "";
        tHead += `<tr>
              <th>id</th>
              <th>Title</th>
              <th>Content</th>
                <th>Action</th>
              </tr>`;
        let i = 1;
        tBody += `<tr> 
            <td>${i++}</td>
            <td>${item.title}</td>
            <td>${item.content}</td>

              <td>
              <button class="btn btn-sm btn-secondary view_item" data-id=${
                item.id
              }>View</button>
              <button class="btn btn-sm btn-info update_item" data-id=${
                item.id
              }>Edit</button>
            <button class="btn btn-sm btn-danger delete_item" data-id=${
              item.id
            }>Delete</button></td>
            </tr>`;

        $("#table_head").html(tHead);
        $("#table_body").html(tBody);
        changePageTitle("about", "about Data");
      })
      .catch((err) => {
        console.error(err);
      });
  }

  //view
  //view
  $(document).on("click", ".view_item", function () {
    let uri = "http://localhost:81/task26/api/about";
    fetch(uri)
      .then((response) => response.json())
      .then((data) => {
        /*html*/
        let view_item = `
        <div class="row">
        <div class="col-md-8 overflow-hidden m-auto">
        <img src="http://localhost:81/task26/image/${data.path}" class="img-fluid" alt="post image">  
        </div>

       <div class="col-md-12 mt-4">
    
        <dl class="row">
        <dt class="col-sm-3 text-left">title</dt>
        <dd class="col-sm-9 text-left">${data.title}</dd>

        <dt class="col-sm-3 text-left">Content</dt>
        <dd class="col-sm-9 text-left"> ${data.content}</dd>

        </dl> 
        </div>
        </div> 
        
          <!--item-->
          <div class="form-group w-50">
           <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
          </div>
        `;

        $("#app .card-body").html(view_item);
        changePageTitle("View Message");
        $("#back-btn").on("click", function () {
          getAll();
        });
      });
  });

  //Create
  // show html form when 'create item' button was clicked
  $(document).on("click", "#create_item", function () {
    /*html*/
    let create_form = `
    <form action="" method="POST" id="create_form" enctype="multipart/form-data">
    <div class="form-group">
    <label>Title</label>
    <input  type='text' name='title' class='form-control' required/>
    </div>
    <!--item-->
    <div class="form-group">
    <label>Content</label>
    <textarea name="content" rows="12" required class="form-control"></textarea>
    </div>  
    <!--item-->
    <div class="input-group mb-3 w-50">
    <div class="custom-file">
      <input type="file" name="path" class="custom-file-input" id="inputGroupFile01" required accept="image/*">
      <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
    </div>
  </div>
    <!--item-->
    <div class="form-group w-50">
    <button  type='submit' class="btn btn-primary" >Submit</button>
    <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
    </div>
    <!--item-->
    </form>
                `;

    $("#app .card-body").html(create_form);
    changePageTitle("Create about");
    $("#back-btn").on("click", function () {
      getAll();
    });
  });

  // will run if create  form was submitted
  $(document).on("submit", "#create_form", function (e) {
    e.preventDefault();
    const form = document.getElementById("create_form");

    let formData = new FormData();

    form.querySelectorAll("input[type='text']").forEach((element) => {
      formData.append(element.name, element.value);
    });
    form.querySelectorAll("input[type='file']").forEach((element) => {
      formData.append(element.name, element.files[0]);
    });
    form.querySelectorAll("textarea").forEach((element) => {
      formData.append(element.name, element.value);
    });

    // Send data to backend
    fetch("http://localhost:81/task26/api/about/create", {
      method: "POST",
      body: formData,
    }).then((res) => {
      if (res.ok) {
        //show all about
        getAll();
      } else {
        alert("Error. try again");
      }
    });
  });
  //end index

  //update:
  // show html form when 'update about' button was clicked
  $(document).on("click", ".update_item", function () {
    let id = $(this).attr("data-id");
    let uri = "http://localhost:81/task26/api/about";
    fetch(uri)
      .then((response) => response.json())
      .then((data) => {
        /*html*/
        let update_item = `
        <form action="" method="POST" id="update_form" enctype="multipart/form-data">
        <input type="hidden" value="${data.id}" name="id">
 
        <div class="form-group">
        <label>Title</label>
        <input  type='text' value="${data.title}"  name='title' class='form-control' required/>
        </div>
       
        <!--item-->
        <div class="form-group">
        <label>Content</label>
        <textarea name="content" rows="12" required class="form-control">
        ${data.content}
        </textarea>
        </div>  
        <!--item-->
        <div class="input-group mb-3 w-50">
        <input type="hidden" value="${data.path}" name="path2">
        <div class="custom-file">
          <input type="file" name="path"  class="custom-file-input" id="inputGroupFile01" accept="image/*">
          <label class="custom-file-label" for="inputGroupFile01">Update Image?</label>
        </div>
      </div>
        <!--item-->
        <div class="form-group w-50">
        <button  type='submit' class="btn btn-primary" >Save</button>
        <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
        </div>
        <!--item-->
        </form>
                  `;

        $("#app .card-body").html(update_item);
        changePageTitle("Update about");
        $("#back-btn").on("click", function () {
          getAll();
        });
      });
  });

  // 'update about form' submit handle will be here
  // will run if create about form was submitted
  $(document).on("submit", "#update_form", function (e) {
    e.preventDefault();
    const form = document.getElementById("update_form");

    let formData = new FormData();

    form.querySelectorAll("input[type='text']").forEach((element) => {
      formData.append(element.name, element.value);
    });
    form.querySelectorAll("input[type='hidden']").forEach((element) => {
      formData.append(element.name, element.value);
    });
    form.querySelectorAll("input[type='file']").forEach((element) => {
      if (element.value) {
        formData.append(element.name, element.files[0]);
      }
    });
    form.querySelectorAll("textarea").forEach((element) => {
      formData.append(element.name, element.value);
    });

    // Send data to backend
    fetch("http://localhost:81/task26/api/about/update/" + formData["id"], {
      method: "POST",
      body: formData,
    }).then((res) => {
      if (res.ok) {
        //show all about
        getAll();
      } else {
        alert("Error. try again");
      }
    });
  });
  //end update

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
        fetch("http://localhost:81/task26/api/about/delete/" + id, {
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
