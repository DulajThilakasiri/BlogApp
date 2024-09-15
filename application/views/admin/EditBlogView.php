<?php $this->load->view("admin/Headerview"); ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <h1 class="h2">Edit Blog</h1>
    <form enctype="multipart/form-data" action="<?php echo base_url('admin/Blog/editblog_post'); ?>" method="post">

        <input type="hidden" name="blog_id" value="<?= $blog_id?>">
        <div class="form-group">
            <input class="form-control" type="text" placeholder="Title" name="blog_title" value="<?= $result[0]['blogTitle'] ?>">
        </div>

        <div class="form-group">
            <textarea name="blog_desc" placeholder="Description" class="form-control"><?= $result[0]['blogDescription'] ?></textarea>
        </div>

        <div class="form-group">
            <img width="100" src="<?= base_url() . $result[0]['blogImage'] ?>" alt="">
            <input class="form-control" name="blog_file" type="file" placeholder="Add file">
        </div>

        <button class="btn btn-primary" type="submit">Edit Blog</button>


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