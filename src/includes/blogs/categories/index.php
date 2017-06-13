<?php
    $categoriesObj = new Categories($connection);
    $categories = $categoriesObj->get_categories();
?>

<div class="categories">
    <?php while($category = mysqli_fetch_assoc($categories)) { ?>
        <div class="category-container" onclick="window.location = 'blogs.php?category=<?php echo strtolower($category['category_name']); ?>'">
            <h1><?php echo $category['category_name']; ?></h1>
        </div>
    <?php } ?>
</div>