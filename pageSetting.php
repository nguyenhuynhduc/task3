
<div>

    <h2>Footer</h2>
    <form method="post" action="admin.php?page=mymenupage" >
        <input id="footer" name="footer">
        <button type="submit">Submit</button>
    </form>
    <?php
    if(isset( $_POST["footer"]))
    {

        global $wpdb;
        $table_name= $wpdb->prefix ."options";
        $wpdb->update(
            $table_name,
            array('option_value'=>$_POST["footer"]),
            array('option_name'=>'footer_option')
        );
    }
    ?>
</div>

