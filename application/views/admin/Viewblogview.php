<?php $this->load->view("admin/Headerview"); ?>



<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

  <h1 class="h2">View Blog</h1>

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>Srial No</th>
          <th>Title</th>
          <th>Description</th>
          <th>Image</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>

        <?php
        if ($result) {
          $counter = 1;

          foreach ($result as $key => $value) {
            echo "<tr>
                    <td>" . $counter . "</td>
                    <td>" . $value['blogTitle'] . "</td>
                    <td>" . $value['blogDescription'] . "</td>
                    <td><img src='" . base_url($value['blogImage']) . "' class='img-fluid' width='100'></td>
                  <td><a class=\"btn btn-info\" href='" . base_url() . "admin/Blog/editBlog/" . $value['blogID'] . "'>Edit</a></td>
                    <td><a class=\"btn delete btn-danger\" href='" . base_url() . 'admin/Blog/deleteBlog/' . "' data-id='".$value['blogID']."'>Delete</a></td>
                </tr>";
            $counter++;
          }
        } else {
          echo "<tr><td colspan='6'>No Records found</td></tr>";
        }
        ?>

      </tbody>
    </table>
  </div>
</main>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    $(".delete").click(function () {

      var delete_id = $(this).attr('data-id');

      var bool = confirm('are you sure to delete?');
      console.log(bool);

      if (bool) {

        $.ajax({
          url: '<?= base_url() . 'admin/Blog/deleteBlog/' ?>' + delete_id,
          type: 'POST',
          data: {delete_id: delete_id
},
          success: function (response) {
            console.log(response);

            if(response == "deleted"){
              location.reload(); 
            } else if (response == "notDeleted"){
               alert ("Something went wrong"); 
            }
          }
        });
      } else {
        alert("Your blog is safe");
      }

      <?php 
         if(isset($_SESSION['updated'])) {
            if ($_SESSION['updated']=="yes"){
            echo 'alert("Data has been updated!")';

          } else if ($_SESSION['updated']== 'no') {
            echo 'alert("Some error occured and data not updated");';
          }}

      ?>


    });
  });
</script>
</body>