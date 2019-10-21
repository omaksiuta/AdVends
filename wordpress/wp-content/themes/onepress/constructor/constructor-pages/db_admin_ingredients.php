<?php
/**
 *Template Name: Ajax Php MySQL
 */


get_header(); ?>

<div id="content" class="site-content">

    <div class="page-header">
        <div class="container">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </div>
    </div>

    <?php echo onepress_breadcrumb(); ?>


    <h3 class="text-center">Dynamic Drag and Drop table rows in PHP Mysql - ItSolutionStuff.com</h3>

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Defination</th>
        </tr>
    <!---->
    <!--        <tbody class="row_position">-->
            <?php

            require('../constructor-configurations/db_config.php');
            ?>

            <?php
            $sql = "SELECT * FROM sorting_items ORDER BY position_order";
            $users = $mysqli->query($sql);
            ?>
    <!---->
    <!--        --><?php
    //        while ($user = $users->fetch_assoc()) {
    //        ?>
    <!--        <tr id="--><?php //echo $user['id'] ?><!--">-->
    <!--            <td>--><?php //echo $user['id'] ?><!--</td>-->
    <!--            <td>--><?php //echo $user['title'] ?><!--</td>-->
    <!--            <td>--><?php //echo $user['description'] ?><!--</td>-->
    <!--        </tr>-->
    <!--        --><?php
    //        }
    //        ?>
    <!---->
    <!--        </tbody>-->


    </table>
    <br><br><br><br>
    <h3 class="text-center">END OF THE PAGE</h3>


</div><!-- #content -->

<?php get_footer(); ?>

<!--<!--//TODO check header.php-->-->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
<!---->

<script type="text/javascript">
    $(".row_position").sortable({
        delay: 150,
        stop: function () {
            var selectedData = new Array();
            $('.row_position>tr').each(function () {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        $.ajax({
            url: "ajaxPro.php",
            type: 'post',
            data: {position: data},
            success: function () {
                alert('your change successfully saved');
            }
        })
    }
</script>
