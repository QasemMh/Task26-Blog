$(function () {
  getAll();

  //Index
  function getAll() {
    getApp();

    fetch("http://localhost:81/task26/api/contact")
      .then((response) => response.json())
      .then((item) => {
        let tBody = "",
          tHead = "";
        tHead += `<tr>
            <th>id</th>
            <th>phone</th>
            <th>email</th>
            <th>location</th>
            <th>map_url</th>
              <th>Action</th>
            </tr>`;
        let i = 1;
        tBody += `<tr> 
          <td>${i++}</td>
          <td>${item.phone}</td>
          <td>${item.email}</td>
          <td>${item.location}</td>
          <td>${item.map_url ? "SET" : "NOT SET"}</td>
            <td><button class="btn btn-sm btn-info update_item" data-id=${
              item.id
            }>Edit</button>
          <button class="btn btn-sm btn-danger delete_item" data-id=${
            item.id
          }>Delete</button></td>
          </tr>`;

        $("#table_head").html(tHead);
        $("#table_body").html(tBody);
        changePageTitle("contact", "contact Data");
      })
      .catch((err) => {
        console.error(err);
      });
  }

  //Create
  // show html form when 'create item' button was clicked
  $(document).on("click", "#create_item", function () {
    /*html*/
    let create_form = `
              <form action="" method="POST" id="create_form">
              <div class="form-group  w-75">
              <label>phone</label>
              <input  type='text' maxlength="14" name='phone' class='form-control' required/>
              </div>
              
              <div class="form-group w-75">
              <label>email</label>
              <input  type='email' name='email' class='form-control' required/>
              </div>
              <!--item--> 
                <div class="form-group w-75">
              <label>location</label>
              <input  type='text' name='location' class='form-control' required/>
              </div>
              <!--item-->  
               <div class="form-group w-75">
              <label>map URi</label>
              <input  type='text' name='map_url' class='form-control' required/>
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
    changePageTitle("Create contact");
    $("#back-btn").on("click", function () {
      getAll();
    });
  });

  // will run if create  form was submitted
  $(document).on("submit", "#create_form", function (e) {
    e.preventDefault();
    const form = document.getElementById("create_form");
    const formData = {};
    // Get all input elements inside a form
    // and create key:value pairs inside formData
    form.querySelectorAll("input").forEach((element) => {
      formData[element.name] = element.value;
    });

    // Send data to backend
    fetch("http://localhost:81/task26/api/contact/create", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    }).then((res) => {
      if (res.ok) {
        //show all contact
        getAll();
      } else {
        alert("Error. try again");
      }
    });
  });
  //end index

  //update:
  // show html form when 'update contact' button was clicked
  $(document).on("click", ".update_item", function () {
    let id = $(this).attr("data-id");
    let uri = "http://localhost:81/task26/api/contact";
    fetch(uri)
      .then((response) => response.json())
      .then((data) => {
        /*html*/
        let update_item = `
          <form action="" method="POST" id="create_form">
          <input type="hidden" name="id" value="${data.id}">
          
          <label>phone</label>
          <input  type='text' value="${data.phone}" maxlength="14" name='phone' class='form-control' required/>
          </div>
          
          <div class="form-group w-75">
          <label>email</label>
          <input  type='email' value="${data.email}" name='email' class='form-control' required/>
          </div>
          <!--item--> 
            <div class="form-group w-75">
          <label>location</label>
          <input  type='text' name='location' value="${data.location}" class='form-control' required/>
          </div>
          <!--item-->  
           <div class="form-group w-75">
          <label>map URi</label>
          <input  type='text' name='map_url' value="${data.map_url}" class='form-control' required/>
          </div>
          <!--item-->
          <!--item-->
          <div class="form-group w-50">
          <button  type='submit' class="btn btn-primary" >Save</button>
          <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
          </div>
          <!--item-->
          
          </form>
                `;

        $("#app .card-body").html(update_item);
        changePageTitle("Update contact");
        $("#back-btn").on("click", function () {
          getAll();
        });
      });
  });

  // 'update contact form' submit handle will be here
  // will run if create contact form was submitted
  $(document).on("submit", "#update_form", function (e) {
    e.preventDefault();
    const form = document.getElementById("update_form");
    const formData = {};
    // Get all input elements inside a form
    // and create key:value pairs inside formData
    form.querySelectorAll("input").forEach((element) => {
      formData[element.name] = element.value;
    });

    console.log(formData);

    // Send data to backend
    fetch("http://localhost:81/task26/api/contact/update/" + formData["id"], {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    }).then((res) => {
      if (res.ok) {
        //show all contact
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
        fetch("http://localhost:81/task26/api/contact/delete/" + id, {
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
