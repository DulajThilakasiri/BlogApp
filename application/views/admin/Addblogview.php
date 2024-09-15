<?php $this->load->view("admin/Headerview"); ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <h1 class="h2">Add Blog</h1>
    <form enctype="multipart/form-data" action="<?php echo base_url('admin/Blog/addblog_post'); ?>" method="post">

        <div class="form-group">
            <input class="form-control" type="text" placeholder="Title" name="blog_title">
        </div>

        <div class="form-group">
            <textarea name="blog_desc" type="text" placeholder="Description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <input class="form-control" name="blog_file" type="file" placeholder="Add file">
        </div>

        <button class="btn btn-primary" type="submit">Add Blog</button>


    </form>
</main>
</body>

<script>
    <?php
    if (isset($_SESSION['inserted'])) {
        echo "alert('Data inserted successfully');";
    }
    ?>
</script>

</html>